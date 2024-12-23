<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Tidak Hadir</title>
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

        .table-title {
            font-size: 28px;
            font-weight: 500;
            color: #007BFF;
            margin-bottom: 30px;
            text-align: center;
        }

        .attendee-list-wrapper {
            width: 100%;
            overflow-x: auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-top: 20px;
        }

        .attendee-list {
            width: 100%;
            border-collapse: collapse;
            font-size: 18px;
        }

        .attendee-list th,
        .attendee-list td {
            text-align: left;
            padding: 18px;
            border: 1px solid #e0e0e0;
        }

        .attendee-list th {
            background-color: #095c80;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 18px;
        }

        .attendee-list td {
            font-size: 18px;
            color: #555;
        }

        .attendee-list tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .attendee-list tr:hover {
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

        .total-count {
            font-size: 22px;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 28px;
            }

            .table-title {
                font-size: 24px;
            }

            .attendee-list th,
            .attendee-list td {
                font-size: 14px;
                padding: 14px;
            }
        }
    </style>
    <script>
        function filterTable() {
            const input = document.getElementById("nameFilter");
            const filter = input.value.toUpperCase();
            const table = document.getElementById("nonAttendeeTable");
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
    <h1>SENARAI PENDAFTAR TIDAK HADIR</h1>
    <br>
        <div class="total-count">
            Jumlah Pendaftar Tidak Hadir: {{ $nonAttendees->count() }}
        </div>

        <div style="margin-bottom: 20px; text-align: center;">
            <input 
                type="text" 
                id="nameFilter" 
                onkeyup="filterTable()" 
                placeholder="Cari nama peserta..." 
                style="width: 50%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 8px;"
            >
        </div>

        @if ($nonAttendees->isEmpty())
            <div class="no-data-message">
                Tiada Peserta Tidak Hadir.
            </div>
        @else
            <div class="attendee-list-wrapper">
                <table class="attendee-list" id="nonAttendeeTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Kad Pengenalan</th>
                            <th>No Telefon</th>
                            <th>Jantina</th>
                            <th>Alamat</th>
                            <th>Poskod</th>
                            <th>Emel</th>
                            <th>Negeri</th>
                            <th>Kategori Rumah</th>
                            <th>Peringkat Umur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nonAttendees as $index => $attendee)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $attendee->name }}</td>
                                <td>{{ $attendee->ic_num }}</td>
                                <td>{{ $attendee->phone_num }}</td>
                                <td>{{ $attendee->gender }}</td>
                                <td>{{ $attendee->address }}</td>
                                <td>{{ $attendee->poscode }}</td>
                                <td>{{ $attendee->email ?? '-' }}</td>
                                <td>{{ $attendee->state }}</td>
                                <td>{{ $attendee->house_category }}</td>
                                <td>{{ $attendee->age_class }}</td>
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