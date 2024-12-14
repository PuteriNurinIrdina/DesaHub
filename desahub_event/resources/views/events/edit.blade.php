<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-size: 1.1rem;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
        .form-group input[type="file"] {
            padding: 0;
        }
        .form-group img {
            margin-top: 10px;
            border-radius: 5px;
        }
        .error-messages {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .cancel-btn {
            text-align: center;
            margin-top: 20px;
        }
        .cancel-btn a {
            color: #4CAF50;
            text-decoration: none;
            font-size: 1rem;
        }
        .cancel-btn a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Event Posting</h1>
        <h2>Edit event details below</h2>

        @if($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('event.update', ['event' => $event]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            
            <div class="form-group">
                <label for="name">Nama Program:</label>
                <input type="text" id="name" name="name" placeholder="Nama Program" value="{{ $event->name }}" />
            </div>

            <div class="form-group">
                <label for="date">Tarikh:</label>
                <input type="date" id="date" name="date" placeholder="Tarikh Program" value="{{ $event->date }}" />
            </div>

            <div class="form-group">
                <label for="type">Event Type:</label>
                <select id="type" name="type">
                    <option value="sports" {{ $event->type == 'sports' ? 'selected' : '' }}>Sports</option>
                    <option value="workshop" {{ $event->type == 'workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="sem_webinar" {{ $event->type == 'sem_webinar' ? 'selected' : '' }}>Seminar/Webinar</option>
                    <option value="religious" {{ $event->type == 'religious' ? 'selected' : '' }}>Religious Activity</option>
                    <option value="fundraiser" {{ $event->type == 'fundraiser' ? 'selected' : '' }}>Fundraiser</option>
                    <option value="festival" {{ $event->type == 'festival' ? 'selected' : '' }}>Festival</option>
                    <option value="educational" {{ $event->type == 'educational' ? 'selected' : '' }}>Educational</option>
                    <option value="others" {{ $event->type == 'others' ? 'selected' : '' }}>Others</option>
                </select>
            </div>

            <div class="form-group">
                <label for="desc">Description:</label>
                <input type="text" id="desc" name="desc" placeholder="Describe the event" value="{{ $event->desc }}" />
            </div>

            <div class="form-group">
                <label for="poster">Event Poster:</label>
                <input type="file" name="poster" accept="image/png, image/jpeg, image/jpg" />
                @if($event->poster)
                    <p>Current Poster: <img src="{{ $event->poster }}" width="100" /></p>
                @else
                    <p>No Poster Available</p>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Update Event</button>
            </div>
        </form>

        <div class="cancel-btn">
            <a href="{{ route('events.index') }}">Cancel</a>
        </div>
    </div>

</body>
</html>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event Posting</h1>
    <h2>Edit event details</h2>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ route('event.update', ['event' => $event]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div>
            <label>Name:</label>
            <input type="text" id="name" name="name" placeholder="Event Name" value="{{ $event->name }}" />
        </div>
        <br>
        <div>
            <label>Date:</label>
            <input type="date" id="date" name="date" placeholder="Event Date" value="{{ $event->date }}" />
        </div>
        <br>
        <div>
            <label>Event Type:</label>
            <select id="type" name="type">
                <option value="sports" {{ $event->type == 'sports' ? 'selected' : '' }}>Sports</option>
                <option value="workshop" {{ $event->type == 'workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="sem_webinar" {{ $event->type == 'sem_webinar' ? 'selected' : '' }}>Seminar/Webinar</option>
                <option value="religious" {{ $event->type == 'religious' ? 'selected' : '' }}>Religious Activity</option>
                <option value="fundraiser" {{ $event->type == 'fundraiser' ? 'selected' : '' }}>Fundraiser</option>
                <option value="festival" {{ $event->type == 'festival' ? 'selected' : '' }}>Festival</option>
                <option value="educational" {{ $event->type == 'educational' ? 'selected' : '' }}>Educational</option>
                <option value="others" {{ $event->type == 'others' ? 'selected' : '' }}>Others</option>
            </select>
        </div>
        <br>
        <div>
            <label>Description:</label>
            <input type="text" id="desc" name="desc" placeholder="Describe the event" value="{{ $event->desc }}" />
        </div>
        <br>
        <div>
            <label>Event Poster:</label>
            <input type="file" name="poster" accept="image/png, image/jpeg, image/jpg" />
            @if($event->poster)
                <p>Current Poster: <img src="{{ asset('storage/posters' . $event->poster) }}" width="100" /></p>
                <p>Image URL: {{ asset('storage/' . $event->poster) }}</p>
            @else
                <p>No Poster Available</p>
            @endif
        </div>
        <br>
        <div>
            <button type="submit">Update Event</button>
        </div>
    </form>
</body>
</html>
-->