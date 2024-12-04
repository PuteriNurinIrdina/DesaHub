<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DesaHub Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;
    }

    .title {
        height: 40px;
    }

    .logo {
        height: 33px;
    }

    .navbar {
        height: 75px;
        background-color: #f9f9f9;
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
        margin-left: 8%;
    }

    .navbar-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .nav-links {
        display: flex;
        gap: 50px;
        margin-right: 8%;
    }

    /* sidebar */
    .sidebar {
      height: 100vh;
      width: 15%;
      background-color: #f9f9f9;
      position: fixed;
      transition: width 0.3s;
    }

    .sidebar .title {
      margin: 5px;
    }

    .sidebar ul {
      padding: 0;
      list-style-type: none;
    }

    .sidebar ul li {
      padding: 10px 20px;
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
      margin: 20px 0 20px;
      padding-left: 20px;
      border-width: 1px;
      border-top: 1px solid #ddd;
    }

    /* header */
    .header {
      margin-left: 15%;
      height: 80px;
      background: #f9f9f9;
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
      border: 2px solid #ffffff;
      object-fit: cover;
      margin-left: 20px;
      margin-right: 30px;
    }

    /* main content */
    .main-contentguest {
        margin: 0;
        padding: 0;
    }

    .main-contentadmin {
      margin-left: 15%;
      padding: 20px;
    }

    .normal-section {
        margin: 10px;
    }

    .general-section {
      margin-top: auto;
      padding: 10px;
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
    }

    .footer-section {
        flex: 1 1 200px; 
        margin: 10px;
    }

    .footer h3 {
        border-bottom: 2px solid #fff; 
        display: inline-block; 
        padding-bottom: 5px;
    }

    .footer .sm {
        margin: 0 10px; 
        color: #fff; 
        text-decoration: none; 
        font-size: 20px;
    }

    /* button */
    .btn-primary {
        background-color: #095c80;
        border: none;
        height: auto;
        margin-top: 20px;
    }

    .btn-primary:hover, .btn-outline-primary:hover {
        background-color: #0094d4;
    }

    .btn-outline-primary {
        border-color: #095c80;
        color: #095c80;
        margin-top: 20px;
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
  </style>
</head>
<body>
@guest
    <!-- Regular User Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid navbar-container">
            <!-- Logo and Title on the Left -->
            <a class="navbar-brand" href="#">
                <img src="https://raw.github.com/serinrayuni/coding-project/main/images/desahub-title.png" 
                     alt="DesaHub Logo" class="title">
                <img src="https://raw.github.com/serinrayuni/coding-project/main/images/desahub-removetitle.png" 
                     alt="DesaHub Logo" class="logo">
            </a>
            <!-- Navbar Links on the Right -->
            <div class="nav-links">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hubungi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-contentguest">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-container">
        <!-- About Section -->
            <div class="footer-section">
            <h3>About DesaHub</h3>
            <p>
                DesaHub is your go-to platform for connecting communities and promoting local events and products.
            </p>
            </div>

            <!-- Contact Section -->
            <div class="footer-section">
            <h3>Contact</h3>
            <p>
                Email: <a href="mailto:support@desahub.com" style="color: #fff; text-decoration: none;">s@desahub.com</a><br>
                Phone: <a href="tel:+123456789" style="color: #fff; text-decoration: none;">+03</a><br>
                Address:
            </p>
            </div>

            <!-- Social Media Section -->
            <div class="footer-section">
            <h3>Follow Us</h3>
            <div style="margin-top: 10px;">
                <a href="#" class="sm">
                <i class="fab fa-facebook"></i> Facebook
                </a><br>
                <a href="#" class="sm">
                <i class="fab fa-twitter"></i> Twitter
                </a><br>
                <a href="#" class="sm">
                <i class="fab fa-instagram"></i> Instagram
                </a>
            </div>
        </div>
  </div>

  <div style="margin-top: 20px; border-top: 1px solid #555; padding-top: 20px; font-size: 14px;">
    &copy; 2024 DesaHub. Hak Cipta Terpelihara.
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
                <div class="normal-section">
                    <li class="section-title">Program
                        <ul>
                            <li><a href="#"><i class="bi-calendar2-event"></i> Lihat Program</a></li>
                            <li><a href="#"><i class="bi-calendar2-plus"></i> Tambah Program</a></li>
                            <li><a href="{{ route('attendance') }}"><i class="bi bi-card-checklist"></i></i> Urus Peserta</a></li>
                        </ul>
                    </li>
                </div>
                <div class="normal-section">
                    <li class="section-title">Produk
                        <ul>
                            <li><a href="#"><i class="bi-bag"></i> Lihat Produk</a></li>
                            <li><a href="#"><i class="bi-bag-plus"></i> Tambah Produk</a></li>
                        </ul>
                    </li>
                </div>
                <div class="general-section">
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
            </ul>
        </nav>

        <!-- Header -->
        <header class="header">
            <img src="https://raw.github.com/serinrayuni/coding-project/main/images/desahub-removetitle.png" 
                    alt="DesaHub Logo" class="logo">
            <div class="user-profile">
                <span>{{ Auth::user()->fullname }}</span>
                <img src="https://via.placeholder.com/300x250" alt="User Avatar">
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
</body>
</html>