@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4 text-center">Monitoring Suhu dan Pencahayaan Kandang Ayam</h2>

        <!-- Card untuk Monitoring Suhu dan Status Pencahayaan -->
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Suhu Udara & Pengaturan Pencahayaan</h3>
                <i class="fas fa-thermometer-half fa-2x text-primary"></i>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <!-- Suhu Udara -->
                    <div class="col-md-6 mb-4">
                        <h4 class="text-muted">Suhu Udara</h4>
                        <h1 class="display-2 font-weight-bold">
                            <span>{{ $latestReading->temperature ?? '-' }}</span>°C
                        </h1>
                        <i class="fas fa-temperature-high fa-4x text-warning mt-3"></i>
                    </div>

                    <!-- Status Lampu -->
                    <div class="col-md-6">
                        <h4 class="text-muted">Status Lampu</h4>
                        <div class="display-4">

                            <i class="fas fa-lightbulb fa-4x text-success"></i>
                            <p class="mt-3 font-weight-bold text-success" style="font-size: 1.5rem;">ON</p>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Kontrol Kecerahan -->
            <div class="card-footer">
                <h4 class="text-muted mb-3">Pengaturan Kecerahan</h4>
                <div class="d-flex align-items-center">
                    <i class="fas fa-sun fa-2x text-warning me-3"></i>
                    <input type="range" class="form-range flex-grow-1" id="brightnessSlider" min="0" max="100"
                        value="{{ $latestReading->brightness ?? 50 }}">
                    <span id="brightnessValue" class="ms-3 font-weight-bold"
                        style="font-size: 1.5rem;">{{ $latestReading->brightness ?? 50 }}%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk slider brightness -->
    <script>
        document.getElementById('brightnessSlider').addEventListener('input', function() {
            document.getElementById('brightnessValue').textContent = this.value + '%';
        });
    </script>

    <!-- Link Font Awesome (opsional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection
