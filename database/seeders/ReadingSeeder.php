<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reading;

class ReadingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reading::create(['temperature' => 25.5, 'humidity' => 60.0]);
        Reading::create(['temperature' => 26.0, 'humidity' => 55.0]);
        Reading::create(['temperature' => 24.5, 'humidity' => 65.0]);
        Reading::create(['temperature' => 27.0, 'humidity' => 50.0]);
        Reading::create(['temperature' => 23.0, 'humidity' => 70.0]);
    }
}
