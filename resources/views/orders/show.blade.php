<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIFTY - Detail Pesanan</title>
    
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

        .order-details {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .order-details .row {
            margin-bottom: 0.8rem;
        }

        .order-details .row:last-child {
            margin-bottom: 0;
        }

        .order-details .label {
            color: #666;
            font-size: 0.9rem;
        }

        .order-details .value {
            color: #2c3e50;
            font-weight: 500;
        }

        .total-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: #ff1493;
        }

        .btn-payment {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.8rem 1.5rem;
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

        .btn-payment:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.2);
            color: white;
        }

        .btn-status {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            background: #e8f5e9;
            color: #2e7d32;
            border: 1.5px solid #a5d6a7;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-status:hover {
            transform: translateY(-2px);
            background: #c8e6c9;
            color: #2e7d32;
        }

        .btn-back {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 0.8rem 1.5rem;
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

        .alert {
            border-radius: 10px;
            border: none;
            font-family: 'Poppins', sans-serif;
        }

        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1.5px solid #a5d6a7;
        }

        .alert-danger {
            background-color: #fbe9e7;
            color: #d32f2f;
            border: 1.5px solid #ffab91;
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
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="order-card">
            <h4 class="order-title">Detail Pesanan</h4>

            @if($order->product)
            <div class="product-preview">
                @if($order->product->image)
                    <img src="{{ asset('storage/' . $order->product->image) }}" 
                         alt="{{ $order->product->name }}" 
                         class="product-image">
                @else
                    <div class="bg-light rounded p-3 text-center" style="width: 120px; height: 120px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                @endif
                <div class="product-info flex-grow-1">
                    <h5>{{ $order->product->name }}</h5>
                    <p>{{ $order->product->description }}</p>
                </div>
            </div>
            @endif

            <div class="order-details">
                <div class="row">
                    <div class="col-5">
                        <span class="label">Nama Pemesan</span>
                    </div>
                    <div class="col-7">
                        <span class="value">{{ $order->customer_name }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <span class="label">Alamat Pengiriman</span>
                    </div>
                    <div class="col-7">
                        <span class="value">{{ $order->address }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <span class="label">Total pembayaran</span>
                    </div>
                    <div class="col-7">
                        <span class="total-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2">
                @if(!$order->payment)
                    <a href="{{ route('payments.create', $order) }}" class="btn btn-payment">
                        <i class="fas fa-credit-card"></i>
                        Bayar Sekarang
                    </a>
                @else
                    <a href="{{ route('payments.show', $order->payment) }}" class="btn btn-status">
                        <i class="fas fa-receipt"></i>
                        Lihat Status Pembayaran
                    </a>
                @endif
                <a href="{{ route('products.index') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Produk
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 