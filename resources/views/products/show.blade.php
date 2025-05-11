<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Product - {{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm rounded">
                    <img src="{{ asset('storage/' . ($product->image ?? 'default-image.jpg')) }}" class="card-img-top rounded" alt="{{ $product->name }}">
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="card-title">{{ $product->name }}</h3>
                        <hr>
                        <h5 class="text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                        <p>{!! $product->description !!}</p>
                        <p><strong>Stok:</strong> {{ $product->stock }}</p>

                        <!-- Kategori Produk -->
                        <p><strong>Kategori:</strong> 
                            {{ $product->category ? $product->category->name : 'Kategori Tidak Tersedia' }}
                        </p>

                        <!-- Tombol Kembali -->
                        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
