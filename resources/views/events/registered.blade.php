<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Acara Yang Didaftar</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        .container {    
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        } 

        .back-link {
            color: #095c80;
            text-decoration: none;
            font-size: 16px;
        }

        .back-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .back-link i {
            margin-right: 5px;  
        }

        .table-title {
            font-size: 28px;
            font-weight: 500;
            color: #007BFF;
            margin-bottom: 30px;
            text-align: center;
        }

        .event-list-wrapper {
            width: 100%;
            overflow-x: auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-top: 20px;
        }

        .event-list {
            width: 100%;
            border-collapse: collapse;
            font-size: 18px;
        }

        .event-list th,
        .event-list td {
            text-align: left;
            text-transform: uppercase;
            padding: 18px;
            border: 1px solid #e0e0e0;
        }

        .event-list th {
            background-color: #095c80;
            color: white;
            font-weight: normal;  
            font-size: 18px;
        }

        .event-list td {
            font-size: 18px;
            color: #555;
            font-weight: normal; 
        }

        .event-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .event-list tr:hover {
            background-color: #e6f2ff;
        }

        .no-data-message {
            text-align: center;
            padding: 40px;
            font-size: 22px;
            color: #555;
            background-color: #f7f9fc;
            border: 1px solid #d0d7de;
            border-radius: 10px;
        }

        .total-count {
            font-size: 22px;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .search-box {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-box input {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            display: block;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 28px;
            }

            .table-title {
                font-size: 24px;
            }

            .event-list th,
            .event-list td {
                font-size: 14px;
                padding: 14px;
            }
        }
        button {
            background-color: #095c80;
            color: white;
            font-size: 1rem;
            padding: 10px 20px;
            border: none;
            border-radius: 10px !important;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:disabled {
            background-color: #b0b0b0; 
            cursor: not-allowed;
            color: #fff;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body>
@extends('includes.navbar')
@section('content')

    <div class="container">
    <b><a href="{{ url()->previous() }}" class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a><b>
    <h1>Senarai Acara Telah Anda Daftar</h1>
    <br>
        <div class="total-count">
            Jumlah Acara: {{ $events->count() }}
        </div>

        @if ($events->isEmpty())
            <div class="no-data-message">
                Tiada Acara Yang Didaftar.
            </div>
        @else
            <div class="event-list-wrapper">
                <table class="event-list" id="eventTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta</th>
                            <th>No IC Peserta</th>
                            <th>Nama Acara</th>
                            <th>Tarikh</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $counter = 0;
                        @endphp
                        @foreach ($events as $index => $event)
                        @foreach ($event->participant_names as $index => $name)
                            <tr>
                                <td>{{ ++$counter }}</td>
                                <td>{{ $name }}</td>
                                <td>{{ $event->participant_ics[$index] }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->state_name }}, {{ $event->city_name }}</td>
                                <td>{{ $event->status }}</td>
                                <td>
                                    @if($event->status !== 'Tamat')
                                        <a href="{{ route('withdraw.process', ['event_id' => $event->id, 'ic_num' => $event->participant_ics[$index]]) }}" style="text-decoration: none;">
                                        <button type="button">Tarik Diri</button>
                                    @else 
                                    <button type="button" disabled>Tarik Diri</button>
                                    @endif
                                </a></td>
                            </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
</body>
</html>