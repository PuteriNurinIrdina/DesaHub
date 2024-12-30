<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DesaHub Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .hero-section {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding: 50px 0;
        }

        .slider-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            will-change: transform;
        }

        .slider-item {
            flex: 0 0 20%;
            padding: 0 15px;
            text-align: center;
            opacity: 0.7; /* dim */
            transition: opacity 0.3s ease;
        }

        .slider-item.active {
            opacity: 1;
        }

        .slider-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .slider-item .text-slider-item {
            margin-top: 10px;
            font-size: 1rem;
            font-weight: bold;
            opacity: 1; 
            color: #333;
            transition: color 0.3s ease;
        }

        .slider-item.active .text-slider-item {
            color: #000;
        }

        /* navigation bar */
        .category-nav {
            margin-top: 10px;
            padding: 0;
            border-top: 2px solid #095c80;;
        }

        .category-nav .nav-item {
            margin: 0 15px;
        }

        .category-nav .nav-link {
            font-size: 1rem;
            color: #555;
            padding: 5px 10px;
            transition: color 0.3s, border-color 0.3s;
            border: none;
            text-decoration: none;
        }

        .category-nav .nav-link.active {
            color: #095c80;
            font-weight: bold;
            border-bottom: 2px solid #095c80;;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* event/product */
        .events-section, .products-section {
            padding: 0;
        }

        .section-title {
            display: inline-block;
            padding: 5px 15px;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 5px;
            color: #025478;
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>
@extends('includes.navbar')

@section('content')

    <!-- slider section -->
    <section class="hero-section container-xxl py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2>Selamat Datang</h2>
                <p>Bina hubungan bersama komuniti melalui pelbagai program menarik dan produk tempatan</p>
            </div>

            <div class="text-center">
                <h6 class="section-title px-3">Kategori</h6>
            </div>

            <!-- events slider -->
            <div class="slider-container" id="events-slider">
                <div class="slider" id="event-slider">
                    <!-- E1 -->
                    <div class="slider-item">
                        <img src="https://mypkd.rurallink.gov.my/img/1.png" alt="Event 1">
                        <div class="text-slider-item active">Latihan Komuniti</div>
                    </div>
                    <!-- E2 -->
                    <div class="slider-item">
                        <img src="https://mypkd.rurallink.gov.my/img/7.png" alt="Event 2">
                        <div class="text-slider-item">ICT</div>
                    </div>
                    <!-- E3 -->
                    <div class="slider-item">
                        <img src="https://mypkd.rurallink.gov.my/img/5.png" alt="Event 3">
                        <div class="text-slider-item">Kesukarelawan</div>
                    </div>
                    <!-- E4 -->
                    <div class="slider-item">
                        <img src="https://mypkd.rurallink.gov.my/img/6.png" alt="Event 4">
                        <div class="text-slider-item">Keusahawanan</div>
                    </div>
                    <!-- E5 -->
                    <div class="slider-item">
                        <img src="https://mypkd.rurallink.gov.my/img/3.png" alt="Event 5">
                        <div class="text-slider-item">Perkhidmatan Setempat</div>
                    </div>
                </div>
            </div>

            <!-- products slider -->
            <div class="slider-container" id="products-slider" style="display: none;">
                <div class="slider" id="product-slider">
                    <!-- P1 -->
                    <div class="slider-item">
                        <img src="https://gratisongkir-storage.com/products/900x900/s8BaxCtmCphS.jpg" alt="Product 1">
                        <div class="text-slider-item">Makanan</div>
                    </div>
                    <!-- P2 -->
                    <div class="slider-item">
                        <img src="https://media.suara.com/pictures/970x544/2022/10/05/78764-ilustrasi-perlengkapan-rumah.jpg" alt="Product 2">
                        <div class="text-slider-item">Kelengkapan Rumah</div>
                    </div>
                    <!-- P3 -->
                    <div class="slider-item">
                        <img src="https://wallpaperaccess.com/full/2489629.jpg" alt="Product 3">
                        <div class="text-slider-item">Fesyen</div>
                    </div>
                    <!-- P4 -->
                    <div class="slider-item">
                        <img src="https://cdn.libur.com.my/2019/06/untitled-design-3-26_27_612166.jpg" alt="Product 4">
                        <div class="text-slider-item">Penjagaan Diri</div>
                    </div>
                    <!-- P5 -->
                    <div class="slider-item">
                        <img src="http://static.republika.co.id/uploads/images/inpicture_slide/mainan-anak-_121108225014-526.jpg" alt="Product 5">
                        <div class="text-slider-item">Mainan</div>
                    </div>
                </div>
            </div>

            <div class="slider-container">
                <ul class="category-nav nav justify-content-center mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" onclick="switchCategory('events')">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="switchCategory('products')">Produk</a>
                    </li>
                </ul>
            </div>

            <div class="text-center mt-4">
                <a href="#about-us" class="btn btn-outline-primary">Ketahui Lebih Lanjut</a>
            </div>
        </div>
    </section>

    <!-- about section -->
    <section id="about-us" class="about-us-section container-xxl py-5" style="margin-bottom: 0;">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="section-title px-3">Tentang Kami</h6>
                <h2 class="mb-4">Apa itu DesaHub?</h2>
            </div>
            <div class="text-center mb-5">
                    <p class="lead text-muted">
                    DesaHub adalah platform komuniti yang dicipta khas untuk mempromosikan program dan produk tempatan. Setiap program dan produk layak mendapat perhatian yang sewajarnya.
                    </p>
                    <p class="text-muted">
                    DesaHub membolehkan komuniti untuk kekal berhubung dengan menyokong perniagaan kecil dan mengambil bahagian dalam program yang diadakan. Sertai sekarang untuk memperkasakan diri dan ekonomi tempatan!</p>
            </div>
        </div>
    </section>

    <!-- events section -->
    <section class="events-section container-xxl py-5">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title px-3">Program</h6>
                <h2 class="mb-5">Akan Datang</h2>
            </div>
            <div class="row g-4">
                @foreach($latestEvents as $event)
                    <div class="col-lg-4 col-md-6">
                        <div class="card event-card">
                            <img src="{{ $event->poster ? asset('storage/' . $event->image) : 'https://via.placeholder.com/300x200' }}" 
                                class="card-img-top" alt="{{ $event->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p class="card-text">{{ $event->desc }}</p>
                                <p class="card-text"><small class="text-muted">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</small></p>
                                <a href="" class="btn btn-primary btn-sm">Sertai</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- products section -->
    <section class="products-section container-xxl py-5">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title px-3">Produk</h6>
                <h2 class="mb-5">Produk Pilihan</h2>
            </div>
            <div class="row g-4">
                @foreach($latestProducts as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="card product-card">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x200' }}" 
                            class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">RM {{ number_format($product->price, 2) }}</p>
                                <a href="" class="btn btn-primary btn-sm">Lihat</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        let activeCategory = 'events';
        let slidingInterval;

        function switchCategory(category) {
        const eventsSlider = document.getElementById('events-slider');
        const productsSlider = document.getElementById('products-slider');

        // Show or hide sliders based on the selected category
        if (category === 'events') {
            eventsSlider.style.display = 'flex';
            productsSlider.style.display = 'none';
            activeCategory = 'events';
        } else if (category === 'products') {
            productsSlider.style.display = 'flex';
            eventsSlider.style.display = 'none';
            activeCategory = 'products';
        }

        // Update the active class for the category navigation
        const navLinks = document.querySelectorAll('.category-nav .nav-link');
        navLinks.forEach((link) => {
            link.classList.remove('active');
            if (link.textContent === (category === 'events' ? 'Program' : 'Produk')) {
                link.classList.add('active');
            }
        });

        // Restart the sliding logic for the active slider
        startSlider();
    }

        function updateActiveItem() {
            const slider = activeCategory === 'events'
                ? document.getElementById('event-slider')
                : document.getElementById('product-slider');

            const items = slider.children;
            const middleIndex = Math.floor(items.length / 2); // Get the middle item's index

            // Remove active class from all items
            Array.from(items).forEach((item, index) => {
                item.classList.remove('active');
                if (index === middleIndex) {
                    item.classList.add('active'); // Highlight the middle item
                }
            });
        }

        function startSlider() {
            clearInterval(slidingInterval);

            const slider = activeCategory === 'events' 
                ? document.getElementById('event-slider') 
                : document.getElementById('product-slider');
            const items = slider.children;

            let isSliding = false;

            function slideNext() {
                if (isSliding) return;
                isSliding = true;

                slider.style.transition = 'transform 0.5s ease-in-out';
                slider.style.transform = 'translateX(-20%)';

                slider.addEventListener(
                    'transitionend',
                    () => {
                        slider.style.transition = 'none';
                        slider.style.transform = 'translateX(0)';
                        slider.appendChild(items[0]); // Move the first item to the end
                        isSliding = false;
                        updateActiveItem(); // Update active item after sliding
                    },
                    { once: true }
                );
            }

            // Update the active item on load
            updateActiveItem();

            // Start sliding at intervals
            slidingInterval = setInterval(slideNext, 2000);
        }

        // Run the slider logic on page load
        document.addEventListener('DOMContentLoaded', startSlider);
    </script>

@endsection
</body>
</html>