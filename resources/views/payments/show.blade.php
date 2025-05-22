<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIFTY - Status Pembayaran</title>
    
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

        .payment-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.08);
            max-width: 600px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        .payment-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .status-badge {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .status-badge.pending {
            background-color: #fff8e1;
            color: #ffa000;
            border: 1.5px solid #ffe082;
        }

        .status-badge.success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1.5px solid #a5d6a7;
        }

        .status-badge.failed {
            background-color: #fbe9e7;
            color: #d32f2f;
            border: 1.5px solid #ffab91;
        }

        .order-summary {
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

        .total-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: #ff1493;
        }

        .payment-details {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .payment-details .row {
            margin-bottom: 0.8rem;
        }

        .payment-details .row:last-child {
            margin-bottom: 0;
        }

        .payment-details .label {
            color: #666;
            font-size: 0.9rem;
        }

        .payment-details .value {
            color: #2c3e50;
            font-weight: 500;
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

        <div class="payment-card">
            <h4 class="payment-title">Status Pembayaran</h4>
            
            <!-- Payment Status -->
            <div class="text-center">
                @if($payment->status === 'pending')
                    <div class="status-badge pending">
                        <i class="fas fa-clock"></i>
                        Menunggu Verifikasi
                    </div>
                @elseif($payment->status === 'paid')
                    <div class="status-badge success">
                        <i class="fas fa-check-circle"></i>
                        Pembayaran Diterima
                    </div>
                @else
                    <div class="status-badge failed">
                        <i class="fas fa-times-circle"></i>
                        Pembayaran Ditolak
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <img src="{{ asset('storage/' . $payment->order->product->image) }}" 
                     alt="{{ $payment->order->product->name }}" 
                     class="product-image">
                <div class="product-info flex-grow-1">
                    <h5>{{ $payment->order->product->name }}</h5>
                    <p>{{ Str::limit($payment->order->product->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Total Pembayaran:</span>
                        <span class="total-price">
                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="payment-details">
                <div class="row">
                    <div class="col-5">
                        <span class="label">Metode Pembayaran</span>
                    </div>
                    <div class="col-7">
                        <span class="value">{{ $payment->payment_method === 'transfer_bank' ? 'Transfer Bank' : 'E-Wallet' }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <span class="label">Tanggal Pembayaran</span>
                    </div>
                    <div class="col-7">
                        <span class="value">{{ $payment->created_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <span class="label">Status</span>
                    </div>
                    <div class="col-7">
                        <span class="value">
                            @if($payment->status === 'pending')
                                <span class="text-warning">Menunggu Verifikasi</span>
                            @elseif($payment->status === 'paid')
                                <span class="text-success">Pembayaran Diterima</span>
                            @else
                                <span class="text-danger">Pembayaran Ditolak</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="d-grid">
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