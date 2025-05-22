<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIFTY - Buat Pesanan</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Zantroke&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
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

        .order-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.08);
            max-width: 600px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        .order-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .product-preview {
            display: flex;
            gap: 1.5rem;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 20, 147, 0.1);
        }

        .product-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            background: #f8f9fa;
            padding: 0.5rem;
        }

        .product-info h5 {
            font-size: 1.1rem;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .product-info p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1rem;
            font-weight: 500;
            color: #ff1493;
        }

        .form-label {
            font-size: 0.95rem;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .form-control {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            padding: 0.7rem 1rem;
            border-radius: 10px;
            border: 1.5px solid #e1e8ed;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ff1493;
            box-shadow: 0 0 0 0.2rem rgba(255, 20, 147, 0.15);
        }

        .btn-submit {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.7rem 1rem;
            border-radius: 10px;
            background: linear-gradient(45deg, #ff1493, #ff69b4);
            color: white;
            border: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.2);
        }

        .btn-back {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.7rem 1rem;
            border-radius: 10px;
            background: transparent;
            color: #ff1493;
            border: 1.5px solid #ff1493;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-back:hover {
            background: rgba(255, 20, 147, 0.1);
            transform: translateY(-2px);
        }

        .invalid-feedback {
            font-size: 0.85rem;
            color: #dc3545;
            margin-top: 0.25rem;
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
        <div class="order-card">
            <h4 class="order-title">Buat Pesanan</h4>
            
            <div class="product-preview">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="product-image">
                <div class="product-info">
                    <h5>{{ $product->name }}</h5>
                    <p>{{ $product->description }}</p>
                    <div class="product-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Lengkap</label>
                    <input type="text" 
                           name="customer_name" 
                           id="customer_name" 
                           class="form-control @error('customer_name') is-invalid @enderror" 
                           value="{{ old('customer_name') }}" 
                           required>
                    @error('customer_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label">Alamat Pengiriman</label>
                    <textarea name="address" 
                              id="address" 
                              rows="3" 
                              class="form-control @error('address') is-invalid @enderror" 
                              required>{{ old('address') }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-shopping-cart"></i>
                        Buat Pesanan
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 