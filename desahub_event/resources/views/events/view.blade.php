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
            color: #333;
        }
        h1 {
            color: #Add8e6 ;
            text-align: center;
        }
       
        .filter-form, .event-list {
            margin-bottom: 20px;
        }
        .filter-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .filter-form input, .filter-form select, .filter-form button {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
            max-width: 300px;
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
        }
        .sidebar {
            width: 200px;
            padding: 15px;
            background-color: #Add8e6 ;
            height: 100%;
            position: fixed;
        }
        .content {
            margin-left: 280px;
            padding: 20px;
            width: 90%;
        }
        .event img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3>Filters</h3>
        <form method="GET" action="{{ route('events.view') }}">
            <label for="day">Day:</label>
            <select name="day">
                <option value="">-- Select Day --</option>
                @foreach($days as $day)
                    <option value="{{ $day }}" {{ request('day') == $day ? 'selected' : '' }}>
                        {{ $day }}
                    </option>
                @endforeach
            </select>
            <br><br>
            <label for="month">Month:</label>
            <select name="month">
                <option value="">-- Select Month --</option>
                @foreach($months as $month)
                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                        {{ $month }}
                    </option>
                @endforeach
            </select>
            <br><br>
            <label for="year">Year:</label>
            <select name="year">
                <option value="">-- Select Year --</option>
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
            <br><br>
            <label for="type">Type:</label>
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
            <br><br>
            <button type="submit">Apply Filters</button>
        <br><br><br>
        <!-- Back to View All Button -->
        <div class="view-all-button">
            <a href="{{ route('events.view') }}" style="text-decoration: none;">
                <button type="button">Clear Filter</button>
            </a>
        </div>
        </form>
    </div>

    <div class="content">
        <h1>Events</h1>
        @if($events->isEmpty())
            <p>No events found.</p>
        @else
        <div class="event-container">
            @foreach($events as $event)
                        <div class="event-box">
                            <img src="{{ $event->poster }}" alt="Event Poster">
                            <h2>{{ $event->name }}</h2>
                            <p>Date: {{ $event->date }}</p>
                            <p>Type: {{ $event->type }}</p>
                            <div class="event-buttons">
                                <a href="" style="text-decoration: none;">
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
    
