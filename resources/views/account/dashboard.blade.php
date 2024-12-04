<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DesaHub Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container {
            width: 100%;
            margin: auto auto;
            padding: 25px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
@extends('includes.navbar')

@section('content')
<div class="container">
    <h2>Admin Profile</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h4>{{ $admin->fullname }}</h4>
            <p>Email: {{ $admin->email }}</p>
        </div>
    </div>

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
</div>

    <!-- Bootstrap 5 JS and Popper (required for some Bootstrap features) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
@endsection
</body>
</html>