<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - GIFTY</title>
    
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
        }

        .navbar-brand {
            font-family: 'Zantroke', sans-serif;
            font-size: 2rem;
            color: #FF1493 !important;
        }

        .nav-link {
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #FF1493;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 1.5rem;
            overflow: hidden;
            border: 1px solid rgba(255, 20, 147, 0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(255, 20, 147, 0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-card .card-body {
            padding: 1.5rem;
        }

        .product-card h5 {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-card .price {
            color: #FF1493;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .product-card .stock {
            color: #666;
            font-size: 0.9rem;
        }

        .category-header {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .pagination {
            margin-top: 2rem;
        }

        .page-link {
            color: #FF1493;
            border-color: #FF1493;
        }

        .page-link:hover {
            background-color: #FF1493;
            border-color: #FF1493;
            color: white;
        }

        .page-item.active .page-link {
            background-color: #FF1493;
            border-color: #FF1493;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">GIFTY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.all') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('categories.index') }}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.my') }}">My Orders</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="category-header">
            <h2 class="mb-0">{{ $category->name }}</h2>
            <p class="text-muted mb-0">{{ $products->total() }} {{ Str::plural('product', $products->total()) }} found</p>
        </div>

        <div class="row">
            @forelse ($products as $product)
                <div class="col-md-4">
                    <a href="{{ route('products.show', $product) }}" class="text-decoration-none">
                        <div class="product-card" style="padding: 1.5rem; background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.85)); border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); position: relative; height: 100%; display: flex; flex-direction: column; border: 1px solid rgba(255, 20, 147, 0.1);">
                            @if($product->is_promo && $product->promo_price)
                                <div class="discount-badge" style="position: absolute; top: 15px; left: 15px; background: linear-gradient(45deg, #ff1493, #ff69b4); color: white; padding: 8px 12px; font-size: 0.9rem; border-radius: 25px; font-weight: bold; box-shadow: 0 2px 10px rgba(255, 20, 147, 0.2); display: flex; align-items: center; gap: 4px;">
                                    <i class="fas fa-tags" style="font-size: 0.8rem;"></i>
                                    {{ round((($product->price - $product->promo_price) / $product->price) * 100) }}% OFF
                                </div>
                            @endif
                            <div class="wishlist-icon" style="position: absolute; top: 15px; right: 15px; color: #ff1493; font-size: 1.4rem; cursor: pointer; background: rgba(255, 255, 255, 0.9); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                                <i class="far fa-heart"></i>
                            </div>
                            <img src="{{ asset('storage/' . ($product->image ?? 'default-image.jpg')) }}" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: contain; border-radius: 10px; background-color: rgba(255, 255, 255, 0.9); padding: 0.8rem; transition: transform 0.3s ease;" />
                            <div class="product-name" style="font-weight: 700; font-size: 1.1rem; color: #333; margin-top: 1rem; text-align: left; flex-shrink: 0; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">{{ $product->name ?? 'Unnamed Product' }}</div>
                            <div class="product-description" style="font-weight: 500; font-size: 0.9rem; color: #666; margin-top: 0.5rem; text-align: left; flex-grow: 1; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">{{ $product->description ?? 'No description available' }}</div>
                            <div class="product-price" style="font-weight: bold; font-size: 1.2rem; color: #ff1493; margin-top: 1rem; text-align: left; display: flex; align-items: center; gap: 8px;">
                                @if($product->is_promo && $product->promo_price)
                                    <span class="original-price" style="font-size: 0.9rem; color: #999; text-decoration: line-through;">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</span>
                                    <span>Rp {{ number_format($product->promo_price, 0, ',', '.') }}</span>
                                @else
                                    <span>Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <div class="buy-button" style="margin-top: 1rem; text-align: right;">
                                <a href="{{ route('products.show', $product->id ?? 0) }}" class="btn btn-sm btn-danger" style="background: linear-gradient(45deg, #ff1493, #ff69b4); border: none; padding: 8px 20px; border-radius: 25px; font-weight: 600; transition: all 0.3s ease; box-shadow: 0 2px 10px rgba(255, 20, 147, 0.2);">
                                    <i class="fas fa-shopping-cart me-1"></i>
                                    Beli Sekarang
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h4>No products found in this category</h4>
                    <p class="text-muted">Check back later for new products</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 