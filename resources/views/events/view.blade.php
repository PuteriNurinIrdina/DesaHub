<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
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
            color:rgb(18, 92, 117);
        }
        h1 {
<<<<<<< HEAD
            color: #Add8e6;
=======
            color: #095c80;
            text-align: center;
        }
        h3 {
            color: white ;
>>>>>>> c3303983eb8e7c0abd9f8cc8f77fa29a06236c23
            text-align: center;
        }

        .no-event {
            text-align: center;
        }

        .filter-form {
            width: 100%;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            justify-content: space-between; /* Distribute space between filters */
            flex-direction: column;
<<<<<<< HEAD
            align-items: center;
=======
            text-align: center;
            /* justify-content: center; */
>>>>>>> c3303983eb8e7c0abd9f8cc8f77fa29a06236c23
            gap: 30px; /* Adds spacing between the filters */
            margin-bottom: 20px;
            padding: 15px;
<<<<<<< HEAD
            background-color: #Add8e6;
            height: 150px;
            position: fixed;
        }

=======
            background-color: #095c80 ;
            height: 200px;
            position: fixed;
            
        } 
        } 
       
>>>>>>> c3303983eb8e7c0abd9f8cc8f77fa29a06236c23
        .event-list {
            margin-bottom: 20px;
            text-align: center;
        }
        .filter-form label {
            margin-right: 10px;
            font-weight: bold;
        }
        .filter-form select {
            padding: 8px;
            max-width: 200px; /* Limit the width of the select box */
            width: 100%; /* Makes the select box responsive */
            margin-right: 25px;
            margin-top: 10px;
        }
        .filter-form button {
            padding: 10px 15px;
            margin: 15px; /* Space between the button and the selects */
        }

        .event-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .event-card h3 {
            margin: 0 0 10px;
        }
        .event-buttons button {
            margin-right: 10px;
        }
<<<<<<< HEAD
        .view-all-button {
            margin-bottom: 20px;
            align-items: center;
        }

=======
        
        
>>>>>>> c3303983eb8e7c0abd9f8cc8f77fa29a06236c23
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
</head>

<body>
    <div class="filter-form">
        <h3>Tapis Program</h3>
        <form method="GET" action="{{ route('events.view') }}">
            <label for="day">Hari:</label>
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
            </select>

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
<<<<<<< HEAD

            <a href="{{ route('events.view') }}">
=======
        
        <!-- Back to View All -->
            <br>
            <a href="{{ route('events.view') }}" >
>>>>>>> c3303983eb8e7c0abd9f8cc8f77fa29a06236c23
                <button type="button">Buang Penapis</button>
            </a>
        </form>
    </div>

    <div class="content">
        <h1>Program</h1>
        @if($events->isEmpty())
        <div class="no-event">
            <p>Tiada Program Dijumpai</p>
        </div>
        @else
        <div class="event-container">
            @foreach($events as $event)
<<<<<<< HEAD
            <div class="event-box">
                <img src="{{ $event->poster }}" alt="Event Poster">
                <h2>{{ $event->name }}</h2>
                <p>Tarikh: {{ $event->date }}</p>
                <p>Kategori: {{ $event->type }}</p>
                <p>Negeri: {{ $event->state_name }}</p>
                <div class="event-buttons">
                    <a href="{{ route('EventRegistration.index', ['event_id' => $event->id]) }}" style="text-decoration: none;">
                        <button type="button">Daftar</button>
                    </a>

                    <a href="{{ route('events.detail', $event->id) }}" style="text-decoration: none;">
                        <button type="button">Lihat Butiran</button>
                    </a>

                    <a href="{{ route('withdraw.registration', ['event_id' => $event->id]) }}" style="text-decoration: none;">
                        <button type="button">Penarikan Pendaftaran</button>
                    </a>
                </div>
            </div>
=======
                        <div class="event-box">
                            <img src="{{ $event->poster }}" alt="Event Poster">
                            <h2>{{ $event->name }}</h2>
                            <p>Tarikh: {{ $event->date }}</p>
                            <p>Kategori: {{ $event->type }}</p>
                            <p>Negeri: {{ $event->state_name }}</p>
                            <div class="event-buttons">
                            <a href="{{ route('register.index') }}" style="text-decoration: none;">
                                <button type="button">Daftar</button>
                            </a>
                                <a href="{{ route('events.detail', $event->id) }}" style="text-decoration: none;">
                                <button type="button">Lihat Butiran</button>
                            </a>
                            </div>
                        </div>
               
>>>>>>> c3303983eb8e7c0abd9f8cc8f77fa29a06236c23
            @endforeach
        </div>
        @endif
    </div>
</body>
</html>
