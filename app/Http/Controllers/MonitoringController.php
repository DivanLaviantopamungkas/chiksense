<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reading;

class MonitoringController extends Controller
{
    public function index()
    {
        $latestReading = Reading::latest()->first();
        return view('pages.monitoring.index',  compact('latestReading'));
    }

    public function storeReading(Request $request)
    {
        // Simulasi data suhu dari sensor
        $temperature = $request->input('temperature');

        // Tentukan status pencahayaan berdasarkan suhu
        $lightStatus = $temperature < 28.0 ? true : false; // ON jika suhu < 28°C

        // Simpan data suhu dan status pencahayaan ke dalam database
        Reading::create([
            'temperature' => $temperature,
            'light_status' => $lightStatus,
        ]);

        return response()->json(['success' => true]);
    }
}
