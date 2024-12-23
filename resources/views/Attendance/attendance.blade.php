<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penanda Kehadiran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
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
            background-color: #095c80;
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

<div class="container">
<h1>Kehadiran Pengunjung</h1>
<br>
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

        <button type="submit" class="btn btn-submit" style="width: 100%;">Simpan</button>
    </form>
</div>

<footer>
    <p>&copy; {{ date('Y') }} Pengurusan Acara. Semua hak cipta terpelihara.</p>
</footer>
@endsection
</body>
</html>
