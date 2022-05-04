<?php

namespace App\Service;

use App\Events\UpdateWeatherDateEvent;
use App\Models\Weather;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    /**
     * API call for getting weather data
     * Caching api routes is commented because
     * @param null $date
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeatherForDateAPI($date = null) {

            $result = [];
            Log::info("Not from cache");
            $app_id = config('weather.app_id');
            $locations = config('weather.locations');
        $client = new Client();
        foreach ($locations as $city=>$coordinates) {
                $url = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat={$coordinates['lat']}&lon={$coordinates['long']}&dt={$date}&appid={$app_id}";
                Log::info($url);
                $res = $client->get($url);
                if ($res->getStatusCode() == 200) {
                    $j = $res->getBody();
                    $obj = json_decode($j);
                    $result[$city] = $obj->current;
                } else {
                    $result[$city] = ['error' => 'Not Found'];
                }
        }
            return $result;
    }

    /**
     * REturns weather for the given date from DB
     * @param null $date
     * @return mixed
     */
    public function getWeatherForDateDB($date = null) {
        return Weather::where('date', $date)->get();
    }

    /**
     * Finds weather for the given date from DB or API if date not found in the DB
     * @param null $date
     * @return mixed|void
     */
    public function getWeatherForDate($date = null) {
        $weather = $this->getWeatherForDateDB($date);
        if (count($weather) > 0) {
            return $weather;
        } else {
            $data = $this->getWeatherForDateAPI($date);
            UpdateWeatherDateEvent::dispatch($date, $data);
            return $this->getWeatherForDateDB($date);
        }
    }
}
