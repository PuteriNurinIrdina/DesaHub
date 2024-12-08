<!doctype html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desahub Reset Kata Laluan</title>
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

    .left-column {
        background: url('https://cdn.wallpapersafari.com/30/85/QZH2ng.jpg') no-repeat center center/cover;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        height: 100%;
    }

    .left-overlay {
        position: absolute;
        color: white;
        text-align: center;
        padding: 40px;
        border-radius: 10px;
    }

    .right-column {
        background-color: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        height: 100%;
    }

    .header-logo {
        width: 100%;
        max-width: 150px;
        margin-top: 20px;
        margin-bottom: 15px;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
    }

    .form-control {
        height: 40px;
        margin-bottom: 15px;
    }

    .title-label {
      font-size: 32px;
      font-weight: bold;
      text-align: center;
      color: #025478;
      margin-bottom: 50px;
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

    .right-footer {
        margin-top: 30px;
        font-size: 12px;
        color: #555;
    }

    .info-text {
        font-size: 17px;
        margin-top: -10px;
        margin-bottom: 15px;
    }
    </style>
</head>
<body>

<div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-md-6 col-12 left-column">
            <div class="left-overlay">
                <h2><b>D</b>esa<b>H</b>ub</h2>
                <p>Desa Bina Hubungan</p>
            </div>
        </div>

        <div class="col-md-6 col-12 right-column">
            <div class="header-logo">
                <img src="https://raw.githubusercontent.com/serinrayuni/coding-project/main/images/desahub.PNG" 
                     alt="DesaHub Logo" class="img-fluid">
            </div>

            <div class="login-card">
                @if(session()->has("success"))
                    <div class="alert alert-success">
                        {{session()->get("success")}}
                    </div>
                @endif

                @if(session()->has("error"))
                    <div class="alert alert-danger">
                        {{session()->get("error")}}
                    </div>
                @endif
                <h2 class="title-label">Tetapan Semula</h2>
                
                <form method="POST" action="{{ route('resetpassword.post') }}">
                    @csrf
                    <div class="form-group">
                        <p class="info-text">Sila masukkan alamat E-mel yang anda gunakan untuk akaun ini. Pautan tetapan semula kata laluan akan dihantar ke E-mel anda.</p>
                        <label for="email" class="form-label">E-mel</label>
                        <input type="email" id="email" name="email" class="form-control" required autofocus>
                        @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Hantar</button>
                </form>
            </div>

            <div class="right-footer">
                <p>oleh Phua Chu Kang</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>
</body>
</html>