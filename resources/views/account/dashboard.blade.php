<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DesaHub Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .chart-container {
            margin-top: 30px;
        }

        .card {
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .chart-box {
            margin-bottom: 20px;
        }

        .log-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .log-container th, .log-container td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .log-container th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .log-container tr:hover {
            background-color: #f1f1f1;
        }

        .log-container {
            overflow-x: auto;
        }
    </style>
</head>
<body>
@extends('includes.navbar')

@section('content')
<div class="container">
<h1>Dashboard</h1>
<br>
    @if($user->role === 'admin')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Jumlah Program</h4>
                        <p>{{ $eventCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Jumlah Produk</h4>
                        <p>{{ $productCount }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4>Program Bulanan</h4>
                    <canvas id="eventsChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4>Produk Bulanan</h4>
                    <canvas id="productsChart"></canvas>
                </div>
            </div>
        </div>
        <br>
        <div class="log-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Log Aktiviti</h4>
                    <form action="{{ route('dashboard') }}" method="GET" class="d-flex">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control me-2" 
                            placeholder="Cari"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table log-container">
                        <thead>
                            <tr>
                                <th>Tarikh</th>
                                <th>Masa</th>
                                <th>Butiran</th>
                                <th>Jenis Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activityLogs as $log)
                                <tr>
                                    <td>{{ $log->updated_at->format('Y-m-d') }}</td>
                                    <td>{{ $log->updated_at->format('H:i') }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $log->account->fullname }}</strong>
                                            {{ $log->activityDetails }}
                                        </div>
                                    </td>
                                    <td>{{ $log->activityType }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tiada Aktiviti</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @elseif($user->role === 'peserta')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4>Jumlah Program Berdaftar</h4>
                        <p>8</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h4>Program Berdaftar</h4>
                <ul class="list-group">
                    
                </ul>
            </div>
        </div>
    @elseif($user->role === 'penjual')
        <div class="row">
        <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4>Jumlah Produk</h4>
                        <p>{{ $productCount }}</p>
                    </div>
                </div>
            </div>
        
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4>Produk Bulanan</h4>
                    <canvas id="productsChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4>Mengikut Kategori</h4>
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
        <br>
        <div class="log-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Log Aktiviti</h4>
                    <form action="{{ route('dashboard') }}" method="GET" class="d-flex">
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control me-2" 
                            placeholder="Cari"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table log-container">
                        <thead>
                            <tr>
                                <th>Tarikh</th>
                                <th>Masa</th>
                                <th>Butiran</th>
                                <th>Jenis Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activityLogs as $log)
                                <tr>
                                    <td>{{ $log->updated_at->format('Y-m-d') }}</td>
                                    <td>{{ $log->updated_at->format('H:i') }}</td>
                                    <td>
                                        <div>
                                            <strong>{{ $log->account->fullname }}</strong>
                                            {{ $log->activityDetails }}
                                        </div>
                                    </td>
                                    <td>{{ $log->activityType }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tiada Aktiviti/td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Products Chart
        if (document.getElementById('productsChart')) {
            const ctxProducts = document.getElementById('productsChart').getContext('2d');

            fetch('/api/products-data')
                .then(response => response.json())
                .then(result => {
                    console.log('API Response:', result);
                    new Chart(ctxProducts, {
                        type: 'bar',
                        data: {
                            labels: ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'December'],
                            datasets: [{
                                label: 'Jumlah Produk',
                                data: result.data || [], // Use data from API
                                backgroundColor: 'rgba(173, 216, 230, 0.6)',
                                borderColor: 'rgba(173, 216, 230, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching products data:', error));
        }

        // Events Chart
        if (document.getElementById('eventsChart')) {
            const ctxEvents = document.getElementById('eventsChart').getContext('2d');

            const defaultData = {
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            };

            fetch('/api/events-data')
                .then(response => response.json())
                .then(result => {
                    console.log('API Response:', result);

                    const chartData = result && result.data ? result.data : defaultData.data;

                    new Chart(ctxEvents, {
                        type: 'bar',
                        data: {
                            labels: ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'],
                            datasets: [{
                                label: 'Jumlah Program',
                                data: chartData,
                                backgroundColor: 'rgba(173, 216, 230, 0.6)',
                                borderColor: 'rgba(173, 216, 230, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching events data:', error);

                    new Chart(ctxEvents, {
                        type: 'bar',
                        data: {
                            labels: ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'],
                            datasets: [{
                                label: 'Jumlah Program',
                                data: defaultData.data, // Default zeros
                                backgroundColor: 'rgba(173, 216, 230, 0.6)',
                                borderColor: 'rgba(173, 216, 230, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        }

        // Category Chart
        if (document.getElementById('categoryChart')) {
            const ctxCategory = document.getElementById('categoryChart').getContext('2d');

            const defaultData = {
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            };

            fetch('/api/events-data')
                .then(response => response.json())
                .then(result => {
                    console.log('API Response:', result);

                    const chartData = result && result.data ? result.data : defaultData.data;

                    new Chart(ctxCategory, {
                        type: 'bar',
                        data: {
                            labels: ['Makanan', 'Kelengkapan Rumah', 'Fesyen', 'Penjagaan Diri', 'Mainan'],
                            datasets: [{
                                label: 'Jumlah Produk',
                                data: chartData,
                                backgroundColor: 'rgba(173, 216, 230, 0.6)',
                                borderColor: 'rgba(173, 216, 230, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching events data:', error);

                    new Chart(ctxCategory, {
                        type: 'bar',
                        data: {
                            labels: ['Makanan', 'Kelengkapan Rumah', 'Fesyen', 'Penjagaan Diri', 'Mainan'],
                            datasets: [{
                                label: 'Jumlah Produk',
                                data: defaultData.data, // Default zeros
                                backgroundColor: 'rgba(173, 216, 230, 0.6)',
                                borderColor: 'rgba(173, 216, 230, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

@endsection
</body>
</html>