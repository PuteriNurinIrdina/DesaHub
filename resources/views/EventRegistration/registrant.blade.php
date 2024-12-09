<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Pendaftar</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #007BFF;
            color: white;
            padding: 40px;
            text-align: center;
            border-bottom: 6px solid #0056b3;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
            font-weight: 500;
        }

        .container {
            padding: 50px;
            margin: auto;
            max-width: 95%;
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
            background-color: #007BFF;
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
            display: block;
            margin: 0 auto;
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
            const table = document.getElementById("registrantTable");
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
    <div class="header">
        <h1>SENARAI PENDAFTAR</h1>
    </div>

    <div class="container">
        <div class="total-count">
            Jumlah Pendaftar: {{ $registrants->count() }}
        </div>

        <div class="search-box">
            <input 
                type="text" 
                id="nameFilter" 
                onkeyup="filterTable()" 
                placeholder="Cari nama pendaftar..." 
            />
        </div>

        @if ($registrants->isEmpty())
            <div class="no-data-message">
                Tiada Pendaftar.
            </div>
        @else
            <div class="attendee-list-wrapper">
                <table class="attendee-list" id="registrantTable">
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
                        @foreach ($registrants as $index => $registrant)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $registrant->name }}</td>
                                <td>{{ $registrant->ic_num }}</td>
                                <td>{{ $registrant->phone_num }}</td>
                                <td>{{ $registrant->gender }}</td>
                                <td>{{ $registrant->address }}</td>
                                <td>{{ $registrant->poscode }}</td>
                                <td>{{ $registrant->email ?? '-' }}</td>
                                <td>{{ $registrant->state }}</td>
                                <td>{{ $registrant->house_category }}</td>
                                <td>{{ $registrant->age_class }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
