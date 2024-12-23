<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Acara Didaftarkan</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        } 

        .total-count {
            font-size: 22px;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .table-title {
            font-size: 28px;
            font-weight: 500;
            color: #007BFF;
            margin-bottom: 30px;
            text-align: center;
        }

        .search-box {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-box input {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .event-list-wrapper {
            width: 100%;
            overflow-x: auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-top: 20px;
        }

        .event-list {
            width: 100%;
            border-collapse: collapse;
            font-size: 18px;
        }

        .event-list th,
        .event-list td {
            text-align: left;
            padding: 18px;
            border: 1px solid #e0e0e0;
        }

        .event-list th {
            background-color: #095c80;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 18px;
        }

        .event-list td {
            font-size: 18px;
            color: #555;
        }

        .event-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .event-list tr:hover {
            background-color: #e6f2ff;
        }

        .no-data-message {
            text-align: center;
            padding: 40px;
            font-size: 22px;
            color: #555;
            background-color: #f7f9fc;
            border: 1px solid #d0d7de;
            border-radius: 10px;
        }

        @media (max-width: 1200px) {
            .header h1 {
                font-size: 32px;
            }

            .table-title {
                font-size: 26px;
            }

            .event-list th,
            .event-list td {
                font-size: 16px;
                padding: 16px;
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 28px;
            }

            .table-title {
                font-size: 24px;
            }

            .event-list th,
            .event-list td {
                font-size: 14px;
                padding: 14px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 24px;
            }

            .table-title {
                font-size: 20px;
            }

            .event-list th,
            .event-list td {
                font-size: 12px;
                padding: 12px;
            }
        }
    </style>
    <script>
        function filterTable() {
            const input = document.getElementById("eventFilter");
            const filter = input.value.toUpperCase();
            const table = document.getElementById("eventTable");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName("td")[1]; 
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
                }
            }
        }
    </script>
</head>
<body>
@extends('includes.navbar')
@section('content')

    <div class="container">
    <h1>SENARAI PROGRAM BERDAFTAR</h1>
    <br>

        <div class="total-count">
            Jumlah Acara Didaftarkan: {{ $events->count() }}
        </div>

        <div class="search-box">
            <input 
                type="text" 
                id="eventFilter" 
                onkeyup="filterTable()" 
                placeholder="Cari nama acara..." 
            />
        </div>

        @if ($events->isEmpty())
            <div class="no-data-message">
                Tiada Acara Didaftarkan.
            </div>
        @else
            <div class="event-list-wrapper">
                <table class="event-list" id="eventTable">
                    <thead>
                        <tr>
                            <th>No</th> 
                            <th>Nama Acara</th>
                            <th>Tarikh</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $index => $event)
                            <tr>
                                <td>{{ $index + 1 }}</td> 
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->date }}</td>
                                <td>{{ $event->location }}</td>
                                <td>{{ $event->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
</body>
</html>
