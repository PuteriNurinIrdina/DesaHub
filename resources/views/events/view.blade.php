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
            grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
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
            color:rgb(18, 92, 117) ;
        }
        h1 {
            color: #Add8e6 ;
            text-align: center;
        }
        
        .no-event{
            text-align: center;
        }

        .filter-form {
            width: 100%;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            justify-content: space-between; /* Distribute space between filters */
            flex-direction: column;
            align-items: center;
            /* justify-content: center; */
            gap: 30px; /* Adds spacing between the filters */
            margin-bottom: 20px;
            /* text-align: center; */
            padding: 15px;
            background-color: #Add8e6 ;
            height: 150px;
            position: fixed;
        } 
        } 
       
        .event-list {
            margin-bottom: 20px;
            text-align: center;
        }
        .filter-form label {
           
            margin-right: 10px; 
            font-weight: bold;
        }
        .filter-form select{
            padding: 8px;
            max-width: 200px; /* Limit the width of the select box */
            width: 100%; /* Makes the select box responsive */
            margin-right: 25px;
            margin-top:10px;
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
        .view-all-button {
            margin-bottom: 20px;
            align-items: center;
        }
        
        .content {
            padding-top: 170px;
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
        <!--<h2>Program</h2>
        <br> -->
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
        
        <!-- Back to View All -->
        
            <a href="{{ route('events.view') }}" >
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
                        <div class="event-box">
                            <img src="{{ $event->poster }}" alt="Event Poster">
                            <h2>{{ $event->name }}</h2>
                            <p>Tarikh: {{ $event->date }}</p>
                            <p>Kategori: {{ $event->type }}</p>
                            <p>Negeri: {{ $event->state_name }}</p>
                            <div class="event-buttons">
                                <a href="" style="text-decoration: none;">
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
</body>
</html>
<!-- <body>
    <h1>Events</h1>

    // Back to View All Button
    <div class="view-all-button">
        <a href="{{ route('events.view') }}" style="text-decoration: none;">
            <button type="button">View All Events</button>
        </a>
    </div>

    // Filter Form 
    <form method="GET" action="{{ route('events.view') }}" class="filter-form">
        <h2>Filter Events</h2>

        <label for="date">Filter by Exact Date:</label>
        <input type="date" name="date" value="{{ request('date') }}">

        <label for="month">Filter by Month:</label>
        <input type="text" name="month" placeholder="e.g., 7 (July)" value="{{ request('month') }}">

        <label for="year">Filter by Year:</label>
        <input type="text" name="year" placeholder="e.g., 2024" value="{{ request('year') }}">

        <label for="day">Filter by Day:</label>
        <input type="text" name="day" placeholder="e.g., 15" value="{{ request('day') }}">

        <label for="type">Filter by Type:</label>
        <select name="type">
            <option value="">-- Select Type --</option>
            <option value="sports" {{ request('type') == 'sports' ? 'selected' : '' }}>Sports</option>
            <option value="workshop" {{ request('type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
            <option value="sem_webinar" {{ request('type') == 'sem_webinar' ? 'selected' : '' }}>Seminar/Webinar</option>
            <option value="religious" {{ request('type') == 'religious' ? 'selected' : '' }}>Religious Activity</option>
            <option value="fundraiser" {{ request('type') == 'fundraiser' ? 'selected' : '' }}>Fundraiser</option>
            <option value="festival" {{ request('type') == 'festival' ? 'selected' : '' }}>Festival</option>
            <option value="educational" {{ request('type') == 'educational' ? 'selected' : '' }}>Educational</option>
            <option value="others" {{ request('type') == 'others' ? 'selected' : '' }}>Others</option>
        </select>

        <br>
        <button type="submit">Apply Filters</button>
    </form>

    // Events List
    <h2>Event List</h2>
    @if($events->isEmpty())
        <p>No events found.</p>
    @else
        <div class="event-list">
            @foreach($events as $event)
                <div class="event-card">
                    <h3>{{ $event->name }}</h3>
                    <p><strong>Date:</strong> {{ $event->date }}</p>
                    <p><strong>Type:</strong> {{ $event->type }}</p>
                    <div class="event-buttons">
                      <a style="text-decoration: none;">
                            <button type="button">Join Event</button>
                        </a>
                        <a href="{{ route('events.detail', $event->id) }}" style="text-decoration: none;">
                            <button type="button">View Details</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</body>
</html>
    -->
    
