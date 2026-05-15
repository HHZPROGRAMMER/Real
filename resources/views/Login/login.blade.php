<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sahifasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: sans-serif;
        }
        .login-card {
            max-width: 450px;
            width: 100%;
            border-radius: 10px;
        }
        .nav-tabs .nav-link {
            color: #495057;
            font-weight: 500;
        }
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
        }
        .demo-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">

    <div class="login-card bg-white p-4 shadow-sm">
        <div class="text-center mb-3">
            <div class="bg-primary text-white d-inline-flex p-3 rounded" style="font-size: 24px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
            </div>
            <h3 class="mt-3">Xush kelibsiz</h3>
            <p class="text-muted">Davom etish uchun tizimga kiring</p>
        </div>

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item w-50">
                <a class="nav-link active text-center" href="#">Parol bilan kirish</a>
            </li>
            <li class="nav-item w-50">
                <a class="nav-link text-center" href="{{ route("email") }}">Email kod bilan kirish</a>
            </li>
        </ul>

        <form action="{{ route('authlogin') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Emailingizni kiriting" required>
                
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Parol</label>
                <input type="password" name="password" class="form-control" placeholder="Parolingizni kiriting" required>
                
                @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            
            
            <button type="submit" class="btn btn-primary w-100 py-2">Kirish</button>
        </form>

        <div class="text-center mt-3">
            <p class="text-muted">Hisobingiz yo'qmi? <a href="{{ route('register') }}" class="text-primary text-decoration-none">Ro'yxatdan o'tish</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>