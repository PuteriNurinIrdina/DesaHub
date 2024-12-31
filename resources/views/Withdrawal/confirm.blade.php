<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penarikan Pendaftaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <style>
        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
@extends('includes.navbar')
@section('content')

<div class="container">
    <h1>Penarikan Pendaftaran</h1>
    <br>
    <h3>Adakah anda pasti untuk menarik pendaftaran ini?</h3>
    <p><strong>Nama:</strong> {{ $participant->name }}</p>
    <p><strong>No. IC:</strong> {{ $participant->ic_num }}</p>
    <form action="{{ route('withdraw.confirm', ['event_id' => $participant->event_id, 'ic_num' => $participant->ic_num]) }}" method="POST">
        @csrf
        <input type="hidden" name="ic_num" value="{{ $participant->ic_num }}">
        <input type="hidden" name="event_id" value="{{ $participant->event_id }}">
        <button type="submit" class="btn-submit">Teruskan Pembatalan</button>
    </form>
    @if(session('success'))
        <p class="success" style="color: green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p class="error" style="color: red;">{{ session('error') }}</p>
    @endif


</div>

@endsection
</body>
</html>