<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>

        .container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border-radius: 8px;
        }

        label {
            font-weight: bold;
            color: #495057;
        }

        input[type="text"], input[type="file"], input[type="url"], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #17a2b8;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover{
            background-color: #138496;
        }

        .error-list {
            color: #dc3545;
            list-style: none;
            padding: 0;
        }

        .current-image {
            margin-bottom: 16px;
            text-align: center;
        }

        .current-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .text-danger {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
@extends('includes.navbar')
@section('content')

    <div class="container">
        <h1>Sunting Produk</h1>
    <br>
    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
    
    </div>
    <form method="post" action="{{route('product.update', ['product' => $product])}}">
        @csrf
        @method('put')
    
    <div>
        <label>Nama <span class="text-danger">*</span></label>
        <input type="text" name="name" placeholder="Nama" value="{{$product->name}}"/>
    </div>
    
    <div>
        <label>Kuantiti <span class="text-danger">*</span></label>
        <input type="text" name="qty" placeholder="Kuantiti" value="{{$product->qty}}"/>
    </div>
    
    <div>
        <label>Harga <span class="text-danger">*</span></label>
        <input type="text" name="price" placeholder="Harga" value="{{$product->price}}"/>
    </div>

    <div>
        <label for="category" style="margin-bottom: 10px;">Kategori Produk</label>
        <select name="category" id="category" required style="margin-bottom: 15px;">
            <option value="">Pilih Kategori <span class="text-danger">*</span></option>
            @foreach($categories as $slug => $name)
                <option value="{{ $slug }}" {{ old('category') == $slug ?  'selected' : ''}}> {{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>URL produk <span class="text-danger">*</span></label>
        <input type="url" name="url" placeholder="URL Produk" value="{{$product->link}}"/>
    </div>
    
    <div>
        <label>Penerangan <span class="text-danger">*</span></label>
        <input type="text" name="Terangkan Produk Anda" placeholder="Terangkan Produk Anda" value="{{$product->description}}"/>
    </div>
    
    <div class="current-image">
        @if($product->image)
        <label>Gambar Terkini</label>
        <img src="{{ asset('storage/' . $product->image)}}" alt="Current Product Image">
        @endif
    </div>

        <div>
            <label for="image">Muatnaik Gambar <span class="text-danger">*</span></label>
            <input type="file" name="image" id="image" accept="image/*" />
        </div>
    
        <div>
        <button type="submit" class="btn btn-submit" style="width: 100%;">Simpan</button>
        </div>
    
    </form>
    </div>

@endsection

</body>
</html>