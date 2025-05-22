<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->name ?? 'Product' }} - GIFTY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zantroke&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, rgb(255, 252, 253), rgba(255, 192, 203, 0.2));
            min-height: 100vh;
            color: #2c3e50;
        }

        .brand {
            font-family: 'Zantroke', sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(to right, #ff69b4, #ff1493);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .nav-top .logout-btn {
            font-family: 'Poppins', sans-serif;
            border: 1.5px solid #ff1493;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            background-color: transparent;
            border-radius: 10px;
            color: #ff1493;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .nav-top .logout-btn:hover {
            background-color: #ff1493;
            color: white;
            transform: translateY(-2px);
        }

        .product-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.08);
            max-width: 600px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        .product-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .product-preview {
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 20, 147, 0.1);
        }

        .product-image-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .product-image {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            background: #f8f9fa;
            padding: 0.5rem;
        }

        .product-info {
            text-align: center;
        }

        .product-info h5 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.8rem;
        }

        .product-info p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .badges-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .product-details {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.2rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .product-price {
            font-size: 1.4rem;
            font-weight: 600;
            color: #ff1493;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-order {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            background: linear-gradient(45deg, #ff1493, #ff69b4);
            color: white;
            border: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.2);
            color: white;
        }

        .btn-back {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            background: transparent;
            color: #ff1493;
            border: 1.5px solid #ff1493;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-back:hover {
            background: rgba(255, 20, 147, 0.1);
            transform: translateY(-2px);
            color: #ff1493;
        }

        .stock-badge {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        .category-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: 500;
            display: inline-block;
        }

        .alert {
            border-radius: 10px;
            border: none;
            font-family: 'Poppins', sans-serif;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1.5px solid #ffeeba;
        }
    </style>
</head>
<body>
    <!-- Top Nav -->
    <div class="d-flex justify-content-between align-items-center p-3 nav-top">
        <div class="d-flex align-items-center">
            <a href="{{ route('dashboard') }}" class="brand me-4">GIFTY</a>
        </div>
        <div class="d-flex align-items-center">
            <a href="/logout" class="logout-btn">Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-4">
        @if($product)
            <div class="product-card">
                <h4 class="product-title">Detail Produk</h4>
                
                <div class="product-preview">
                    <div class="product-image-container">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="product-image">
                        @else
                            <div class="bg-light rounded p-3 text-center" style="width: 300px; height: 300px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="product-info">
                        <h5>{{ $product->name }}</h5>
                        <p>{{ $product->description }}</p>
                        
                        <div class="badges-container">
                            <span class="category-badge">
                                <i class="fas fa-tag me-1"></i>
                                {{ optional($product->category)->name ?? 'Kategori Tidak Tersedia' }}
                            </span>
                            <span class="stock-badge">
                                <i class="fas fa-box me-1"></i>
                                Stok: {{ $product->stock ?? 0 }}
                            </span>
                        </div>

                        <div class="product-details">
                            @if($product->is_promo && $product->promo_price)
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="text-decoration-line-through text-muted">
                                        Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                                    </span>
                                    <span class="product-price">
                                        Rp {{ number_format($product->promo_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            @else
                                <span class="product-price">
                                    Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="buttons-container">
                    <a href="{{ route('orders.create', $product) }}" class="btn btn-order">
                        <i class="fas fa-shopping-cart"></i>
                        Buat Pesanan
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Produk tidak ditemukan. <a href="{{ route('products.index') }}" class="alert-link">Kembali ke daftar produk</a>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
