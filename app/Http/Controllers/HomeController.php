<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reading;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data terkini
        $latestReading = Reading::latest()->first();

        // Ambil semua pembacaan terakhir untuk tabel
        $recentReadings = Reading::orderBy('created_at', 'desc')->limit(10)->get();

        // Ambil data suhu dan kelembapan untuk grafik
        $readings = Reading::orderBy('created_at', 'asc')->get();
        $labels = $readings->pluck('created_at')->map(function ($date) {
            return $date->format('d-m-Y H:i'); // Format label
        });
        $temperatureData = $readings->pluck('temperature');
        $humidityData = $readings->pluck('humidity');

        // Menghitung data untuk statistik
        $currentTemperature = $latestReading ? $latestReading->temperature : 0;
        $currentHumidity = $latestReading ? $latestReading->humidity : 0;
        $temperatureRange = Reading::max('temperature') . ' - ' . Reading::min('temperature');
        $humidityRange = Reading::max('humidity') . ' - ' . Reading::min('humidity');

        // Kirim data ke view
        return view('pages.dashboard.index', compact(
            'currentTemperature',
            'currentHumidity',
            'temperatureRange',
            'humidityRange',
            'recentReadings',
            'labels',
            'temperatureData',
            'humidityData'
        ));
    }
}
