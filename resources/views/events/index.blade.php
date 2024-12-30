
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Page</title>
    
    <style>
        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .event-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            gap: 20px;
            margin: 20px;
        }

        .event-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .event-box:hover {
            transform: scale(1.05);
        }

        .event-box img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .event-box h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .event-box p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 15px;
        }

        .event-box a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #095c80;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .event-box a:hover {
            background-color:rgba(9, 92, 128, 0.77);
        }

        .event-box .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .event-box .action-buttons form {
            display: inline-block;
        }

        /* Success message */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin: 20px;
            border-radius: 5px;
        }

        /* Modal Styles for Delete Confirmation */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        .modal-content button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-content button:hover {
            background-color: #c82333;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .event-btn {
        display: block;
        padding: 20px 30px;
        background-color: #095c80;
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-size: 20px;
        width: max-content; /* Adjust button width based on content */
        margin: 20px auto; /* Center the button horizontally */
    }

    .event-btn:hover {
        background-color:rgba(9, 92, 128, 0.9);

    }
    
    </style>
</head>
<body>
@extends('includes.navbar')
@section('content')
<div class="container">
    <h1>Senarai Program</h1>

    <!-- Success Message -->
    @if(session()->has('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif
        


    <!-- Event Listings -->
    <div class="event-container">
        @foreach($events as $event)
            <div class="event-box">
                <!-- Event Poster -->
                @if($event->poster)
                
                <img src="{{ $event->poster }}" alt="Poster Program"/>

                @else
                    <p>Tiada Poster</p>
                @endif
                <!-- Event Info -->
                <h3>{{ $event->name }}</h3>
                <p><strong>Tarikh:</strong> {{ $event->date }}</p>
                <p><strong>Kategori:</strong> {{ $event->type_label }}</p>
                <!-- <p><strong>Penerangan:</strong> {{ $event->desc }}</p> -->

                <!-- Display State and City -->
                <p><strong>Negeri:</strong> {{ $event->state_name ?? 'N/A' }}</p>
                <p><strong>Bandar:</strong> {{ $event->city_name ?? 'N/A' }}</p>
                <div class="action-buttons">
                    <!-- Edit Button -->
                    <a href="{{ route('list.pendaftar', ['event_id' => $event->id]) }}">Pendaftar</a>
                    <a href="{{ route('event.edit', ['event' => $event]) }}">Kemas Kini</a>
                     
                </div>
                <!-- Delete Button -->
                <button class="delete-btn" onclick="openModal({{ $event->id }})" data-id="{{ $event->id }}">Buang</button>
            </div>
        <!-- Modal for Delete Confirmation -->
        <div id="myModal{{ $event->id }}" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal({{ $event->id }})">&times;</span>
                    <p>Adakah anda pasti ingin buang program ini?</p>
                    <form id="deleteForm{{ $event->id }}" action="{{ route('event.destroy', ['event' => $event]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Buang Program</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>


    <script>
        // Open the modal
        function openModal(eventId) {
            document.getElementById("myModal" + eventId).style.display = "block";
            //const deleteForm = document.getElementById("deleteForm");
            //deleteForm.action = "{{ route('event.destroy', ['event' => '__eventId__']) }}".replace('__eventId__', eventId);
        }

        // Close the modal
        function closeModal(eventId) {
            document.getElementById("myModal" + eventId).style.display = "none";
        }

        // Close the modal if clicked outside
        window.onclick = function(event) {
            if (event.target.classList.contains("modal")) {
                closeModal();
            }

        }
    </script>
    <a href="{{ route('events.create') }}" class="event-btn">Tambah Program</a>

    <script>
            setTimeout(function() {
                const successMessage = document.querySelector('.success-message');
                if (successMessage) {
                    successMessage.style.transition = 'opacity 0.5s ease'; // Smooth transition
                    successMessage.style.opacity = 0; // Fade out
                    setTimeout(function() {
                        successMessage.style.display = 'none'; // Hide after fade
                    }, 500); // Match this duration with the opacity transition
                }
            }, 3000); // Fade out after 3 seconds
        </script>
    @endsection
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <style>
        .event-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px;
        }
        .event-box {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .event-box img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .event-box h3 {
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .event-box p {
            font-size: 1rem;
            color: #555;
        }
        .event-box a {
            display: block;
            margin: 10px 0;
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .event-box a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Events</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <div>
      <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Type</th>
                <th>Description</th>
                <th>Poster</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($events as $event)
                <tr>
                    <td>{{$event->id}}</td>
                    <td>{{$event->name}}</td>
                    <td>{{$event->date}}</td>
                    <td>{{$event->type}}</td>
                    <td>{{$event->desc}}</td>
                    <td>
                        @if($event->poster)
                            <img src="{{$event->poster}}" alt="Event Poster" width="100">
                        @else
                            No Poster
                        @endif 
                    </td>
                    <td>
                        <a href="{{route('event.edit',['event' => $event])}}">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{route('event.destroy', ['event' => $event]) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html> -->