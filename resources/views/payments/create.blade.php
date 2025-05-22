<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIFTY - Pembayaran</title>
    
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

        .payment-option {
            border: 1.5px solid #e1e8ed;
            border-radius: 10px;
            padding: 1.2rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .payment-option:hover {
            border-color: #ff1493;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.1);
        }

        .payment-option.selected {
            border-color: #ff1493;
            background-color: rgba(255, 20, 147, 0.05);
        }

        .payment-icon {
            font-size: 2rem;
            color: #ff1493;
            margin-bottom: 0.8rem;
        }

        .btn-submit {
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
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.2);
            color: white;
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
        <div class="payment-card">
            <h4 class="payment-title">Pembayaran Pesanan</h4>
            
            <div class="order-summary">
                <img src="{{ asset('storage/' . $order->product->image) }}" 
                     alt="{{ $order->product->name }}" 
                     class="product-image">
                <div class="product-info flex-grow-1">
                    <h5>{{ $order->product->name }}</h5>
                    <p>{{ Str::limit($order->product->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Total Pembayaran:</span>
                        <span class="total-price">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                
                <h5 class="mb-3 fw-500">Pilih Metode Pembayaran</h5>
                
                <div class="payment-option" onclick="selectPayment('transfer_bank')">
                    <input type="radio" name="payment_method" value="transfer_bank" id="transfer_bank" class="d-none" required>
                    <div class="text-center">
                        <i class="fas fa-university payment-icon"></i>
                        <h6 class="mb-1">Transfer Bank</h6>
                        <small class="text-muted">BCA, Mandiri, BNI, BRI</small>
                    </div>
                </div>

                <div class="payment-option" onclick="selectPayment('e_wallet')">
                    <input type="radio" name="payment_method" value="e_wallet" id="e_wallet" class="d-none">
                    <div class="text-center">
                        <i class="fas fa-wallet payment-icon"></i>
                        <h6 class="mb-1">E-Wallet</h6>
                        <small class="text-muted">DANA, OVO, GoPay, ShopeePay</small>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-check-circle"></i>
                        Konfirmasi Pembayaran
                    </button>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectPayment(method) {
            // Remove selected class from all options
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            document.querySelector(`#${method}`).closest('.payment-option').classList.add('selected');
            
            // Check the radio button
            document.querySelector(`#${method}`).checked = true;
        }
    </script>
</body>
</html> 