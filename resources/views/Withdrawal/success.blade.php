<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penarikan Berjaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <style>
        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .btn-back {
            background-color: #004494;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #004494;
        }
    </style>
</head>
<body>
    @extends('includes.navbar')
    @section('content')

    <div class="container">
        <h1>Penarikan Berjaya!</h1>
        @if(session('success'))
            <div class="message">
                Penarikan anda telah berjaya disimpan.
            </div>
        @endif
        <br><br>
        <a href="{{ route('dashboard') }}" class="btn-back">Kembali ke Halaman Utama</a>
    </div>

    @endsection
</body>
</html>
