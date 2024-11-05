<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'humidity' => 'required|numeric',
            'temperature' => 'required|numeric'
        ]);
        SensorData::create($data);
        return response()->json(['message' => 'Data berhasil disimpan.'], 200);
    }
}
