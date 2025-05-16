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
        }

        .search-box input {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            width: 100%;
            max-width: 500px;
            background-color: transparent;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            color: #888;
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

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 2rem;
            text-align: center;
        }

        .product-card {
            padding: 1rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: contain;
            border-radius: 10px;
            background-color: #f9f9f9;
            padding: 0.5rem;
        }

        .product-name {
            font-weight: 700;
            font-size: 1rem;
            color: #222;
            margin-top: 0.5rem;
            text-align: left;
            flex-shrink: 0;
        }

        .product-description {
            font-weight: 500;
            font-size: 0.85rem;
            color: #666;
            margin-top: 0.3rem;
            text-align: left;
            flex-grow: 1;
        }

        .product-price {
            font-weight: bold;
            font-size: 1rem;
            color: #d0021b;
            margin-top: 0.5rem;
            text-align: left;
        }

        .buy-button {
            margin-top: 0.75rem;
            text-align: right;
        }

        .discount-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #e91e63;
            color: white;
            padding: 3px 6px;
            font-size: 0.8rem;
            border-radius: 4px;
        }

        .wishlist-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #333;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .footer-box {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 2rem;
            margin-top: 3rem;
            text-align: center;
            border-radius: 10px;
        }

        .navbar-links a {
            margin-right: 1.5rem;
            text-decoration: none;
            color: black;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-links a:hover {
            color: #ff1493;
        }

        /* Promo Carousel */
        #promoCarousel .carousel-image {
            width: 80%;
            max-width: 800px;
            height: auto;
            margin: 0 auto;
            display: block;
            border-radius: 10px;
        }

        #promoCarousel .carousel-caption {
            background: none !important;
            padding: 0;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: auto;
        }

        #promoCarousel .carousel-caption .btn {
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 20px;
            padding: 0.5rem 1.5rem;
        }

        #promoCarousel .carousel-control-prev-icon,
        #promoCarousel .carousel-control-next-icon {
            filter: invert(1);
        }
    </style>
</head>

<body class="container-fluid">
    <!-- Top Nav -->
    <div class="d-flex justify-content-between align-items-center p-3 nav-top">
        <div class="d-flex align-items-center">
            <div class="brand me-4">GIFTY</div>
            <div class="search-box">
                <input type="text" placeholder="Search..." />
                <i class="fas fa-search"></i>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <!-- Logout jadi tombol dengan efek hover -->
            <a href="/logout" class="logout-btn me-3">Logout</a>
        </div>
    </div>

    <!-- Navbar Links -->
    <div class="mt-3">
        <nav class="d-flex navbar-links">
            <a href="#">Home</a>
            <a href="#">Product</a>
            <a href="#">Category</a>
        </nav>
    </div>

    <!-- Promo Section (Slider) -->
    <div class="mt-4">
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($promos as $index => $promo)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $promo->image) }}" class="d-block carousel-image" alt="{{ $promo->name }}" />
                    <div class="carousel-caption d-none d-md-block">
                        <a href="#" class="btn btn-light">SHOP NOW</a>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <!-- Bestie Deals -->
    <div class="section-title">Bestie Deals For You</div>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        @foreach ($products as $product)
        <div class="col">
            <div class="product-card">
                <div class="discount-badge">10%</div>
                <div class="wishlist-icon"><i class="far fa-heart"></i></div>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                <div class="product-name">{{ $product->name }}</div>
                <div class="product-description">{{ $product->description }}</div>
                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="buy-button">
                    <button class="btn btn-sm btn-danger">Beli Sekarang</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Footer Box -->
    <div class="footer-box">
        <h3>Gifty</h3>
        <p>Situs gift terlengkap dan terpercaya #1 di Indonesia</p>
        <div>
            <i class="fab fa-facebook fa-lg me-3"></i>
            <i class="fab fa-instagram fa-lg me-3"></i>
            <i class="fab fa-youtube fa-lg me-3"></i>
            <i class="fab fa-twitter fa-lg"></i>
        </div>
    </div>

    <!-- Footer Info -->
    <div class="row mt-5">
        <div class="col-md-4">
            <h5>Information</h5>
            <ul class="list-unstyled">
                <li>About Us</li>
                <li>Terms & Conditions</li>
            </ul>
        </div>
        <div class="col-md-4">
            <h5>Payment Method</h5>
            <ul class="list-unstyled">
                <li>Bank Transfer</li>
                <li>E-Wallet</li>
                <li>Credit Card</li>
            </ul>
        </div>
        <div class="col-md-4">
            <h5>Customer Care</h5>
            <ul class="list-unstyled">
                <li>FAQ</li>
                <li>Contact Us</li>
                <li>Return Policy</li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
