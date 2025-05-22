<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GIFTY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Zantroke&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, rgb(255, 252, 253), rgba(255, 192, 203, 0.2));
        }

        .brand {
            font-family: 'Zantroke', sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(to right, #ff69b4, #ff1493);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .search-box {
            position: relative;
            width: 100%;
            min-width: 200px;
        }

        .search-box input {
            border-radius: 25px;
            border: 2px solid #ff1493;
            padding: 12px 45px 12px 25px;
            width: 100%;
            background-color: white;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(255, 20, 147, 0.2);
        }

        .search-box i {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            color: #ff1493;
            font-size: 18px;
            pointer-events: none;
        }

        /* Logout button style */
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

        /* User info style */
        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-left: 20px;
            color: #ff1493;
        }

        .user-info i {
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .user-info span {
            font-weight: 600;
            font-size: 14px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: bold;
            margin: 3rem 0 2rem;
            text-align: center;
            color: #ff1493;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .view-all-btn {
            font-size: 1rem;
            font-weight: 500;
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            background: linear-gradient(45deg, #ff1493, #ff69b4);
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .view-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.2);
            color: white;
        }

        .section-title::after {
            display: none;
        }

        .section-title::before {
            display: none;
        }

        .product-card {
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.85));
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 20, 147, 0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(255, 20, 147, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 0.8rem;
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .discount-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(45deg, #ff1493, #ff69b4);
            color: white;
            padding: 8px 12px;
            font-size: 0.9rem;
            border-radius: 25px;
            font-weight: bold;
            box-shadow: 0 2px 10px rgba(255, 20, 147, 0.2);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .discount-badge i {
            font-size: 0.8rem;
        }

        .product-name {
            font-weight: 700;
            font-size: 1.1rem;
            color: #333;
            margin-top: 1rem;
            text-align: left;
            flex-shrink: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .product-description {
            font-weight: 500;
            font-size: 0.9rem;
            color: #666;
            margin-top: 0.5rem;
            text-align: left;
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .product-price {
            font-weight: bold;
            font-size: 1.2rem;
            color: #ff1493;
            margin-top: 1rem;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .original-price {
            font-size: 0.9rem;
            color: #999;
            text-decoration: line-through;
        }

        .buy-button {
            margin-top: 1rem;
            text-align: right;
        }

        .buy-button .btn-danger {
            background: linear-gradient(45deg, #ff1493, #ff69b4);
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(255, 20, 147, 0.2);
        }

        .buy-button .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 20, 147, 0.3);
        }

        .wishlist-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            color: #ff1493;
            font-size: 1.4rem;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.9);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .wishlist-icon:hover {
            transform: scale(1.1);
            background: #ff1493;
            color: white;
        }

        .footer-box {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 192, 203, 0.2));
            padding: 3rem 2rem;
            margin: 3rem 0;
            text-align: center;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(255, 20, 147, 0.1);
        }

        .footer-box h3 {
            font-family: 'Zantroke', sans-serif;
            font-size: 3rem;
            font-weight: bold;
            background: linear-gradient(to right, #ff69b4, #ff1493);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .footer-box p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 25px;
        }

        .social-icons i {
            font-size: 1.8rem;
            color: #ff1493;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .social-icons i:hover {
            transform: translateY(-5px);
            color: #ff69b4;
        }

        .footer-box .tagline {
            position: relative;
            display: inline-block;
            padding: 0 20px;
        }

        .footer-box .tagline::before,
        .footer-box .tagline::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 50px;
            height: 2px;
            background: linear-gradient(to right, #ff69b4, #ff1493);
        }

        .footer-box .tagline::before {
            left: -30px;
        }

        .footer-box .tagline::after {
            right: -30px;
        }

        .navbar-links a {
            margin-right: 1.5rem;
            text-decoration: none;
            color: black;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .navbar-links a:hover {
            color: #ff1493;
        }

        .navbar-links .badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            margin-left: 0.2rem;
        }

        /* Promo Carousel */
        #promoCarousel {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #promoCarousel .carousel-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        #promoCarousel .carousel-item {
            position: relative;
        }

        #promoCarousel .carousel-caption {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 15px 30px;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: auto;
        }

        #promoCarousel .carousel-caption .btn {
            background: linear-gradient(to right, #ff69b4, #ff1493);
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            border-radius: 20px;
            padding: 8px 25px;
            transition: all 0.3s ease;
        }

        #promoCarousel .carousel-caption .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #promoCarousel .carousel-control-prev,
        #promoCarousel .carousel-control-next {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
        }

        #promoCarousel .carousel-control-prev {
            left: 20px;
        }

        #promoCarousel .carousel-control-next {
            right: 20px;
        }

        #promoCarousel .carousel-control-prev-icon,
        #promoCarousel .carousel-control-next-icon {
            filter: invert(1) grayscale(100);
            width: 20px;
            height: 20px;
        }

        /* Footer Styling */
        .footer-section {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 50px 0;
            margin-top: 50px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(255, 20, 147, 0.1);
        }

        .footer-heading {
            color: #ff1493;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #ff1493;
            display: inline-block;
        }

        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-list li {
            margin-bottom: 12px;
        }

        .footer-list li a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
        }

        .footer-list li a:hover {
            color: #ff1493;
        }

        .footer-list li i {
            margin-right: 10px;
            color: #ff1493;
            font-size: 1rem;
        }

        .payment-icons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .payment-icons i {
            font-size: 2rem;
            color: #666;
            transition: color 0.3s ease;
        }

        .payment-icons i:hover {
            color: #ff1493;
        }

        /* Promo Section Styles */
        .promo-wrapper {
            padding: 15px;
            background: white;
            border-radius: 25px;
            box-shadow: 
                0 10px 30px rgba(255, 105, 180, 0.1),
                0 1px 8px rgba(255, 20, 147, 0.06);
            border: 1px solid rgba(255, 105, 180, 0.1);
            position: relative;
        }

        .promo-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(255, 105, 180, 0.05) 0%,
                rgba(255, 20, 147, 0.05) 100%);
            border-radius: 25px;
            pointer-events: none;
        }

        .promo-container {
            margin: 0;
            overflow: hidden;
            border-radius: 20px;
        }
        
        .promo-container .row {
            scrollbar-width: none;
            -ms-overflow-style: none;
            margin: 0;
            scroll-behavior: smooth;
        }
        
        .promo-container .row::-webkit-scrollbar {
            display: none;
        }
        
        .simple-promo-card {
            position: relative;
            overflow: hidden;
            margin: 0;
            transition: all 0.3s ease;
            height: 400px;
            border-radius: 15px;
            width: 100%;
            box-shadow: 0 4px 20px rgba(255, 20, 147, 0.08);
        }
        
        .simple-promo-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .simple-promo-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: linear-gradient(to bottom, 
                rgba(0,0,0,0.1) 0%,
                rgba(0,0,0,0.15) 50%,
                rgba(0,0,0,0.3) 100%);
            pointer-events: none;
        }
        
        .simple-promo-button {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            background: #FF1493;
            color: white;
            text-decoration: none;
            padding: 10px 35px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            white-space: nowrap;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            z-index: 2;
        }
        
        .simple-promo-button:hover {
            transform: translateX(-50%) translateY(-3px);
            background: #FF69B4;
            color: white;
        }

        .promo-container .promo-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: none;
            color: #FF1493;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .promo-container .promo-nav i {
            font-size: 1.5rem;
        }
        .promo-container .promo-prev {
            left: 15px;
        }
        .promo-container .promo-next {
            right: 15px;
        }
        

        @media (max-width: 768px) {
            .promo-wrapper {
                padding: 10px;
            }
            
            .simple-promo-card {
                height: 200px;
            }
            
            .simple-promo-button {
                padding: 8px 20px;
                font-size: 0.85rem;
                bottom: 30px;
            }

            .promo-container .promo-nav {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
        }
        .pagination .page-item .page-link {
            color: #ff1493;
            border: 1px solid #ff1493;
            margin: 0 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .pagination .page-item.active .page-link {
            background-color: #ff1493;
            color: white;
        }
        .pagination .page-item .page-link:hover {
            background-color: #ff1493;
            color: white;
        }

        /* Hide all .promo-nav by default */
        .promo-nav {
            display: none !important;
        }
        /* Only show .promo-nav if direct child of .promo-container */
        .promo-container > .promo-nav {
            display: flex !important;
        }
    </style>
</head>

<body>
    <!-- Top Nav -->
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center p-3 nav-top">
            <a href="{{ route('dashboard') }}" class="brand">GIFTY</a>
            <div class="search-box mx-4 flex-grow-1">
                <form method="GET" action="{{ route('categories.index') }}">
                    <input type="text" name="search" class="form-control search-box" placeholder="Search categories..." value="{{ request('search') }}">
                </form>
            </div>
            <div class="d-flex align-items-center">
                <a href="/logout" class="logout-btn">Logout</a>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>
        </div>

        <!-- Navbar Links -->
        <div class="mt-3">
            <nav class="d-flex navbar-links">
                <a href="{{ route('dashboard') }}">Home</a>
                <a href="{{ route('products.index') }}">Product</a>
                <a href="{{ route('categories.index') }}">Category</a>
                <a href="{{ route('orders.my') }}">My Orders</a>
            </nav>
        </div>

        <!-- Promo Section -->
        @if(isset($promos) && $promos->isNotEmpty() && empty($is_all_products))
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="promo-wrapper">
                        <div class="promo-container position-relative">
                            <div class="row flex-nowrap overflow-auto g-0">
                                @foreach($promos as $product)
                                    <div class="col-12">
                                        <div class="simple-promo-card">
                                            <img src="{{ asset('storage/' . ($product->image ?? 'default-image.jpg')) }}" 
                                                 alt="{{ $product->name ?? 'Product Image' }}"
                                                 class="simple-promo-image" />
                                            <div class="simple-promo-overlay"></div>
                                            <a href="{{ route('products.show', $product->id ?? 0) }}" class="simple-promo-button">
                                                Buy Now
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($promos->count() > 1)
                            {{-- <button class="promo-nav promo-prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="promo-nav promo-next">
                                <i class="fas fa-chevron-right"></i>
                            </button> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <div class="container mt-5">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="section-title">Product</div>
            <div class="row row-cols-2 row-cols-md-5 g-4">
                @foreach($products as $product)
                    @if($product)
                        <div class="col">
                            <div class="product-card">
                                @if($product->is_promo && $product->promo_price)
                                    <div class="discount-badge">
                                        <i class="fas fa-tags"></i>
                                        {{ round((($product->price - $product->promo_price) / $product->price) * 100) }}% OFF
                                    </div>
                                @endif
                                <div class="wishlist-icon">
                                    <i class="far fa-heart"></i>
                                </div>
                                <img src="{{ asset('storage/' . ($product->image ?? 'default-image.jpg')) }}" 
                                     alt="{{ $product->name ?? 'Product Image' }}" />
                                <div class="product-name">{{ $product->name ?? 'Unnamed Product' }}</div>
                                <div class="product-description">{{ $product->description ?? 'No description available' }}</div>
                                <div class="product-price">
                                    @if($product->is_promo && $product->promo_price)
                                        <span class="original-price">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</span>
                                        <span>Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                                    @else
                                        <span>Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <div class="buy-button">
                                    <a href="{{ route('products.show', $product->id ?? 0) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-shopping-cart me-1"></i>
                                        Buy Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Footer Box -->
        <div class="footer-box">
            <h3>Gifty</h3>
            <p class="tagline">Situs gift terlengkap dan terpercaya #1 di Indonesia</p>
            <div class="social-icons">
                <i class="fab fa-facebook" title="Follow us on Facebook"></i>
                <i class="fab fa-instagram" title="Follow us on Instagram"></i>
                <i class="fab fa-tiktok" title="Follow us on TikTok"></i>
                <i class="fab fa-youtube" title="Subscribe to our YouTube"></i>
                <i class="fab fa-twitter" title="Follow us on Twitter"></i>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="footer-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-heading">Information</h5>
                        <ul class="footer-list">
                            <li><a href="#"><i class="fas fa-info-circle"></i>About Gifty</a></li>
                            <li><a href="#"><i class="fas fa-file-contract"></i>Terms & Conditions</a></li>
                            <li><a href="#"><i class="fas fa-shield-alt"></i>Privacy Policy</a></li>
                            <li><a href="#"><i class="fas fa-truck"></i>Shipping Information</a></li>
                            <li><a href="#"><i class="fas fa-gift"></i>Gift Cards</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-heading">Payment Method</h5>
                        <div class="payment-icons">
                            <i class="fab fa-cc-visa" title="Visa"></i>
                            <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                            <i class="fab fa-cc-paypal" title="PayPal"></i>
                            <i class="fas fa-money-bill-wave" title="Cash"></i>
                        </div>
                        <ul class="footer-list mt-3">
                            <li><a href="#"><i class="fas fa-lock"></i>Secure Payments</a></li>
                            <li><a href="#"><i class="fas fa-exchange-alt"></i>Easy Returns</a></li>
                            <li><a href="#"><i class="fas fa-coins"></i>Reward Points</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="footer-heading">Customer Care</h5>
                        <ul class="footer-list">
                            <li><a href="#"><i class="fas fa-question-circle"></i>FAQ</a></li>
                            <li><a href="#"><i class="fas fa-headset"></i>24/7 Support</a></li>
                            <li><a href="#"><i class="fas fa-envelope"></i>Contact Us</a></li>
                            <li><a href="#"><i class="fas fa-undo"></i>Return Policy</a></li>
                            <li><a href="#"><i class="fas fa-phone"></i>Hotline: 0800-123-GIFT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const promoContainer = document.querySelector('.promo-container');
            if (!promoContainer) return;
            const row = promoContainer.querySelector('.row');
            // const prevBtn = promoContainer.querySelector('.promo-prev');
            // const nextBtn = promoContainer.querySelector('.promo-next');
            //
            // if (prevBtn && nextBtn && row) {
            //     prevBtn.addEventListener('click', () => {
            //         row.scrollBy({
            //             left: -row.offsetWidth,
            //             behavior: 'smooth'
            //         });
            //     });
            //     
            //     nextBtn.addEventListener('click', () => {
            //         row.scrollBy({
            //             left: row.offsetWidth,
            //             behavior: 'smooth'
            //         });
            //     });
            // }

            // Auto-slide functionality
            let autoSlideInterval;
            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    if (row) {
                        row.scrollBy({
                            left: row.offsetWidth,
                            behavior: 'smooth'
                        });
                        // Reset scroll position if reached the end
                        if (row.scrollLeft + row.offsetWidth >= row.scrollWidth) {
                            row.scrollTo({ left: 0, behavior: 'smooth' });
                        }
                    }
                }, 3000); // Auto-slide every 3 seconds
            }
            startAutoSlide();
        });
    </script>
</body>

</html>
