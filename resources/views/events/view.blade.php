<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <style>

        .event-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            gap: 20px;
            margin: 20px;
        }
        .event-box {
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .event-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .event-box img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        @media (max-width: 768px) {
            .event-box {
                padding: 10px;
            }
        }
        h2 {
            color: rgb(18, 92, 117);
        }
        h3 {
            color: white;
            text-align: center;
        }
        
        .no-event {
            text-align: center;
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .filter-form {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 15px;
            background-color: #095c80;
            top: 0;
            left: 0;
            z-index: 10;
            height: auto;
            color: #fff;
        }

        .filter-form label {
            margin-right: 10px;
            font-weight: bold;
            color: white;
        }

        .filter-form select, .filter-form button {
            padding: 8px;
            max-width: 200px;
            margin-top: 10px;
        }

        .event-list {
            margin-bottom: 20px;
            text-align: center;
        }

        .content {
            padding-top: 250px;
            width: 100%;
            margin: 0 auto;
        }

        .event img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
</head>

<body>
@extends('includes.navbar')
@section('content')
<div class="container">
<h1>Program</h1>
    <div class="filter-form">
        <form method="GET" action="{{ route('events.view', ['account_id' => Auth::user()->id] ) }}">
            <!--<label for="day">Hari:</label>
            <select name="day">
                <option value="">-- Pilih Hari --</option>
                @foreach($days as $day)
                    <option value="{{ $day }}" {{ request('day') == $day ? 'selected' : '' }}>
                        {{ $day }}
                    </option>
                @endforeach
            </select>

            <label for="month">Bulan:</label>
            <select name="month">
                <option value="">-- Pilih Bulan --</option>
                @foreach($months as $month)
                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>

            <label for="year">Tahun:</label>
            <select name="year">
                <option value="">-- Pilih Tahun --</option>
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>-->

          
            
            <label for="date_range">Tarikh:</label>
            <input type="text" id="date_range" name="date_range" placeholder="  -- Pilih Tarikh --" class="filter-input" value="{{ request('date_range') }}">
            <label for="type">Kategori:</label>
            <select name="type">
                <option value="">-- Pilih Kategori --</option>
                <option value="type1" {{ request('type') == 'type1' ? 'selected' : '' }}>ICT</option>
                <option value="type2" {{ request('type') == 'type2' ? 'selected' : '' }}>Keusahawanan</option>
                <option value="type3" {{ request('type') == 'type3' ? 'selected' : '' }}>Pusat Aktiviti & Pemerkasaan Wanita</option>
                <option value="type4" {{ request('type') == 'type4' ? 'selected' : '' }}>Pusat Aktiviti Kesukarelawan</option>
                <option value="type5" {{ request('type') == 'type5' ? 'selected' : '' }}>Pusat Latihan Komuniti</option>
                <option value="type6" {{ request('type') == 'type6' ? 'selected' : '' }}>Pusat Pengumpulan Produk Usahawan Desa</option>
                <option value="type7" {{ request('type') == 'type7' ? 'selected' : '' }}>Pusat Perkhidmatan Setempat</option>
                <option value="type8" {{ request('type') == 'type8' ? 'selected' : '' }}>Lain-Lain</option>
            </select>

            <button type="submit">Cari</button>
        </form>
        <a href="{{ route('events.view',['account_id' => Auth::user()->id]) }}">
            <button type="button">Buang Tapisan</button>
        </a>
    </div>
    <div>
        @if($events->isEmpty())
        <div class="no-event">
            <p>Tiada Program Dijumpai</p>
        </div>
        @else
        <div class="event-container">
            @foreach($events as $event)
            <div class="event-box">
                <img src="{{ $event->poster }}" alt="Event Poster">
                <h2>{{ $event->name }}</h2>
                <p><strong>Tarikh: </strong> {{ $event->date }}</p>
                <p><strong>Masa: </strong>{{ $event->formatted_event_time }}</p>
                <p><strong>Kategori: </strong>{{ $event->type_label }}</p>
                <p><strong>Negeri: </strong>{{ $event->state_name }}</p>
                @if ($event->max_participants)
                <p><strong>Had Peserta: </strong> {{ $event->max_participants }}</p>
                @else
                <p><strong>Had Peserta: </strong>Tiada Had</p>
                @endif
                <div class="event-buttons">
                    <a href="{{ route('event.register', ['account_id' => Auth::user()->id,'event_id' => $event->id]) }}" style="text-decoration: none;">
                        <button type="button">Daftar</button>
                    </a>

                    <a href="{{ route('events.detail', $event->id) }}" style="text-decoration: none;">
                        <button type="button">Lihat Butiran</button>
                    </a>

                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <script>
    flatpickr("#date_range", {
        mode: "range",
        dateFormat: "Y-m-d",
        defaultDate: [
            "{{ request('start_date') ?? '' }}", 
            "{{ request('end_date') ?? '' }}"
        ].filter(Boolean)
    });
    </script>

@endsection
</body>
</html>
