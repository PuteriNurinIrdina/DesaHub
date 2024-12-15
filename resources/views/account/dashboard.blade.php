<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DesaHub Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        header {
            background-color: #095c80;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            width: 100%;
            margin: auto auto;
            padding: 25px;
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

<header><h2>Dashboard</h2></header>
<br>
<div class="container">
    @if($user->role === 'admin')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Jumlah Program</h4>
                        <p>10</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Jumlah Produk</h4>
                        <p>10</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
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

        <div class="log-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Activity Log</h4>
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
                                    <td colspan="4" class="text-center">No recent activities</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @elseif($user->role === 'peserta')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Jumlah Program Berdaftar</h4>
                        <p>8</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Baki Program Perlu Hadir</h4>
                        <p>5</p>
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
        <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Jumlah Produk</h4>
                        <p>10</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Jumlah Kategori Produk</h4>
                        <p>2</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
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
                                    <td colspan="4" class="text-center">No recent activities</td>
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
        // Admin or Penjual: Products Chart
        if (document.getElementById('productsChart')) {
            const ctxProducts = document.getElementById('productsChart').getContext('2d');
            new Chart(ctxProducts, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Total Products',
                        data: [2, 1, 4, 3, 5, 2, 3, 1, 3, 0, 2, 2],
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
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
        }

        // Admin or Peserta: Events Chart
        if (document.getElementById('eventsChart')) {
            const ctxEvents = document.getElementById('eventsChart').getContext('2d');
            new Chart(ctxEvents, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    datasets: [{
                        label: 'Total Events',
                        data: [5, 8, 3, 6, 7, 9, 4, 2, 8, 10, 7, 5],
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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
        }

        // Penjual: Products by Category Chart
        if (document.getElementById('categoryChart')) {
            const ctxCategory = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctxCategory, {
                type: 'bar',
                data: {
                    labels: ['Electronics', 'Fashion', 'Home Appliances', 'Toys', 'Books'],  // Example categories
                    datasets: [{
                        label: 'Total Products by Category',
                        data: [5, 3, 2, 0, 1],  // Example data: Replace with actual data from the backend
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
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
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
@endsection
</body>
</html>