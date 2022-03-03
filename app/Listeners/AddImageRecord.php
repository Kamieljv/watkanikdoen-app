<?php

namespace App\Listeners;

use App\Models\Image;
use Illuminate\Support\Facades\Log;

class AddImageRecord
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle($event)
    {
        if (isset($event->changeType) && in_array($event->changeType, ['Added', 'Updated'])) {

            $mediaPicker = $event->dataType->editRows->where('type', 'media_picker')->first();

            if ($mediaPicker && isset($mediaPicker->details->foreign_key_name)) {
                // delete linked image if existed
                Image::where($mediaPicker->details->foreign_key_name, $event->data->id)->delete();
                // add image record if one is set
                if (isset($event->data[$mediaPicker->field])) {
                    Image::create([
                        'path' => $event->data[$mediaPicker->field],
                        $mediaPicker->details->foreign_key_name => $event->data->id,
                    ]);
                }
            }

        } elseif (isset($event->path)) {

            Image::create([
                'path' => $event->path,
            ]);

        }
    }
}
