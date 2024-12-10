<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting Produk</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        
        .container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        label {
            font-weight: bold;
            color: #495057;
        }
        input[type="text"], input[type="file"], input[type="url"] {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Iklan</h1>
        <div>
            @if($errors->any())
            <ul class="error-list">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div>
                <label for="name">Nama</label>
                <input type="text" name="name" placeholder="Nama Produk"/>
            </div>
            <div>
                <label for="qty">Kuantiti</label>
                <input type="text" name="qty" placeholder="Kuantiti Produk" />
            </div><div>
                <label for="price">Harga</label>
                <input type="text" name="price" placeholder="Harga (RM)"/>
            </div>
            <div>
                <label for="link">URL Produk</label>
                <input type="url" name="link" placeholder="URL produk"/>
            </div>
            <div>
                <label for="description">Penerangan</label>
                <input type="text" name="description" placeholder="Terangkan Produk Anda "/>
            </div><div>
                <label for="image">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" />
            </div>
            <div>
                <input type="submit" value="Simpan" />
            </div>
        </form>
    </div>
</body>
</html>