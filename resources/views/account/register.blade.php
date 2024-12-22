<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desahub Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
        }

        .container-fluid {
            height: 100vh;
        }

        .right-column, .left-column {
            height: 100%;
        }

        .right-column {
            background: url('https://cdn.wallpapersafari.com/30/85/QZH2ng.jpg') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .right-overlay {
            position: absolute;
            color: white;
            text-align: center;
            padding: 40px;
            border-radius: 10px;
        }

        .left-column {
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .header-logo {
            width: 100%;
            max-width: 150px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
        }

        .form-control {
            height: 40px;
            margin-bottom: 12px;
        }

        .title-label {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            color: #095c80;
        }

        .btn-primary {
            background-color: #025478;
            border: none;
            height: 40px;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #0094d4;
        }

        .existing-acc {
            font-size: 12px;
            color: #0094d4;
            text-decoration: none;
        }

        .left-footer {
            margin-top: 30px;
            font-size: 12px;
            color: #555;
        }

        .field-description {
            font-size: 12px;
            color: #6c757d;
            margin-top: -10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-md-6 left-column">
            <div class="header-logo">
                <img src="https://raw.githubusercontent.com/serinrayuni/coding-project/main/images/desahub.PNG" 
                     alt="DesaHub Logo" class="img-fluid">
            </div>

            <div class="login-card">
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

                <h2 class="title-label">DAFTAR</h2>
                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="form-group mt-4">
                        <label for="fullname" class="form-label">Nama</label>
                        <input type="text" id="fullname" name="fullname" class="form-control" required>
                        @if($errors->has('fullname'))
                            <span class="text-danger">{{ $errors->first('fullname') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">E-mel</label>
                        <div class="field-description">Pilih alamat E-mel yang masih aktif dan boleh diakses.</div>
                        <input type="email" id="email" name="email" class="form-control" placeholder="contoh@email.com" required>
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Kata Laluan</label>
                        <div class="field-description">Pilih Kata Laluan yang mengandungi sekurang-kurangnya 8 karakter.</div>
                        <input type="password" id="password" name="password" class="form-control" required>
                        @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="role" class="form-label">Peranan</label>
                        <div class="field-description">Pilih peranan anda semasa mendaftar.</div>
                        <select id="role" name="role" class="form-control" required>
                            <option value="" disabled selected>Pilih peranan...</option>
                            <option value="peserta">Peserta</option>
                            <option value="penjual">Penjual</option>
                            <option value="admin">PKD Admin</option>
                        </select>
                        @if($errors->has('role'))
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    <div class="text-center mt-3" style="font-size: 15px;">
                        <span>Sudah Daftar Akaun? </span><a href="login" class="existing-acc" style="font-size: 15px">Log Masuk</a>
                    </div>
                </form>
            </div>

            <div class="left-footer">
                <p>oleh Phua Chu Kang</p>
            </div>
        </div>

        <div class="col-md-6 right-column">
            <div class="right-overlay">
                <h2><b>D</b>esa<b>H</b>ub</h2>
                <p>Desa Bina Hubungan</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
</script>
</body>
</html>