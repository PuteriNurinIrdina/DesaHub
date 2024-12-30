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

    <form action="{{ route('withdraw.confirm') }}" method="POST">
        @csrf
        <input type="hidden" name="participant_id" value="{{ $participant->id }}">
        <button type="submit" class="btn btn-submit">Teruskan Pembatalan</button>
    </form>

</div>
@endsection
</body>
</html>
