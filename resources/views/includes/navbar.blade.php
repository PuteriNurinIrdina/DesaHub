<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DesaHub Nav</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
    }

    h1 {
        background-color: #095c80; 
        color: white; 
        padding: 20px 0;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        margin: 0;
        font-size: 24px;
    }

    .title {
        height: 40px;
    }

    .logo {
        height: 33px;
    }

    .navbar {
        top: 0;
        width: 100%;
        height: 75px;
        z-index: 1000;
        background-color: #ffffff;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        position: fixed;
        align-items: center;
        justify-content: space-between;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .log-reg {
        display: flex;
        align-items: center;  
        justify-content: center; 
        gap: 0.5rem;
        padding: 1rem;
    }

    .navbar-nav .nav-link {
        font-size: 1.1rem;
        font-weight: 600;
        color: #005a81;
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #0094d4;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-links {
        display: flex;
        gap: 50px;
    }

    .navbar-collapse.show {
        position: absolute;
        top: 75px;
        left: 0;
        width: 100%;
        background-color: #ffffff;
        z-index: 1000;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* sidebar */
    .sidebar {
        height: 100vh;
        width: 15%;
        background-color: #ffffff;
        position: fixed;
        transition: width 0.3s;
        overflow-y: auto;
        scrollbar-width: thin;
    }

    .sidebar .title {
        margin: 5px;
        margin-bottom: 20px;
    }

    .sidebar ul {
        padding: 0;
        list-style-type: none;
    }

    .sidebar ul li {
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .sidebar ul li a {
        text-decoration: none;
        font-size: 14px;
        color: #000000;
        font-weight: 500;
        display: block;
    }

    .sidebar .section-title {
        font-size: 15px;
        color: #525252;
        margin: 10px 0 20px;
        padding-left: 10px;
        border-width: 1px;
        border-top: 1px solid #ddd;
    }

    /* header */
    .header-bar {
        margin-left: 15%;
        height: 80px;
        background: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0;
        color: #000000;
    }

    .user-profile {
        display: flex;
        align-items: center;
    }

    .user-profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #f9f9f9;
        object-fit: cover;
        margin-left: 20px;
        margin-right: 30px;
    }

    /* main content */
    .main-contentguest {
        padding: 20px;
        padding-top: 90px;
        transition: padding-top 0.1s ease;
    }

    .main-contentadmin {
        margin-left: 15%;
        padding: 20px;
    }

    .normal-section {
        margin: 10px;
    }

    /* footer */
    .footer {
        background-color: #095c80; 
        color: #fff; 
        padding: 40px 20px; 
        text-align: center;
    }

    .footer-container {
        max-width: 1000px; 
        margin: 0 auto; 
        display: flex; 
        flex-wrap: wrap; 
        justify-content: space-between;
        gap: 20px;
    }

    .footer-section {
        flex: 1 1 200px; 
        margin: 10px;
    }

    .footer h3 {
        border-bottom: 2px solid #fff; 
        display: inline-block; 
        padding-bottom: 5px;
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: 700;
    }

    .footer-section p, .footer-section ul, .footer-section li {
  font-size: 14px;
  line-height: 1.6;
  margin: 5px 0;
}

.footer-section a {
    font-size: 14px;
  color: #ffffff; 
  text-decoration: none;
}

.footer-section a:hover {
  text-decoration: underline;
  color: #cce6f5;
}

.footer-bottom {
  margin-top: 20px; 
  border-top: 1px solid #ffffff; 
  padding-top: 10px;
  font-size: 10px;
}

.social-icons {
  display: flex;
  flex-direction: column;
}

.sm-link {
  font-size: 14px;
  text-decoration: none;
  color: #ffffff;
  display: flex;
  align-items: center;
}

.sm-link:hover {
  color: #cce6f5;
}

    /* button */

    .btn-primary {
        background-color: #095c80;
        border: none;
    }

    .btn-submit {
        background-color: #095c80;
        color: #ffffff;
    }

    .btn-primary:hover, .btn-submit:hover, .btn-outline-primary:hover {
        background-color: #0094d4;
    }

    .btn-outline-primary {
        border-color: #095c80;
        color: #095c80;
    }
    
    .btn-link {
        background: none;
        border: none;
        color: #d51900;
        text-decoration: none;
        cursor: pointer;
        padding: 0;
        font-size: inherit;
    }

    .btn-link:hover {
        color: #ff1e00;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .navbar-collapse {
            position: absolute;
            top: 75px;
            left: 0;
            width: 100%;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin: 0 auto;
        }

        .main-content {
            margin-left: 0;
        }

        .log-reg {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem;
        }
    }
  </style>
</head>
<body>
<!-- Guest Navbar -->
@guest
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://raw.github.com/serinrayuni/coding-project/main/images/desahub-title.png" 
                    alt="DesaHub Logo" class="title">
                <img src="https://raw.github.com/serinrayuni/coding-project/main/images/desahub-removetitle.png" 
                    alt="DesaHub Logo" class="logo">
            </a>

            <button class="navbar-toggler position-absolute end-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Utama</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Program</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('product.view') }}">Produk</a></li>
                </ul>
                <div class="log-reg">
                    <a href="/login" class="btn btn-outline-primary">Log Masuk</a>
                    <a href="/register" class="btn btn-primary">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

<!-- Main Content -->
<main class="main-contentguest">
<br>
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            
        </div>

        <div class="footer-section">
        <h3>Hubungi</h3>
        <ul class="list-unstyled">
            <li>E-mel: <a href="mailto:support@desahub.com" class="footer-link">support@desahub.com</a></li>
            <li>Nombor Telefon: <a href="tel:+123456789" class="footer-link">+03-12345678</a></li>
            <li>Alamat: Jalan Teluk Mahkota,Kampung Sri Gading, Tanjung Sedili, 81910 Kota Tinggi, Johor</li>
        </ul>
        </div>

        <div class="footer-section">
            <h3>Ikuti</h3>
            <div class="social-icons">
                <a href="#" class="sm"><i class="fab fa-facebook"></i> Facebook</a><br>
                <a href="#" class="sm"><i class="fab fa-instagram"></i> Instagram</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
    <p>&copy; 2024 DesaHub. All Rights Reserved.</p>
  </div>
</footer>
@endguest

@auth
    <div>
        <!-- Sidebar -->
        <nav class="sidebar">
        <div class="text-center mt-3" style="margin-bottom: 0; margin-left: 5%;">
            <img src="https://raw.github.com/serinrayuni/coding-project/main/images/desahub-title.png" 
                alt="DesaHub Logo" class="title">
        </div>

        <ul>

            <div class="normal-section">
                    <li class="dashboard"><a href="{{ route('dashboard') }}"><i class="bi-house"></i> Dashboard</a></li>
            </div>

            <!-- Normal User Sidebar -->
            @if(Auth::user()->role === 'peserta')
            <div class="normal-section">
                <li class="section-title">Cari
                    <ul>
                        <li><a href="#"><i class="bi-calendar2-event"></i> Program</a></li>
                        <li><a href="{{ route('product.view') }}"><i class="bi-bag"></i> Produk</a></li>
                    </ul>
                </li>

                <li class="section-title">Lain-lain
                    <ul>
                        <li><a href="{{ route('editAcc') }}"><i class="bi-gear"></i> Tetapan</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <i class="bi-box-arrow-left"></i>
                                <button type="submit" class="btn-link"> Log Keluar</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </div>
                

            <!-- Seller Sidebar -->
            @elseif(Auth::user()->role === 'penjual')
            <div class="normal-section">
                <li class="section-title">Produk
                    <ul>
                        <li><a href="{{ route('product.index') }}"><i class="bi-bag"></i> Lihat Produk</a></li>
                        <li><a href="{{ route('product.create') }}"><i class="bi-bag-plus"></i> Tambah Iklan</a></li>
                    </ul>
                </li>

                <li class="section-title">Lain-lain
                    <ul>
                        <li><a href="{{ route('editAcc') }}"><i class="bi-gear"></i> Tetapan</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <i class="bi-box-arrow-left"></i>
                                <button type="submit" class="btn-link"> Log Out</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </div>

            <!-- Admin Sidebar -->
            @elseif(Auth::user()->role === 'admin')
            <div class="normal-section">
                <li class="section-title">Program
                    <ul>
                        <li><a href="#"><i class="bi-calendar2-event"></i> Lihat Program</a></li>
                        <li><a href="#"><i class="bi-calendar2-plus"></i> Tambah Program</a></li>
                        <li><a href="#"><i class="bi bi-card-checklist"></i></i> Urus Peserta</a></li>
                    </ul>
                </li>

                <li class="section-title">Produk
                    <ul>
                        <li><a href="{{ route('product.index') }}"><i class="bi-bag"></i> Lihat Produk</a></li>
                        <li><a href="{{ route('product.create') }}"><i class="bi-bag-plus"></i> Tambah Iklan</a></li>
                    </ul>
                </li>

                <li class="section-title">Lain-lain
                    <ul>
                        <li><a href="{{ route('editAcc') }}"><i class="bi-gear"></i> Tetapan</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <i class="bi-box-arrow-left"></i>
                                <button type="submit" class="btn-link"> Log Out</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </div>
            @endif
        </ul>
        </nav>

        <!-- Header -->
        <header class="header-bar">
        <img src="https://raw.github.com/serinrayuni/coding-project/main/images/desahub-removetitle.png" 
            alt="DesaHub Logo" class="logo">
        <div class="user-profile">
            <span>{{ Auth::user()->fullname }}</span>
            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://via.placeholder.com/300x250' }}" alt="User Avatar">
        </div>
        </header>

        <!-- Main Content Area -->
        <main class="main-contentadmin">
        @yield('content')
        </main>
    </div>
@endauth

  <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const navbar = document.querySelector('.navbar');
        const collapse = document.querySelector('.navbar-collapse');
        const content = document.querySelector('.main-contentguest');

        const adjustContentPadding = () => {
            const navbarHeight = navbar.offsetHeight;
            const collapseHeight = collapse.classList.contains('show') ? collapse.offsetHeight : 0;
            content.style.paddingTop = `${navbarHeight + collapseHeight}px`;
        };

        // Adjust padding on menu toggle
        collapse.addEventListener('shown.bs.collapse', adjustContentPadding);
        collapse.addEventListener('hidden.bs.collapse', adjustContentPadding);

        // Adjust on load and window resize
        adjustContentPadding();
        window.addEventListener('resize', adjustContentPadding);
    });
</script>



</body>
</html>