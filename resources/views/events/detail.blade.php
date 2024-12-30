<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Detail</title>
    
    <style>
        /* Reset some default browser styling
        body, h1, h2, p, ul {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            display: flex;
            justify-content: center;
            
            height: 100vh;
            margin: 0;
        }*/

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .event-detail {
            text-align: center;
        }

        .event-detail img {
            width: 50%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 10px;
        }

        p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .event-buttons {
            margin-top: 20px;
        }

        .ws-group {
            margin-top: 100px;
        }

        .event-buttons button {
            background-color: #095c80;
            color: white;
            font-size: 1rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .event-buttons button:hover {
            background-color: #0056b3;
        }

        hr {
            margin: 30px 0;
            border: 1px solid #eee;
        }

        .event-others h4 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .event-others ul {
            list-style-type: none;
            padding-left: 0;
        }

        .event-others li {
            margin: 10px 0;
        }

        .event-others a {
            color: #007BFF;
            text-decoration: none;
        }

        .event-others a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>
@extends('includes.navbar')
@section('content')
    <div class="container">
        <h1>Event Details</h1>
        <br>
        @if($event)
            <div class="event-detail">
                <img src="{{ $event->poster }}" alt="Event Poster">
                
                <h2>{{ $event->name }}</h2>
                <p><strong>Tarikh: </strong> {{ $event->date }}</p>
                <p><strong>Kategori: </strong> {{ $event->type_label }}</p>
                <p><strong>Alamat: </strong> {{ $event->address }}</p>
                <p><strong>Negeri: </strong> {{ $event->state_name }}</p>
                <p><strong>Bandar: </strong> {{ $event->city_name }}</p>
                @if ($event->max_participants)
                <p><strong>Had Peserta: </strong> {{ $event->max_participants }}</p>
                @else
                <p><strong>Had Peserta: </strong>Tiada Had</p>
                @endif
                <p><strong>Penerangan: </strong></p>
                <p>{{ $event->desc }}</p>

                <div class="event-buttons">
                    <!-- If the user is logged in, allow them to join or register for the event -->
                    <a href="{{ route('event.register', ['account_id' => auth()->id(), 'event_id' => $event->id]) }}" style="text-decoration: none;">
                        <button type="button">Daftar</button>
                    </a>
                    @if ($event->whatsapp_group_link)
                    <div class="ws-group">
                        <p>Untuk sebarang pertanyaan dan informasi lebih lanjut,</p>
                        <a href="{{ $event->whatsapp_group_link }}" target="_blank" class="btn btn-primary">Sertai Group WhatsApp</a>
                    </div>      
                    @endif

                                    <br><br><br>
                    <a href="{{ route('events.view', ['event' => $event->id, 'account_id' => auth()->id()]) }}">
                        Kembali
                    </a>
                </div>
                <hr>
                <div class="event-others">
                    <h4>Program Lain Yang Mungkin Anda Suka</h4>
                    <ul>
                        @foreach($otherEvents as $otherEvent)
                            <li>
                                <a href="{{ route('events.detail', $otherEvent->id) }}">{{ $otherEvent->name }}</a> 
                                ({{ $otherEvent->date }} - {{ $otherEvent->type_label }})
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <p>Event not found.</p>
        @endif
    </div>
@endsection
</body>
</html>