<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kod tasdiqlash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .register-card { max-width: 400px; width: 100%; border-radius: 16px; border: none; }
        .icon-box { width: 50px; height: 50px; background-color: #198754; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.5rem; }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">

    <div class="register-card bg-white p-4 shadow-sm">
        <div class="text-center">
            <div class="icon-box"><i class="bi bi-shield-check"></i></div>
            <h4 class="fw-bold">Kod tasdiqlash</h4>
            <p class="text-muted small">Emailingizga yuborilgan 6 xonali kodni kiriting</p>
        </div>

        <form action="{{ route('authemailcheckcode') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
        
            <div class="mb-4">
                <input type="number" name="code" class="form-control p-3 text-center fs-4" placeholder="000000" required>
            </div>
            
            @error('code')
                <div class="alert alert-danger p-2 small">{{ $message }}</div>
            @enderror
        
            <button type="submit" class="btn btn-success w-100 p-2">Tizimga kirish</button>
        </form>
    </div>
</body>
</html>