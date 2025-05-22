<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Zantroke&display=swap" rel="stylesheet" />
  <title>Login - GIFTY</title>
  <style>
    body {
      font-family: 'Zantroke', sans-serif;
      background: linear-gradient(to bottom right, #fffcfd, #ffc0cb33);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }
    .brand {
      font-size: 2.5rem;
      font-weight: bold;
      background: linear-gradient(to right, #ff69b4, #ff1493);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-align: center;
      margin-bottom: 1rem;
    }
    .login-box {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      max-width: 400px;
      width: 100%;
    }
    .form-label {
      font-weight: 600;
    }
    .form-control {
      border-radius: 8px;
      padding: 0.5rem 1rem;
    }
    .btn-primary {
      background-color: #ff1493;
      border-color: #ff1493;
      font-weight: bold;
      border-radius: 8px;
    }
    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary:focus:active {
      background-color: #e91e63;
      border-color: #e91e63;
      box-shadow: none;
    }
    .alert {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <div class="brand">LOGIN</div>

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="" method="POST">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" value="{{ old('email') }}" name="email" class="form-control" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required />
      </div>
      <div class="mb-3 d-grid">
        <button name="submit" type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
    <div class="text-center mt-3">
      <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none" style="color: #ff1493;">Register here</a></p>
    </div>
  </div>
</body>
</html>
