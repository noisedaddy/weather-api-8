<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WeatherResource;
use App\Models\Weather;
use App\Service\WeatherService;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function index() {
        $weather = Weather::all();
        return response()->json([
            "success" => true,
            "message" => "Weather",
            "data" => $weather
        ]);
    }

    /**
     * Get
     * @param Request $request
     * @return mixed
     */
    public function show(Request $request) {
        $date = strtotime($request->weather);
        return app(WeatherService::class)->getWeatherForDate($date);
    }

    /**
     * Store method, not used, just an example of CRUD
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $input = ['date' => $request->date];
        $validator = \Illuminate\Support\Facades\Validator::make($input, [
            'date' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
                ]);
        }
        $weather = app(WeatherService::class)->getWeatherForDate(strtotime($request->date));
        return response()->json([
            "success" => true,
            "message" => "Weather added successfully.",
            "data" => $weather
        ]);
    }

    /**
     * Update method, not used, just an example of the CRUD
     * @param Request $request
     * @param Weather $weather
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request) {
        $input = ['date' => $request->date];
        $validator = \Illuminate\Support\Facades\Validator::make($input, [
            'date' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]);
        }
        $weather = app(WeatherService::class)->updateWeatherForDate(strtotime($request->date));
        return response()->json([
            "success" => true,
            "message" => "Weather updated successfully.",
            "data" => $weather
        ]);
    }

    /**
     * Delete method
     * @param Weather $weather
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Weather $weather) {
        $weather->delete();
        return response()->json([
            "success" => true,
            "message" => "weather deleted successfully.",
            "data" => $weather
        ]);
    }
}
