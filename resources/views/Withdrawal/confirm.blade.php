<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penarikan Pendaftaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .container {
            width: 85%;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<header>
    <h1>Penarikan Pendaftaran</h1>
</header>

<div class="container">
    <h3>Adakah anda pasti untuk menarik pendaftaran ini?</h3>

    <p><strong>Nama:</strong> {{ $participant->name }}</p>
    <p><strong>No. IC:</strong> {{ $participant->ic_num }}</p>

    <form action="{{ route('withdraw.confirm') }}" method="POST">
        @csrf
        <input type="hidden" name="participant_id" value="{{ $participant->id }}">
        <button type="submit" class="btn-submit">Teruskan Pembatalan</button>
    </form>

</div>

</body>
</html>
