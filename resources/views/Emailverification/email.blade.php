<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email kod bilan kirish</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f9; font-family: sans-serif; }
        .login-card { max-width: 450px; width: 100%; border-radius: 12px; }
        
        /* "Qanday ishlaydi" qutisi */
        .info-box { background-color: #eef6ff; border: 1px solid #d1e7ff; border-radius: 8px; color: #084298; }
        
        /* Stepper (Qadamlar) chizig'i */
        .stepper { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; }
        .step { display: flex; flex-direction: column; align-items: center; color: #adb5bd; }
        .step-icon { width: 35px; height: 35px; border: 1px solid #adb5bd; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 5px; }
        .step-line { flex-grow: 1; height: 1px; background-color: #dee2e6; margin: 0 10px; margin-top: -20px; }
        .step.active { color: #0d6efd; }
        .step.active .step-icon { border-color: #0d6efd; color: #0d6efd; }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">

    <div class="login-card bg-white p-4 shadow-sm">
        <div class="text-center mb-4">
            <div class="bg-primary text-white d-inline-flex p-3 rounded mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path d="M5 5h6v1H5V5zm0 2h6v1H5V7zm0 2h4v1H5V9z"/>
                </svg>
            </div>
            <h4>Xush kelibsiz</h4>
            <p class="text-muted small">Davom etish uchun tizimga kiring</p>
        </div>

        <ul class="nav nav-tabs mb-4">
            <li class="nav-item w-50"><a class="nav-link text-center" href="{{ route("login") }}">Parol bilan kirish</a></li>
            <li class="nav-item w-50"><a class="nav-link active text-center" href="#">Email kod bilan kirish</a></li>
        </ul>

        <div class="info-box p-3 mb-4">
            <small class="fw-bold">Qanday ishlaydi:</small>
            <ol class="small ps-3 mb-0">
                <li>Email manzilingizni kiriting</li>
                <li>Tasdiqlash kodi emailingizga yuboriladi</li>
                <li>Emailingizni tekshiring va 6 xonali kodni kiriting</li>
                <li>Tizimga kirasiz!</li>
            </ol>
        </div>

        <form action="{{ route('authemail') }}" method="POST">
            @csrf 
            <label class="form-label small">Email manzil</label>
            
            <div class="input-group mb-3">
                <span class="input-group-text bg-white"><i class="bi bi-envelope"></i>@</span>
                
                <input type="email" 
                       name="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       placeholder="sizning@email.uz" 
                       value="{{ old('email') }}" 
                       required>
        
                @error('email')
                    <div class="invalid-feedback">
                        {{ "Bu foydalanuvchi registratsiyadan otmagan !!!" }}
                    </div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-4">Tasdiqlash kodini yuborish</button>
        </form>

        <div class="stepper">
            <div class="step {{ request()->routeIs('email.page') ? 'active' : '' }}">
                <div class="step-icon">📧</div>
                <span>Email kiriting</span>
            </div>
        
            <div class="step-line {{ request()->routeIs('code.page', 'verify.page') ? 'active' : '' }}"></div>
        
            <div class="step {{ request()->routeIs('code.page') ? 'active' : '' }}">
                <div class="step-icon">✈️</div>
                <span>Kod yuborildi</span>
            </div>
        
            <div class="step-line {{ request()->routeIs('verify.page') ? 'active' : '' }}"></div>
        
            <div class="step {{ request()->routeIs('verify.page') ? 'active' : '' }}">
                <div class="step-icon">✅</div>
                <span>Tasdiqlash</span>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>