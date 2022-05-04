<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WeatherTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_weather_from_api()
    {
        $date = Carbon::now()->toDateString();
        $response = $this->get('api/weather/'.$date);
        $response->assertStatus(200)->assertJsonFragment([
            'location'=>'new_york',
            'location'=>'paris',
            'location'=>'tokio',
            'location'=>'berlin',
            'location'=>'london'
        ]);
    }
}
