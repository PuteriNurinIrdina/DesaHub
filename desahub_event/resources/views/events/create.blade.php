
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }
        .form-container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-container input, .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create Event</h2>
        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
            @csrf
            @method('post')
            <label for="name">Event Name:</label>
            <input type="text" id="name" name="name" placeholder="Event Name" required>

            <label for="date">Event Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="type">Event Type:</label>
            <select id="type" name="type">
            <option value="sports">Sports</option>
            <option value="workshop">Workshop</option>
            <option value="sem_webinar">Seminar/Webinar</option>
            <option value="religious">Religious Activity</option>
            <option value="fundraiser">Fundraiser</option>
            <option value="festival">Festival</option>
            <option value="educational">Educational</option>
            <option value="others">Others</option>
            </select>
                
            <label for="desc">Description:</label>
            <input type="text" id="desc" name="desc" placeholder="Event Description" required>

            <label for="poster">Event Poster:</label>
            <input type="file" name="poster" accept="image/png, image/jpeg, image/jpg">

            <button type="submit">Create Event</button>
        </form>
    </div>
</body>
</html>


<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create an Event Posting</h1>
    <h2>Enter event details</h2>
   <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error) 
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <form method="post" action="{{route('events.store')}}" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div>
            <label>Name:</label>
            <input type="text" id="name" name="name" placeholder="event name"/>
        </div>
        <br>
        <div>
        <label>Date:</label>
        <input type="date" id="date" name="date" placeholder="event date"/>
        </div>
        <br>
        <div>
        <label>Event Type:</label>
        <select id="type" name="type">
        <option value="sports">Sports</option>
        <option value="workshop">Workshop</option>
        <option value="sem_webinar">Seminar/Webinar</option>
        <option value="religious">Religious Activity</option>
        <option value="fundraiser">Fundraiser</option>
        <option value="festival">Festival</option>
        <option value="educational">Educational</option>
        <option value="others">Others</option>
        </select>
        <br>
        <br>
        <div>
        <label>Description:</label>
        <input type="text" id="desc" name="desc" placeholder="describe the event"/>
        </div>
        <br>
        <div>
            <label>Event Poster:</label>
            <input type="file" name="poster" accept="image/png, image/jpeg, image/jpg">
        </div>

        <br>
        <div>
            <button type="submit">Save Event Informatiom</button>
        </div>
    </form> 
    
</body>
</html>-->