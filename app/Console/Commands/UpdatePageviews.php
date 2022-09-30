<?php

namespace App\Console\Commands;

use App\Models\Actie;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Jenssegers\Date\Date;


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
        // Login and get an authorization token
        $response = Http::post(config('umami.url') . '/api/auth/login', [
            "username" => config('umami.username'),
            "password" => config('umami.password'),
        ]);
        // save token
        $token = json_decode($response->body())->token;
        // make metrics request
        $response = Http::withToken($token)->get(config('umami.url') . '/api/website/1/metrics', [
            'start_at' => Date::createFromDate(2000, 01, 01)->timestamp * 1000,
            'end_at' => Date::now()->timestamp * 1000,
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
                $actie->save();
            }
        }
    }
}
