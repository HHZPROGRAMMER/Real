<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hisob yaratish</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .register-card {
            max-width: 480px;
            width: 100%;
            border-radius: 16px;
            border: none;
        }
        .info-alert {
            background-color: #eef6ff;
            border: 1px solid #d1e7ff;
            border-radius: 10px;
            font-size: 0.9rem;
            color: #084298;
        }
        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }
        .form-control {
            border-radius: 8px;
            padding: 0.6rem 0.75rem;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        }
        .btn-primary {
            border-radius: 8px;
            padding: 0.7rem;
            font-weight: 500;
        }
        .icon-box {
            width: 50px;
            height: 50px;
            background-color: #0d6efd;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.5rem;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100 py-5">

    <div class="register-card bg-white p-4 shadow-sm">
        <div class="text-center">
            <div class="icon-box">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h3 class="fw-bold">Hisob yaratish</h3>
            <p class="text-muted small">Boshlash uchun ro'yxatdan o'ting</p>
        </div>

        <div class="info-alert p-3 my-4">
            <p class="mb-0">
                <strong>Eslatma:</strong> Ro'yxatdan o'tgach, administrator sizga rol tayinlashi kerak, shundan keyingina tizimga kirishingiz mumkin.
            </p>
        </div>

        <form action="{{ route('authregister') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Foydalanuvchi nomi</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror" placeholder="Foydalanuvchi nomini tanlang" value="{{ old('name') }}" required>
                </div>
                @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
        
            <div class="mb-3">
                <label class="form-label">Email manzil</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" placeholder="sizning@email.uz" value="{{ old('email') }}" required>
                </div>
                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
        
            <div class="mb-3">
                <label class="form-label">Parol</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" placeholder="Parol yarating" required>
                </div>
                @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
        
            <div class="mb-4">
                <label class="form-label">Parolni tasdiqlash</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password_confirmation" class="form-control border-start-0 ps-0" placeholder="Parolni qayta kiriting" required>
                </div>
            </div>
        
            <button type="submit" class="btn btn-primary w-100 mb-4">Hisob yaratish</button>
        </form>

        <div class="text-center pt-2 border-top">
            <p class="small text-muted mb-0">
                Hisobingiz bormi? <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Kirish</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>