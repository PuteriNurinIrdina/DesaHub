<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name= "viewport" content="width=device-width, initial-scale=1.0">
        <title>All Products</title>
        <style>

            .container {
                max-width: 1200px;
                margin: 40px auto;
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: space-between;
            }

            .product-card {
                width: calc(33.33% - 20px);
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba (0,0,0,0.1);
                overflow: hidden;
                text-align: center;
                transition: transform 0.3s ease;
            }

            .product-card:hover {
                transform: scale(1.05);
            }

            .product-card img {
                width: 100%;
                height: 250px;
                object-fit: cover;
                border-bottom: 1px solid #ddd;
            }

            .product-card .product-info {
                padding: 15px;
            }

            .product-card h3 {
                font-size: 1.5em;
                margin-bottom: 10px;
                color: #333;
            }

            .product-card p {
                font-size: 1em;
                margin-bottom: 10px;
                color: #555;
            }

            .product-card .price {
                font-size: 1.2em;
                font-weight: bold;
                color: #E74C3C;
            }

            .product-card a {
                color: black;
                text-decoration: none;
            }

            .product-card a:hover {
                text-decoration: none;
                color: #333;
            }

            .category-select {
                margin-bottom: 20px;
                padding: 10px;
                border-radius: 4px;
                border: 1px solid #ced4da;
            }

            .reset-filter-btn {
                padding:10px;
                background-color: #f0f0f0;
                border: 1px solid #ddd;
                border-radius: 4px;
                text-decoration: none;
                color: #333;
                margin-left: 10px;
            }

            .reset-filter-btn:hover {
                background-color: #e0e0e0;
            }

            </style>
    </head>

    <body>
    @extends('includes.navbar')
    @section('content')
    
        <h1>Produk Terkini</h1>

        <form method="GET" action="{{ route('product.view')}}">
            <select name="category" class="category-select">
                <option value="runcit" {{ request('category') == 'runcit' ? 'selected' : ''}}>Barangan Runcit</option>
                <option value="kesihatan" {{ request('category') == 'kesihatan' ? 'selected' : ''}}>Kesihatan & Kecantikan</option>
                <option value="rumah" {{ request('category') == 'rumah' ? 'selected' : ''}}>Kelengkapan Rumah</option>
                <option value="bayi" {{ request('category') == 'bayi' ? 'selected' : ''}}>Bayi, Kanak-kanak & Mainan</option>
                <option value="fesyen_wanita" {{ request('category') == 'fesyen_wanita' ? 'selected' : ''}}>Fesyen Wanita</option>
                <option value="fesyen_lelaki" {{ request('category') == 'fesyen_lelaki' ? 'selected' : ''}}>Fesyen Lelaki</option>                    <option value="Automotif">Automotif</option>
                <option value="haiwan" {{ request('category') == 'haiwan' ? 'selected' : ''}}>Haiwan Peliharaan</option>
                <option value="lainlain" {{ request('category') == 'lainlain' ? 'selected' : ''}}>Lain-lain</option>
            </select>
            <select name="sort" class="category-select">
                <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Urutkan</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
            </select>
            <button type="submit">Filter</button>

            <a href="{{ route('product.view')}}" class="reset-filter-btn">Reset Filter</a>
        </form>

        <div class="container">
            @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                <div class="product-info">
                    <h3>
                        <a href="{{ $product->link}}" target="_blank">
                        {{ $product->name }}
                        </a>
                        </h3>    
                    <p>{{ Str::limit($product->description, 100)}}</p>
                    <p class="price">RM{{number_format($product->price, 2)}} </p>
                    <p>Penjual: <a href="{{ route('product.view', ['seller_id' => $product->account_id]) }}">{{ $product->account->fullname }}</a></p>
        </div>
        </div>
        @endforeach
        </div>
        @endsection
    </body>
    </html>