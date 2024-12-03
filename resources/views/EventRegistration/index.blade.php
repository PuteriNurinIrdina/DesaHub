<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pengunjung</title>
</head>
<body>
    <h1>PENDAFTARAN PENGUNJUNG</h1>
    <p style="color: red; font-weight: bold;">Sila Pastikan Maklumat Pendaftaran Anda Adalah Sahih</p>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div>
        <form method="post" action="{{ route('register.store') }}">
            @csrf
            @method('post')
            <label for="ic_num">No Kad Pengenalan:</label>
            <input type="text" id="ic_num" name="ic_num" placeholder="cth: 040520141234" required/>
            <br><br>
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" placeholder="cth: Abu bin Ali" required/>
            <br><br>
            <label for="phone_num">No Telefon Bimbit:</label>
            <input type="text" id="phone_num" name="phone_num" placeholder="cth: 01123456789" required/>
            <br><br>
            <label for="gender">Jantina:</label>
            <select id="gender" name="gender" required>
                <option value="" disabled selected>Pilih Jantina</option>
                <option value="Lelaki">Lelaki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <br><br>
            <label for="address">Alamat:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
            <br><br>
            <label for="poscode">Poskod:</label>
            <input type="text" id="poscode" name="poscode" placeholder = "cth: 81300" required>
            <br><br>
            <label for="state">Negeri:</label>
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
            <br><br>
            <label for="email">Emel (jika ada):</label>
            <input type="email" id="email" name="email" placeholder="cth: aliabu@gmail.com">
            <br><br>
            <label for="house_category">Kategori Isi Rumah:</label>
            <select id="house_category" name="house_category" required>
                <option value="" disabled selected>Pilih Kategori Isi Rumah</option>
                <option value="B40">B40</option>
                <option value="M40">M40</option>
                <option value="T20">T20</option>
            </select>
            <br><br>
            <label for="age_class">Kategori Peringkat Umur:</label>
            <select id="age_class" name="age_class" required>
                <option value="" disabled selected>Peringkat Umur</option>
                <option value="Bawah 18 Tahun">Bawah 18 Tahun</option>
                <option value="18-30 Tahun">18-30 Tahun</option>
                <option value="31-50 Tahun">31-50 Tahun</option>
                <option value="50 Tahun ke Atas">50 Tahun ke Atas</option>
            </select>
            <br><br>
            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>
