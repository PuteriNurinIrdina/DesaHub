<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Advertisements</title>
    <style>
        .container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border-radius: 8px;
            margin: auto;
        }

        .container-2 {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .product-card {
            width: calc(33.33% - 20px);
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        .product-card .buttons {
            margin-top: 15px;
        }

        .product-card .buttons a,
        .product-card .buttons form input {
            padding: 10px 20px;
            background-color: #1E88E5;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }


        #successMessage {
            opacity: 0;
            
            transition: opacity 1s ease-in-out, visibility 0s linear 1s;
            color: green;
            margin-bottom: 20px;
            font-size: 1.2em;
        }

        #successMessage.show {
            opacity: 1;
        }

        #successMessage.hide {
            opacity: 0;
        }
       
    </style>

</head>
<body>

@extends('includes.navbar')
@section('content')

<div class="container">
    <h1>Produk Terbaru</h1>
    @if(session()->has('success'))
    <div id="successMessage" class="alert alert-success">
        {{ session('success') }}
    </div>
    <script>
        window.onload = function() {
            document.getElementById('successMessage').classList.add('show');

            setTimeout(function() {
                document.getElementById('successMessage').classList.add('hide');
            }, 2000);
        };
    </script>
    @endif
    <br>
    <div class="container-2">
        @foreach($products as $product)
        <div class="product-card">
            <br>
        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width: 300px; height: auto;">

            <div class="product-info">
                <h3>{{ $product->name }}</h3>
                <p>{{ Str::limit($product->description, 100) }}</p>
                <p class="price">RM{{ number_format($product->price, 2) }}</p>
                <div class="buttons">
                    <form action="{{ route('product.edit', ['product' => $product]) }}" method="get" style="display:inline;">
                        <button type="submit" class="btn btn-primary">Sunting</button>
                    </form>

                    <form method="post" action="{{ route('product.destroy', ['product' => $product]) }}" style="display:inline;" onsubmit="return confirmDelete()">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary">Buang</button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach
    </div>
    </div>
<script>
    function confirmDelete() {
        return confirm("Adakah anda pasti untuk membuang produk ini?");
    }
</script>
@endsection
</body>
</html>
