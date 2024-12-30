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

            .filter-container {
                display: flex;
                justify-content: center;
                gap: 20px;
                margin-bottom: 30px;
                margin-top: 20px;
            }

            .filter-container form {
                display: flex;
                gap: 15px;
                align-items: center;
            }

            .category-select {
                padding: 10px;
                border-radius: 4px;
                border: 1px solid #ced4da;
                background-color: #f9f9f9;
                cursor: pointer;
                transition: border-color 0.3s ease, box-shadow 0.3s ease;
            }

            .category-select:hover {
                border-color: #095c80;
            }

            .filter-btn {
                background-color: #095c80;
                color: #fff;
                border: none;
                padding: 10px;
                border-radius: 4px;
                font-size: 1em;
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.2s ease;
                text-align: center;
                text-decoration: none;
            }

            .filter-btn:hover {
                background-color: #0078a3;
                transform: scale(1.05);
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

            .product-card h4 {
                font-size: 1em;
                margin-bottom: 10px;
                color: #333;
            }

            .product-card h4:hover {
                font-weight: bold;
            }

            .product-card p {
                font-size: 1em;
                margin-bottom: 10px;
                color: #555;
            }

            .product-card .price {
                font-size: 1.2em;
                font-weight: bold;
                color: #1C2951;
            }

            .product-card a {
                color: black;
                text-decoration: none;
            }

            .product-card a:hover {
                text-decoration: none;
                color: #333;
                font-weight: bold;
            }

            .profile-picture {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 5px;
            }

            .profile-picture img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 2px solid #f9f9f9;
                object-fit: cover;
            }

            .pagination {
                display: inline-flex;
                list-style: none;
                padding-left: 0;
                border-radius: 50px;
                margin-top: 20px;
                justify-content: center;
            }

            .pagination li {
                margin: 0 5px;
            }

            .pagination .page-item {
                display: inline-block;
            }

            .pagination .page-link {
                color: #0094d4;
                background-color: #fff;
                border: 1px solid #ddd;
                padding: 10px 15px;
                border-radius: 50px;
                font-size: 0.9rem;
                transition: background-color 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .pagination .page-link svg {
                width: 12px;
                height: 12px;
                margin: 0 2px;
            }

            .pagination .page-link:hover {
                background-color: #f0f0f0;
                color: #0056b3;
                text-decoration: none;
            }

            .pagination .page-item.active .page-link {
                background-color: #095c80;
                border-color: #095c80;
                color: white;
            }

            .pagination .page-link:focus {
                box-shadow: none;
            }

            .pagination .page-item.disabled .page-link {
                color: #ccc;
                pointer-events: none;
            }

            </style>
    </head>

    <body>
    @extends('includes.navbar')
    @section('content')
    
        <h1>
            @if (isset($seller))
                Produk dari {{ $seller->fullname}}
            @else
                Produk Terkini
            @endif
        </h1>

        <div class="filter-container">
        <form method="GET" action="{{ route('product.view')}}">
            <select name="category" class="category-select">
                <option value="">Pilih Kategori</option>
                @foreach(config('categories') as $key => $value)
                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
            <select name="sort" class="category-select">
                <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Urutan Harga</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Rendah ke Tinggi</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Tinggi ke Rendah</option>
            </select>
            <button type="submit" class="filter-btn">Tapis</button>
        
            <a href="{{ route('product.view')}}" class="filter-btn">Buang Tapisan</a>
        </form>
        </div>

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
                    <p> 
                        <a href="{{ route('product.view', ['seller_id' => $product->account_id]) }}">
                            <div class="profile-picture">
                                @if($product->account->profile_picture)
                                    <img src="{{ asset('storage/' . $product->account->profile_picture) }}" alt="Profile Picture">
                                @endif
                                {{ $product->account->fullname }}
                            </div>
                        </a>
                    </p>
        </div>
        </div>
        @endforeach
        </div>

        <div class="pagination">
            {{ $products->links('vendor.pagination.bootstrap-4') }}
        </div>
        
        @endsection
        
    </body>
    </html>