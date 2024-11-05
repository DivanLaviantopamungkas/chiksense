@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Dashboard Monitoring Kandang Ayam</h1>

        <div class="row">
            <!-- Current Temperature Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Suhu Terkini (°C)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $currentTemperature }}°C</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-thermometer-half fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Humidity Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kelembapan Terkini (%)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $currentHumidity }}%</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-water fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Temperature Range Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Rentang Suhu (°C)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $temperatureRange }}°C</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-temperature-high fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Humidity Range Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Rentang Kelembapan
                                    (%)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $humidityRange }}%</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-smog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Temperature and Humidity Chart -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Gauge Suhu (°C)</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="temperatureGauge"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Gauge Kelembapan (%)</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="humidityGauge"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Readings Table -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pembacaan Terkini</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Suhu (°C)</th>
                                            <th>Kelembapan (%)</th>
                                            <th>Tanggal/Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentReadings as $reading)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $reading->temperature }}°C</td>
                                                <td>{{ $reading->humidity }}%</td>
                                                <td>{{ $reading->created_at->format('d-m-Y H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-gauge@0.4.0/dist/chartjs-gauge.min.js"></script>
        <script>
            // Data contoh (ubah sesuai dengan data real-time Anda)
            var currentTemperature = 28; // Suhu saat ini
            var currentHumidity = 65; // Kelembapan saat ini

            // Suhu Gauge
            var tempCtx = document.getElementById('temperatureGauge').getContext('2d');
            var temperatureGauge = new Chart(tempCtx, {
                type: 'gauge',
                data: {
                    datasets: [{
                        data: [currentTemperature],
                        value: currentTemperature,
                        backgroundColor: ['#ff0000', '#ffff00', '#00ff00'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    layout: {
                        padding: {
                            bottom: 10
                        }
                    },
                    needle: {
                        radiusPercentage: 2,
                        widthPercentage: 2,
                        lengthPercentage: 80,
                        color: 'rgba(0, 0, 0, 0.7)'
                    },
                    valueLabel: {
                        fontSize: 20,
                        color: '#000',
                        backgroundColor: '#fff',
                        borderRadius: 5,
                        padding: 5
                    },
                    plugins: {
                        gauge: {
                            minValue: 0,
                            maxValue: 50,
                            valueLabel: {
                                display: true
                            }
                        }
                    }
                }
            });

            // Kelembapan Gauge
            var humidityCtx = document.getElementById('humidityGauge').getContext('2d');
            var humidityGauge = new Chart(humidityCtx, {
                type: 'gauge',
                data: {
                    datasets: [{
                        data: [currentHumidity],
                        value: currentHumidity,
                        backgroundColor: ['#00ff00', '#ffff00', '#ff0000'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    layout: {
                        padding: {
                            bottom: 10
                        }
                    },
                    needle: {
                        radiusPercentage: 2,
                        widthPercentage: 2,
                        lengthPercentage: 80,
                        color: 'rgba(0, 0, 0, 0.7)'
                    },
                    valueLabel: {
                        fontSize: 20,
                        color: '#000',
                        backgroundColor: '#fff',
                        borderRadius: 5,
                        padding: 5
                    },
                    plugins: {
                        gauge: {
                            minValue: 0,
                            maxValue: 100,
                            valueLabel: {
                                display: true
                            }
                        }
                    }
                }
            });
        </script>
    @endsection
@endsection
