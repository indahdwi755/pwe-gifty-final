<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - GIFTY</title>
    
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

        .category-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 1.5rem;
            overflow: hidden;
            border: 1px solid rgba(255, 20, 147, 0.1);
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(255, 20, 147, 0.1);
        }

        .category-card .card-body {
            padding: 1.5rem;
        }

        .category-card h5 {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .category-card p {
            color: #666;
            font-size: 0.9rem;
        }

        .product-count {
            color: #FF1493;
            font-weight: 500;
        }

        .search-box {
            border: 2px solid #FF1493;
            border-radius: 25px;
            padding: 0.5rem 1rem;
        }

        .search-box:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 20, 147, 0.25);
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
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="mb-0">Categories</h2>
                <p class="text-muted">Browse products by category</p>
            </div>
            <div class="col-md-6">
                <form method="GET" action="{{ route('categories.index') }}">
                    <input type="text" name="search" class="form-control search-box" placeholder="Search categories..." value="{{ request('search') }}">
                </form>
            </div>
        </div>

        <div class="row">
            @forelse ($categories as $category)
                <div class="col-md-4">
                    <a href="{{ route('categories.show', $category) }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="card-body">
                                <h5>{{ $category->name }}</h5>
                                <p class="mb-0">
                                    <span class="product-count">{{ $category->products_count }}</span> 
                                    {{ Str::plural('product', $category->products_count) }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h4>No categories found</h4>
                    <p class="text-muted">Check back later for new categories</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 