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
    <div class="row mb-3">
        <div class="col">
            <label for="yearFilter" class="form-label"><strong>Tahun</strong></label>
            <select id="yearFilter" name="year">
            <option value="" {{ empty(request('year')) ? 'selected' : '' }}>Pilih Tahun</option>
            @foreach ($availableYears as $year)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
        </div>
    </div>

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
        const yearFilter = document.getElementById('yearFilter');
        const currentYear = new Date().getFullYear();
        const selectedYear = new URLSearchParams(window.location.search).get('year') || currentYear;
        yearFilter.value = selectedYear;

        yearFilter.addEventListener('change', function () {
            const year = this.value;
            const urlParams = new URLSearchParams(window.location.search);
            if (year) {
                urlParams.set('year', year);
            } else {
                urlParams.delete('year');
            }
            window.location.search = urlParams.toString();
        });

        function fetchChartData(apiUrl, chartId, labels, labelName, backgroundColor, borderColor) {
            const ctx = document.getElementById(chartId).getContext('2d');

            fetch(`${apiUrl}?year=${yearFilter.value}`)
                .then(response => response.json())
                .then(result => {
                    const chartData = result.data || Array(labels.length).fill(0); // Default to zero if no data
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: labelName,
                                data: chartData,
                                backgroundColor: backgroundColor,
                                borderColor: borderColor,
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
                .catch(error => console.error(`Error fetching data for ${chartId}:`, error));
        }

        // Products Chart
        if (document.getElementById('productsChart')) {
            fetchChartData(
                '/api/products-data',
                'productsChart',
                ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'],
                'Jumlah Produk',
                'rgba(173, 216, 230, 0.6)',
                'rgba(173, 216, 230, 1)'
            );
        }

        // Events Chart
        if (document.getElementById('eventsChart')) {
            fetchChartData(
                '/api/events-data',
                'eventsChart',
                ['Januari', 'Februari', 'Mac', 'April', 'Mei', 'Jun', 'Julai', 'Ogos', 'September', 'Oktober', 'November', 'Disember'],
                'Jumlah Program',
                'rgba(173, 216, 230, 0.6)',
                'rgba(173, 216, 230, 1)'
            );
        }

        // Category Chart
        if (document.getElementById('categoryChart')) {
            fetchChartData(
                '/api/category-data',
                'categoryChart',
                ['Barangan Runcit', 'Kesihatan & Kecantikan', 'Kelengkapan Rumah', 'Bayi, Kanak-kanak & Mainan', 'Fesyen', 'Automatif', 'Haiwan', 'Lain-lain'],
                'Jumlah Produk',
                'rgba(173, 216, 230, 0.6)',
                'rgba(173, 216, 230, 1)'
            );
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

@endsection
</body>
</html>