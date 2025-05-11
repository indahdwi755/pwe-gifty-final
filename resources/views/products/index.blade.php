<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Kami</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff0f5;
        }

        header {
            background-color: #ffb6c1;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav a {
            margin: 0 10px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        section {
            padding: 40px 20px;
        }

        h2 {
            text-align: center;
            color: #d63384;
            margin-bottom: 30px;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .product-card {
            background-color: #ffe4e1;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease-in-out;
            text-align: center;
            padding-bottom: 15px;
        }

        .product-card:hover {
            transform: scale(1.03);
        }

        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .product-card h3 {
            margin: 10px 0 5px;
            color: #c2185b;
        }

        .product-card p {
            margin: 0;
            color: #555;
        }

        .product-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            background-color: #f06292;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .product-card a:hover {
            background-color: #e91e63;
        }
    </style>
</head>
<body>
    <header>
        <h1>🌸 Selamat Datang di Toko GIFTY 🌸</h1>
        <nav>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="#">Kategori</a>
            <a href="#">Promo</a>
            <a href="#">Akun</a>
        </nav>
    </header>

    <section>
        <h2>💕 Pilihan Produk Terbaik Untukmu 💕</h2>
        <div class="products">
            @foreach($products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('product.show', ['product' => $product->id]) }}">Lihat Detail</a>
                </div>
            @endforeach
        </div>
    </section>
</body>
</html>
