<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Pengunjung</title>
    <style>

        p {
            text-align: center;
            color: #d9534f;
            font-weight: bold;
        }
        .back-link {
            color: #095c80;
            text-decoration: none;
            font-size: 16px;
        }

        .back-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .back-link i {
            margin-right: 5px;  
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            color: #0056b3;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #0056b3;
            background-color: #ffffff;
        }

        button {
            background-color: #0056b3;
            color: #ffffff;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #004494;
        }

        .error-container {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .error-container ul {
            padding-left: 20px;
        }

        .error-container li {
            margin: 5px 0;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .success-container {
            display: none;
            background-color: #4CAF50; 
            color: white; 
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px; 
            text-align: center; 
            font-size: 16px; 
            width: 100%; 
            max-width: 600px; 
            margin-left: auto;
            margin-right: auto;
        }
        .required {
            color: red;
            font-size: 18px;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
@extends('includes.navbar')
@section('content')
<div class="container">
<b><a href="{{ url()->previous() }}"  class="back-link"><i class="fas fa-arrow-left"></i> Kembali</a><b>
    <h1>PENDAFTARAN PENGUNJUNG</h1>
    <br>
    <p>Sila Pastikan Maklumat Pendaftaran Anda Adalah Sahih</p>

<div id="success-message" class="success-container" style="display: none;"></div>


    @if ($errors->any())
    <div class="error-container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-container">
    <form id="registration-form" method="post" action="{{ route('register.store') }}">
    @csrf
    @method('post')

    <label for="ic_num">No Kad Pengenalan:<span class="required"> *</span></label>
<input type="text" id="ic_num" name="ic_num" placeholder="cth: 040520141234" required />
<div id="ic_num-error" class="error-container" style="display: none;"></div> <!-- Error Message -->

<label for="name">Nama:<span class="required"> *</span></label>
<input type="text" id="name" name="name" placeholder="cth: Abu bin Ali" required />
<div id="name-error" class="error-container" style="display: none;"></div> <!-- Error Message -->

<label for="phone_num">No Telefon Bimbit:<span class="required"> *</span></label>
<input type="text" id="phone_num" name="phone_num" placeholder="cth: 01123456789" required />
<div id="phone_num-error" class="error-container" style="display: none;"></div> <!-- Error Message -->

<label for="gender">Jantina:<span class="required"> *</span></label>
<select id="gender" name="gender" required>
    <option value="" disabled selected>Pilih Jantina</option>
    <option value="Lelaki">Lelaki</option>
    <option value="Perempuan">Perempuan</option>
</select>
<div id="gender-error" class="error-container" style="display: none;"></div> <!-- Error Message -->

<label for="address">Alamat:<span class="required"> *</span></label>
<textarea id="address" name="address" rows="4" required></textarea>
<div id="address-error" class="error-container" style="display: none;"></div> <!-- Error Message -->

<label for="poscode">Poskod:<span class="required"> *</span></label>
<input type="text" id="poscode" name="poscode" placeholder="cth: 81300" required />
<div id="poscode-error" class="error-container" style="display: none;"></div> <!-- Error Message -->

<label for="state">Negeri:<span class="required"> *</span></label>
<select id="state" name="state" required>
    <option value="" disabled selected>Pilih Negeri</option>
    <option value="Johor">Johor</option>
    <option value="Kedah">Kedah</option>
    <option value="Kelantan">Kelantan</option>
    <option value="Malacca">Melaka</option>
    <option value="Negeri Sembilan">Negeri Sembilan</option>
    <option value="Pahang">Pahang</option>
    <option value="Penang">Pulau Pinang</option>
    <option value="Perak">Perak</option>
    <option value="Perlis">Perlis</option>
    <option value="Sabah">Sabah</option>
    <option value="Sarawak">Sarawak</option>
    <option value="Selangor">Selangor</option>
    <option value="Terengganu">Terengganu</option>
    <option value="KL">Wilayah Persekutuan Kuala Lumpur</option>
    <option value="Labuan">Wilayah Persekutuan Labuan</option>
    <option value="Putrajaya">Wilayah Persekutuan Putrajaya</option>
</select>
<div id="state-error" class="error-container" style="display: none;"></div> <!-- Error Message -->
<br><br>
<label for="email">Emel (jika ada):</label>
<input type="email" id="email" name="email" placeholder="cth: aliabu@gmail.com" />
<div id="email-error" class="error-container" style="display: none;"></div> <!-- Error Message -->

<label for="house_category">Kategori Isi Rumah:<span class="required"> *</span></label>
<select id="house_category" name="house_category" required>
    <option value="" disabled selected>Pilih Kategori Isi Rumah</option>
    <option value="B40">B40</option>
    <option value="M40">M40</option>
    <option value="T20">T20</option>
</select>
<div id="house_category-error" class="error-container" style="display: none;"></div> <!-- Error Message -->

<label for="age_class">Kategori Peringkat Umur:<span class="required"> *</span></label>
<select id="age_class" name="age_class" required>
    <option value="" disabled selected>Peringkat Umur</option>
    <option value="Bawah 18 Tahun">Bawah 18 Tahun</option>
    <option value="18-30 Tahun">18-30 Tahun</option>
    <option value="31-50 Tahun">31-50 Tahun</option>
    <option value="50 Tahun ke Atas">50 Tahun ke Atas</option>
</select>
<div id="age_class-error" class="error-container" style="display: none;"></div> 
    
<button type="submit" class="btn btn-submit" style="margin-top:15px;">Daftar</button>

</form>

    </div>
</div>

    <script>
    const form = document.querySelector('#registration-form');
    const successMessageContainer = document.createElement('div'); 
    successMessageContainer.classList.add('alert-success'); 

    form.addEventListener('submit', async (event) => {
    event.preventDefault();

    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        const result = await response.json();

        const errorContainers = document.querySelectorAll('.error-container');
        errorContainers.forEach(container => container.style.display = 'none');

        const successMessageContainer = document.getElementById('success-message');

        if (result.status === 'success') {
            successMessageContainer.innerText = result.message;
            successMessageContainer.style.display = 'block';

            form.reset();
        } else if (result.errors) {
            for (let field in result.errors) {
                const errorMessage = result.errors[field];
                const errorContainer = document.getElementById(`${field}-error`);
                if (errorContainer) {
                    errorContainer.innerText = errorMessage;
                    errorContainer.style.display = 'block'; 
                }
            }
        } else {
            const errorMessageContainer = document.createElement('div');
            errorMessageContainer.classList.add('error-container');
            errorMessageContainer.innerText = 'Ralat berlaku. Sila cuba lagi.';
            document.body.insertBefore(errorMessageContainer, form);
        }
    } catch (error) {
        console.error('Ralat semasa menghantar pendaftaran:', error);
        const errorMessageContainer = document.createElement('div');
        errorMessageContainer.classList.add('error-container');
        errorMessageContainer.innerText = 'Ralat yang tidak dijangka berlaku.';
        document.body.insertBefore(errorMessageContainer, form);
    }
});




</script>
@endsection
</body>
</html>
