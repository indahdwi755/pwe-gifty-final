<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIFTY - My Orders</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Zantroke&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, rgb(255, 252, 253), rgba(255, 192, 203, 0.2));
            min-height: 100vh;
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
            border: 1px solid #ff1493;
            padding: 0.5rem 1.2rem;
            font-weight: 600;
            background-color: transparent;
            border-radius: 6px;
            color: #ff1493;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .nav-top .logout-btn:hover {
            background-color: #ff1493;
            color: white;
            text-decoration: none;
        }

        .order-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-5px);
        }

        .order-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }

        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-shipped {
            background-color: #d4edda;
            color: #155724;
        }

        .status-delivered {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
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
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="mb-4">My Orders</h2>

                @if($orders->isEmpty())
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-shopping-bag fa-3x mb-3" style="color: #ff1493;"></i>
                        <h4>Belum ada pesanan</h4>
                        <p class="text-muted">Yuk mulai belanja di Gifty dan temukan hadiah terbaik untuk orang tersayang!</p>
                        <a href="{{ route('products.index') }}" class="btn btn-danger mt-3" style="background: linear-gradient(45deg, #ff1493, #ff69b4); border: none; padding: 10px 30px; border-radius: 25px; font-weight: 600; box-shadow: 0 2px 10px rgba(255, 20, 147, 0.2);">
                            <i class="fas fa-gift me-1"></i> Mulai Belanja
                        </a>
                    </div>
                @else
                    @foreach($orders as $order)
                        <div class="order-card shadow-sm mb-4">
                            <div class="p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="{{ asset('storage/' . $order->product->image) }}" 
                                             alt="{{ $order->product->name }}" 
                                             class="order-image">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="mb-1">{{ $order->product->name }}</h5>
                                        <p class="text-muted mb-0">Pesanan {{ $order->id }}</p>
                                        <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="status-badge status-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="fw-bold" style="color: #ff1493;">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        @if(!$order->payment)
                                            <a href="{{ route('payments.create', $order) }}" 
                                               class="btn btn-sm btn-primary">
                                                Bayar Sekarang
                                            </a>
                                        @else
                                            <a href="{{ route('payments.show', $order->payment) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                Lihat Pembayaran
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 