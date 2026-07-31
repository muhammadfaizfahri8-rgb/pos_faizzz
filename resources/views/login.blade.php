<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Login')

<!-- batas awal isi konten -->
@section('content')

<!-- Custom Styling for Login (Bright Blue / Modern Cyan Theme) -->
<style>
    body {
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        min-height: 100vh;
        overflow: hidden;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Card dengan gaya Modern Soft Shadow & Border Cyan Soft */
    .login-card {
        width: 23rem;
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 114, 255, 0.3);
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(12px);
        animation: zoomInFade 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes zoomInFade {
        from {
            opacity: 0;
            transform: translate(-50%, -45%) scale(0.92);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    /* Icon Badge terpisah di atas form */
    .login-icon-badge {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #00d2ff 0%, #0072ff 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -40px auto 15px auto;
        box-shadow: 0 8px 20px rgba(0, 198, 255, 0.4);
        color: white;
        font-size: 1.8rem;
    }

    .login-title {
        color: #0b2545;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .login-subtitle {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 1.5rem;
    }

    .form-control {
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        padding: 0.75rem 1rem;
        background-color: #f8fafc;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: #0099ff;
        box-shadow: 0 0 0 4px rgba(0, 153, 255, 0.15);
    }

    .btn-submit {
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        border: none;
        border-radius: 12px;
        padding: 0.8rem 2rem;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 114, 255, 0.35);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(0, 114, 255, 0.5);
        background: linear-gradient(135deg, #00b4d8 0%, #0056b3 100%);
    }

    .form-label {
        font-weight: 600;
        color: #1e293b;
        font-size: 0.875rem;
        margin-bottom: 0.4rem;
    }
</style>

<div class="card text-center position-absolute top-50 start-50 translate-middle login-card">
    <div class="card-body p-4 pt-0">
        <!-- Floating Icon Badge -->
        <div class="login-icon-badge">
            ⚡
        </div>
        
        <h4 class="login-title mb-1">Selamat Datang!</h4>
        <p class="login-subtitle">Silakan masuk ke akun Anda</p>

        <form action="{{ route('auth') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-control" 
                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nama@email.com">
                @error('email')
                    <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4 text-start">
                <label for="exampleInputPassword1" class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-control" 
                id="exampleInputPassword1" placeholder="••••••••">
                @error('password')
                    <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-submit text-white w-100">Masuk Sekarang</button>
        </form>
    </div>
</div>

<!-- batas Akhir isi konten -->
@endsection