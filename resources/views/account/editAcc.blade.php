<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DesaHub Dashboard - Tetapan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-tabs-container {
            background-color: #fff;
            text-align: left;
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
            text-align: left;
        }

        .nav-tabs .nav-link {
            border: none;
            border-radius: 0;
            color: #495057;
        }

        .nav-tabs .nav-link.active {
            border-bottom: 3px solid #007bff;
            color: #007bff;
            font-weight: bold;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .profile-picture {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
@extends('includes.navbar')
@section('content')

    <div class="container">
        <h1>Tetapan Akaun</h1>
    <br>
    @if(session()->has("success"))
                    <div class="alert alert-success">
                        {{ session()->get("success") }}
                    </div>
                @endif

                @if(session()->has("error"))
                    <div class="alert alert-danger">
                        {{ session()->get("error") }}
                    </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        <div class="nav-tabs-container">
            <ul class="nav nav-tabs mt-4" id="settingsTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#kemaskini" data-bs-toggle="tab">Kemaskini Maklumat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tukarKataLaluan" data-bs-toggle="tab">Tukar Kata Laluan</a>
                </li>
            </ul>
        </div>

        <!-- Content Sections -->
        <div class="tab-content mt-4">
            <!-- Kemaskini Maklumat Section -->
            <div class="tab-pane fade show active" id="kemaskini">
                <h3>Kemaskini Maklumat</h3>
                <form method="POST" action="{{ route('editAcc.post') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Nama</label>
                                <input type="text" id="fullname" name="fullname" class="form-control" value="{{ $account->fullname }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-Mel</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $account->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nombor Telefon</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ $account->phone }}">
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <img src="{{ $account->profile_picture ? asset('storage/' . $account->profile_picture) : 'https://via.placeholder.com/300x250' }}" class="profile-picture mb-3" id="profileImage" alt="Profile Picture">
                            <input type="file" id="uploadImage" name="profile_picture" class="d-none" accept="image/*" onchange="previewImage(event)">
                            <button type="button" class="btn btn-outline-secondary w-100" onclick="document.getElementById('uploadImage').click();">Tukar Gambar</button>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <button type="button" class="btn btn-outline-primary" onclick="window.history.back();">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

            <!-- Tukar Kata Laluan Section -->
            <div class="tab-pane fade" id="tukarKataLaluan">
                <h3>Tukar Kata Laluan</h3>
                <form method="POST" action="{{ route('changePassword') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Kata Laluan Sekarang</label>
                        <input type="password" id="currentPassword" name="current_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Kata Laluan Baru</label>
                        <input type="password" id="newPassword" name="new_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Sahkan Kata Laluan Baru</label>
                        <input type="password" id="confirmPassword" name="confirm_password" class="form-control">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const image = document.getElementById('profileImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
</body>

</html>