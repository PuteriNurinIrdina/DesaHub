<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penanda Kehadiran</title>
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

        .success-message, .error-message {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 16px;
        }

        .success-message {
            background-color: #28a745;
            color: white;
        }

        .error-message {
            background-color: #dc3545;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
            font-size: 18px;
        }

        table td {
            background-color: #f9f9f9;
        }

        .attendance-buttons {
            display: flex;
            gap: 15px;
        }

        .attendance-buttons input[type="radio"] {
            margin-right: 8px;
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
            display: block;
            margin: 0 auto;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .btn-submit:active {
            background-color: #004085;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f7f9fc;
            color: #888;
            margin-top: 30px;
            font-size: 14px;
        }

    </style>
</head>
<body>

@extends('includes.navbar')

@section('content')

<header>
    <h1>Kehadiran Pengunjung</h1>
</header>

<div class="container">
    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('attendance.mark') }}" method="POST">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nombor Telefon</th>
                    <th>Jantina</th>
                    <th>Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->phone_num }}</td>
                        <td>{{ ucfirst($participant->gender) }}</td>
                        <td class="attendance-buttons">
                            <!-- Radio buttons for Hadir and Tidak Hadir -->
                            <label>
                                <input type="radio" name="attendance[{{ $participant->id }}]" value="Hadir" 
                                    {{ $participant->attendance == 'Hadir' ? 'checked' : '' }}> Hadir
                            </label>
                            <label>
                                <input type="radio" name="attendance[{{ $participant->id }}]" value="Tidak Hadir"
                                    {{ $participant->attendance == 'Tidak Hadir' ? 'checked' : '' }}> Tidak Hadir
                            </label>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn-submit">Simpan</button>
    </form>
</div>

<footer>
    <p>&copy; {{ date('Y') }} Pengurusan Acara. Semua hak cipta terpelihara.</p>
</footer>
@endsection
</body>
</html>
