<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
        h2 {
            text-align: center;
            color: #333;
        }
        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-size: 1.1rem;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
        .form-group input[type="file"] {
            padding: 0;
        }
        .form-group img {
            margin-top: 10px;
            border-radius: 5px;
        }
        .error-messages {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }
        .submit-btn {
            background-color: #095c80;
            color: white;
            padding: 10px 30px;
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color:rgb(47, 103, 128);
        }
        .cancel-btn {
            text-align: center;
            margin-top: 20px;
        }
        .cancel-btn a {
            color: #095c80;
            text-decoration: none;
            font-size: 1rem;
        }
        .cancel-btn a:hover {
            text-decoration: underline;
        }
        .admin-navigation {
            text-align: center;
            margin-top: 30px;
        }
        .admin-navigation a {
            display: inline-block;
            margin: 60px;
            width: 220px;
            padding: 10px 20px;
            background-color: #095c80;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        .admin-navigation a:hover {
            background-color: rgb(47, 103, 128);
        }
        .text-danger {
            color: red;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
@extends('includes.navbar')
@section('content')
    <div class="container">
        <h1>Kemas Kini Program</h1>
        <br>
        @if($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="{{ route('event.update', ['event' => $event]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            
            <div class="form-group">
                <label for="name">Nama <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" placeholder="Nama Program" value="{{ $event->name }}" />
            </div>

            <div class="form-group">
                <label for="date">Tarikh <span class="text-danger">*</span></label>
                <input type="date" id="date" name="date" placeholder="Tarikh Program" value="{{ $event->date }}" />
            </div>
            
            <div class="form-group">
            <label for="event_time">Masa <span class="text-danger">*</span></label>
            <input type="time" id="event_time" name="event_time" value="{{ $event->event_time }}" />
            </div>

            <div class="form-group">
            <label for="address">Alamat <span class="text-danger">*</span></label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Masukkan Alamat Penuh" value="{{ $event->address }}" />
            </div>
            
            <div class="form-group">
                <label for="state">Negeri <span class="text-danger">*</span></label>
                <select id="state_id" name="state_id">
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" {{ $event->state_id == $state->id ? 'selected' : '' }}>
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city">Bandar:<span class="text-danger">*</span></label>
                    <select id="city_id" name="city_id" required>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $event->city_id == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
            </div>

            <div class="form-group">
                <label for="type">Kategori <span class="text-danger">*</span></label>
                <select id="type" name="type">
                <!--<option value="sports" {{ request('type') == 'sports' ? 'selected' : '' }}>Sports</option>-->
                    <option value="type1" {{ $event->type == 'type1' ? 'selected' : '' }}>ICT</option>
                    <option value="type2" {{ $event->type == 'type2' ? 'selected' : '' }}>Keusahawanan</option>
                    <option value="type3" {{ $event->type == 'type3' ? 'selected' : '' }}>Pusat Aktiviti & Pemerkasaan Wanita</option>
                    <option value="type4" {{ $event->type == 'type4' ? 'selected' : '' }}>Pusat Aktiviti Kesukarelawan</option>
                    <option value="type5" {{ $event->type == 'type5' ? 'selected' : '' }}>Pusat Latihan Komuniti</option>
                    <option value="type6" {{ $event->type == 'type6' ? 'selected' : '' }}>Pusat Pengumpulan Produk Usahawan Desa</option>
                    <option value="type7" {{ $event->type == 'type7' ? 'selected' : '' }}>Pusat Perkhidmatan Setempat</option>
                    <option value="type8" {{ $event->type == 'type8' ? 'selected' : '' }}>Lain-Lain</option>
                </select>
            </div>

            <div class="form-group">
                <label for="max_participants">Had Peserta</label>
                <input type="number" name="max_participants" id="max_participants" class="form-control" placeholder="Had Peserta" value="{{ $event->max_participants }}" />
            </div>

            <div class="form-group">
                <label for="whatsapp_group_link">Link Group WhatsApp</label>
                <input type="url" name="whatsapp_group_link" id="whatsapp_group_link" class="form-control" value="{{ old('whatsapp_group_link', $event->whatsapp_group_link ?? '') }}" placeholder="Masukkan Link WhatsApp Group"/>
            </div>

            <div class="form-group">
                <label for="desc">Penerangan <span class="text-danger">*</span></label>
                <input type="text" id="desc" name="desc" placeholder="Terangkan Tentang Program" value="{{ $event->desc }}" />
            </div>

            <div class="form-group">
                <label for="poster">Poster <span class="text-danger">*</span></label>
                <input type="file" name="poster" accept="image/png, image/jpeg, image/jpg" />
                @if($event->poster)
                    <p>Current Poster: <img src="{{ $event->poster }}" width="100" /></p>
                @else
                    <p>Tiada Poster</p>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">Simpan</button>
            </div>
        </form>

        <div class="cancel-btn">
            <a href="{{ route('events.index') }}">Batal</a>
        </div>
    </div>
    
    <div class="admin-navigation">
        <a href="{{ route('list.pendaftar', ['event_id' => $event->id]) }}">Lihat Senarai Pendaftar</a>
        <a href="{{ route('list.peserta', ['event_id' => $event->id]) }}">Lihat Kehadiran</a>
        <a href="{{ route('non.attendees', ['event_id' => $event->id]) }}">Lihat Ketidakhadiran</a>
        <a href="{{ route('attendance.page', ['event_id' => $event->id]) }}">Tanda Kehadiran</a>
    </div>

    <script>
        // When the state dropdown changes, fetch the cities for the selected state
        document.getElementById('state_id').addEventListener('change', function() {
            var stateId = this.value;
            var cityDropdown = document.getElementById('city_id');
            
            // Reset city dropdown
            cityDropdown.innerHTML = '<option value="">-- Pilih Bandar --</option>';

            if (!stateId) return;

            // Fetch cities for the selected state
            fetch(`/get-cities/${stateId}`)
                .then(response => response.json())
                .then(data => {
                    data.cities.forEach(function(city) {
                        var option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        cityDropdown.appendChild(option);
                    });

                    // Pre-select city if already exists
                    @if($event->city_id)
                        cityDropdown.value = '{{ $event->city_id }}';
                    @endif
                })
                .catch(error => console.error('Error fetching cities:', error));
        });
        flatpickr("#event_time", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                });
    </script>
@endsection
</body>
</html>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event Posting</h1>
    <h2>Edit event details</h2>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ route('event.update', ['event' => $event]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div>
            <label>Name:</label>
            <input type="text" id="name" name="name" placeholder="Event Name" value="{{ $event->name }}" />
        </div>
        <br>
        <div>
            <label>Date:</label>
            <input type="date" id="date" name="date" placeholder="Event Date" value="{{ $event->date }}" />
        </div>
        <br>
        <div>
            <label>Event Type:</label>
            <select id="type" name="type">
                <option value="sports" {{ $event->type == 'sports' ? 'selected' : '' }}>Sports</option>
                <option value="workshop" {{ $event->type == 'workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="sem_webinar" {{ $event->type == 'sem_webinar' ? 'selected' : '' }}>Seminar/Webinar</option>
                <option value="religious" {{ $event->type == 'religious' ? 'selected' : '' }}>Religious Activity</option>
                <option value="fundraiser" {{ $event->type == 'fundraiser' ? 'selected' : '' }}>Fundraiser</option>
                <option value="festival" {{ $event->type == 'festival' ? 'selected' : '' }}>Festival</option>
                <option value="educational" {{ $event->type == 'educational' ? 'selected' : '' }}>Educational</option>
                <option value="others" {{ $event->type == 'others' ? 'selected' : '' }}>Others</option>
            </select>
        </div>
        <br>
        <div>
            <label>Description:</label>
            <input type="text" id="desc" name="desc" placeholder="Describe the event" value="{{ $event->desc }}" />
        </div>
        <br>
        <div>
            <label>Event Poster:</label>
            <input type="file" name="poster" accept="image/png, image/jpeg, image/jpg" />
            @if($event->poster)
                <p>Current Poster: <img src="{{ asset('storage/posters' . $event->poster) }}" width="100" /></p>
                <p>Image URL: {{ asset('storage/' . $event->poster) }}</p>
            @else
                <p>No Poster Available</p>
            @endif
        </div>
        <br>
        <div>
            <button type="submit">Update Event</button>
        </div>
    </form>
</body>
</html>
-->