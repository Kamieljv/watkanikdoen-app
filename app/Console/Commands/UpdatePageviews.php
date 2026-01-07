<?php

namespace App\Console\Commands;

use App\Models\Actie;
use App\Notifications\Mail\ErrorAlert;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

use Carbon\Carbon;

class UpdatePageviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acties:update_pageviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the pageviews (from Umami) for all actions.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            // Login and get an authorization token
            $response = Http::post(config('umami.url') . '/api/auth/login', [
                "username" => config('umami.username'),
                "password" => config('umami.password'),
            ]);
            // save token
                $response->throw();
                $token = json_decode($response->body())->token;
            
            // make metrics request
            $response = Http::withToken($token)->get(config('umami.url') . '/api/websites/' . config('umami.websiteId') . '/metrics', [
                'startAt' => Carbon::createFromDate(2000, 01, 01)->timestamp * 1000,
                'endAt' => Carbon::now()->timestamp * 1000,
                'type' => 'url'
            ]);
            // declare pagestats and filter for acties only
            $pageStats = json_decode($response->body());
            $actieStats = Arr::where($pageStats, function($v, $k) {
                return preg_match('/\/actie\//', $v->x);
            });
            // Update pageviews for all found acties
            foreach ($actieStats as $stat) {
                $slug = preg_split('/\/actie\//', $stat->x)[1];
                $actie = Actie::where('slug', $slug)->first();
                if ($actie != null) {
                    $actie->pageviews = $stat->y;
                    // disable and re-enable timestamps to not update the updated_at field when updating pageviews
                    $actie->timestamps = false;
                    $actie->save();
                    $actie->timestamps = true;
                }
            }
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to authenticate with Umami: ' . $e->getMessage());
            // Send email to admin about failure
            Notification::route('mail', config('app.admin_email'))
                ->notify((new ErrorAlert("Unable to update pageviews. Error: " . $e->getMessage()))->delay(now()->addSeconds(5)));
            return 1;
        }
    }
}
