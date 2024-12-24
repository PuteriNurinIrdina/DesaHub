
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        .form-container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
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
        .text-danger {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
@extends('includes.navbar')
@section('content')

    <div class="form-container">
        
        <h1>Cipta Program</h1>
        <br>
        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
            @csrf
            @method('post')
            <label for="name">Nama:<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" placeholder="Nama Program" required>
            

            <label for="date">Tarikh:<span class="text-danger">*</span></label>
            <input type="date" id="date" name="date" required>

            <label for="state">Negeri:<span class="text-danger">*</span></label>
            <select id="state" name="state_id" required>
                <option value="">-- Pilih Negeri --</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                @endforeach
            </select>

            <label for="city">Bandar:<span class="text-danger">*</span></label>
            <select id="city" name="city_id" required>
                <option value="">-- Pilih Negeri Dahulu --</option>
            </select>

            <label for="type">Kategori:<span class="text-danger">*</span></label>
            <select id="type" name="type" required>
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
            <input type="text" id="desc" name="desc" placeholder="Terangkan Tentang Program" required >

            <label for="poster">Poster:<span class="text-danger">*</span></label>
            <input type="file" name="poster" accept="image/png, image/jpeg, image/jpg" required>

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
    @endsection
</body>
</html>

<<<<<<< HEAD

=======
>>>>>>> aa6f2a830e92cb40050275a0e6d2ed42f58206d1
