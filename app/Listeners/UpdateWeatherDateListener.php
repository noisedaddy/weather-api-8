<?php

namespace App\Listeners;

use App\Events\UpdateWeatherDateEvent;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateWeatherDateListener
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
     * @param  \App\Events\UpdateWeatherDateEvent  $event
     * @return void
     */
    public function handle(UpdateWeatherDateEvent $event)
    {
        $date = $event->date;
        $weatherData = $event->weatherData;
        foreach ($weatherData as $city => $data) {
            Log::debug($city);
            Log::debug(json_encode((array)($data)));
            Weather::updateOrCreate(
                ['date' => $date, 'location' => $city],
                [
                    'longitude' => null,
                    'latitude' => null,
                    'content_raw' => json_encode($data),
                    'weather_details' => json_encode($data->weather)
                ],
            );
        }
    }
}
