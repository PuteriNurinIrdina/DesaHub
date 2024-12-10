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
                        <h4>Total Events</h4>
                        <p>10</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Total Products</h4>
                        <p>10</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4>Monthly Events</h4>
                    <canvas id="eventsChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4>Monthly Products</h4>
                    <canvas id="productsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h4>Activity Log</h4>
                <ul class="list-group">
                    @forelse ($activityLogs as $log)
                        <li class="list-group-item">
                            <strong>{{ $log->activityType }}:</strong> {{ $log->activityDetails }}
                            <small class="text-muted">{{ $log->timestamp->diffForHumans() }}</small>
                        </li>
                    @empty
                        <li class="list-group-item">No recent activities</li>
                    @endforelse
                </ul>
            </div>
        </div>
    @elseif($user->role === 'peserta')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Total Events Registered</h4>
                        <p>8</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4>Total Events to Attend</h4>
                        <p>5</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="chart-container mt-4">
            <h4>Event Calendar</h4>
            <!-- Replace this with a calendar or chart -->
            <canvas id="eventCalendarChart"></canvas>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h4>Registered Events</h4>
                <ul class="list-group">
                    
                </ul>
            </div>
        </div>
    @elseif($user->role === 'penjual')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h4>Total Products</h4>
                        <p>10</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="chart-container mt-4">
            <h4>Monthly Product Data</h4>
            <canvas id="productsChart"></canvas>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h4>Activity Log</h4>
                <ul class="list-group">
                    @forelse ($activityLogs as $log)
                        <li class="list-group-item">
                            <strong>{{ $log->activityType }}:</strong> {{ $log->activityDetails }}
                            <small class="text-muted">{{ $log->timestamp->diffForHumans() }}</small>
                        </li>
                    @empty
                        <li class="list-group-item">No recent activities</li>
                    @endforelse
                </ul>
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
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
@endsection
</body>
</html>