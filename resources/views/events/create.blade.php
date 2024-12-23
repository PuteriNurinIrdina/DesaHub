
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
        }
        .form-container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-container input, .form-container select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #095c80;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #095c80;
        }
    </style>
</head>
<body>
@extends('includes.navbar')
    <div class="form-container">
        <h2>Cipta Program</h2>
        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
            @csrf
            @method('post')
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" placeholder="Nama Program" required>

            <label for="date">Tarikh:</label>
            <input type="date" id="date" name="date" required>

            <label for="state">Negeri:</label>
            <select id="state" name="state_id" required>
                <option value="">-- Pilih Negeri --</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                @endforeach
            </select>

            <label for="city">Bandar:</label>
            <select id="city" name="city_id" required>
                <option value="">-- Pilih Negeri Dahulu --</option>
            </select>

            <label for="type">Kategori:</label>
            <select id="type" name="type">
            <option value="">-- Kategori Program --</option>
            <option value="type1">ICT</option>
            <option value="type2">Keusahawanan</option>
            <option value="type3">Pusat Aktiviti & Pemerkasaan Wanita</option>
            <option value="type4">Pusat Aktiviti Kesukarelawan</option>
            <option value="type5">Pusat Latihan Komuniti</option>
            <option value="type6">Pusat Pengumpulan Produk Usahawan Desa</option>
            <option value="type7">Pusat Perkhidmatan Setempat</option>
            <option value="type8">Lain-Lain</option>
            </select>
                
            <label for="desc">Penerangan:</label>
            <input type="text" id="desc" name="desc" placeholder="Terangkan Tentang Program" required>

            <label for="poster">Poster:</label>
            <input type="file" name="poster" accept="image/png, image/jpeg, image/jpg">

            <button type="submit">Simpan</button>
        </form>

        <script>
            document.getElementById('state').addEventListener('change', function() {
                var stateId = this.value;
                if (!stateId) {
                    document.getElementById('city').innerHTML = '<option value="">-- Pilih Bandar --</option>';
                    return;
                }

                fetch(`/get-cities/${stateId}`)
                    .then(response => response.json())
                    .then(data => {
                        var citySelect = document.getElementById('city');
                        citySelect.innerHTML = '<option value="">-- Pilih Bandar --</option>';
                        data.cities.forEach(function(city) {
                            var option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            citySelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching cities:', error);
                        alert('Unable to load cities. Please try again later.');
                    });
            });

        </script>

    </div>
</body>
</html>


<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create an Event Posting</h1>
    <h2>Enter event details</h2>
   <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error) 
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    </div>

    <form method="post" action="{{route('events.store')}}" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div>
            <label>Name:</label>
            <input type="text" id="name" name="name" placeholder="event name"/>
        </div>
        <br>
        <div>
        <label>Date:</label>
        <input type="date" id="date" name="date" placeholder="event date"/>
        </div>
        <br>
        <div>
        <label>Event Type:</label>
        <select id="type" name="type">
        <option value="sports">Sports</option>
        <option value="workshop">Workshop</option>
        <option value="sem_webinar">Seminar/Webinar</option>
        <option value="religious">Religious Activity</option>
        <option value="fundraiser">Fundraiser</option>
        <option value="festival">Festival</option>
        <option value="educational">Educational</option>
        <option value="others">Others</option>
        </select>
        <br>
        <br>
        <div>
        <label>Description:</label>
        <input type="text" id="desc" name="desc" placeholder="describe the event"/>
        </div>
        <br>
        <div>
            <label>Event Poster:</label>
            <input type="file" name="poster" accept="image/png, image/jpeg, image/jpg">
        </div>

        <br>
        <div>
            <button type="submit">Save Event Informatiom</button>
        </div>
    </form> 
    
</body>
</html>-->