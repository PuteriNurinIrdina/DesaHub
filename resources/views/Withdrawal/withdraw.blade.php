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

        .message {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 16px;
        }

        .message.success {
            background-color: #28a745;
            color: white;
        }

        .message.error {
            background-color: #dc3545;
            color: white;
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
    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif
        <br>
    <form action="{{ route('withdraw.process') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ic_num">Masukkan Nombor IC:</label>
            <input type="text" name="ic_num" id="ic_num" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-submit">Semak Pendaftaran</button>
    </form>
</div>
@endsection
</body>
</html>
