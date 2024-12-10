<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name= "viewport" content="width=device-width, initial-scale=1.0">
        <title>All Products</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                padding: 20px;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
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
            </style>
    </head>

    <body>
        <h1>All Products</h1>
        <div class="container">
            @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image">
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description, 100)}}</p>
                    <p class="price">RM{{number_format($product->price, 2)}} </p>
        </div>
        </div>
        @endforeach
        </div>
    </body>
    </html>