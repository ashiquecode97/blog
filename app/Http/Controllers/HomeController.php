<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $apiKey = env('WEATHER_API_KEY');
        $city = env('WEATHER_CITY', 'Jorhat');

        $weather = null;

        if ($apiKey) {
            try {
                $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                    'q' => $city,
                    'appid' => $apiKey,
                    'units' => 'metric',
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $weather = [
                        'city' => $data['name'],
                        'temperature' => round($data['main']['temp']),
                        'description' => $data['weather'][0]['description'],
                        'icon' => $data['weather'][0]['icon'],
                        'humidity' => $data['main']['humidity'],
                        'wind_speed' => $data['wind']['speed'],
                    ];
                }
            } catch (\Exception $e) {
                $weather = null;
            }
        }

        // Fetch posts (if you have a Post model)
        $posts = \App\Models\Post::latest()->take(6)->get();

        return view('home', compact('weather', 'posts'));
    }
}
