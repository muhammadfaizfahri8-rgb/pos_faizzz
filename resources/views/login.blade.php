@extends('layouts.app')

@section('title', 'Login')

@section('content')

<!-- Font & Icon Dependencies -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    *, *::before, *::after {
        box-sizing: border-box;
    }

    body {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: radial-gradient(circle at 10% 20%, rgba(0, 242, 254, 0.15) 0%, transparent 40%),
                    radial-gradient(circle at 90% 80%, rgba(79, 172, 254, 0.2) 0%, transparent 40%),
                    linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        min-height: 100vh;
        margin: 0;
        color: #f8fafc;
        overflow-x: hidden;
    }

    /* Ambient Background Glow Elements */
    .bg-glow-1, .bg-glow-2 {
        position: absolute;
        border-radius: 50%;
        filter: blur(90px);
        z-index: 0;
        pointer-events: none;
    }
    .bg-glow-1 {
        width: 320px;
        height: 320px;
        background: #00f2fe;
        top: 15%;
        left: 20%;
        opacity: 0.25;
        animation: float 8s ease-in-out infinite alternate;
    }
    .bg-glow-2 {
        width: 380px;
        height: 380px;
        background: #3b82f6;
        bottom: 15%;
        right: 20%;
        opacity: 0.2;
        animation: float 10s ease-in-out infinite alternate-reverse;
    }

    @keyframes float {
        0% { transform: translateY(0) scale(1); }
        100% { transform: translateY(-30px) scale(1.05); }
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px 16px;
        position: relative;
        z-index: 1;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 28px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4),
                    0 0 40px rgba(0, 242, 254, 0.15);
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        animation: cardAppear 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #00f2fe, #3b82f6, transparent);
    }

    @keyframes cardAppear {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.96);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .login-header {
        text-align: center;
        padding-top: 36px;
        padding-bottom: 8px;
        perspective: 1000px; /* Perspektif 3D */
    }

    /* -------------------------------------------------------------
       BADGE & IKON GEMBOK 3D INTERAKTIF
    ------------------------------------------------------------- */
    @keyframes lockFloat {
        0%, 100% { transform: translateY(0) rotate(-2deg); }
        50% { transform: translateY(-6px) rotate(2deg); }
    }

    .login-icon-badge {
        width: 76px;
        height: 76px;
        background: linear-gradient(145deg, #00f2fe 0%, #3b82f6 100%);
        border-radius: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 
            0 15px 25px -5px rgba(0, 242, 254, 0.5),
            0 8px 10px -6px rgba(0, 0, 0, 0.3),
            inset 0 2px 2px rgba(255, 255, 255, 0.6),
            inset 0 -3px 6px rgba(0, 0, 0, 0.2);
        color: #ffffff;
        font-size: 2.2rem;
        margin-bottom: 20px;
        position: relative;
        animation: lockFloat 4s ease-in-out infinite;
        transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transform-style: preserve-3d;
    }

    /* Glass Reflection Layer */
    .login-icon-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 45%;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.45) 0%, rgba(255, 255, 255, 0) 100%);
        border-radius: 22px 22px 100% 100%;
        pointer-events: none;
    }

    /* Drop shadow ikon di dalam badge */
    .login-icon-badge i {
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.25)) 
                drop-shadow(0 1px 1px rgba(255, 255, 255, 0.4));
        transition: transform 0.4s ease, opacity 0.3s ease;
    }

    /* STATUS TERBUKA (UNLOCK STATE) - AKTIF SAAT USER KETIK DATA */
    .login-icon-badge.unlocked {
        background: linear-gradient(145deg, #10b981 0%, #059669 100%); /* Warna Emerald Green 3D */
        box-shadow: 
            0 18px 30px -5px rgba(16, 185, 129, 0.6),
            0 8px 10px -6px rgba(0, 0, 0, 0.3),
            inset 0 2px 2px rgba(255, 255, 255, 0.7),
            inset 0 -3px 6px rgba(0, 0, 0, 0.2);
        animation: lockUnlocked3D 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    @keyframes lockUnlocked3D {
        0% { transform: scale(1) rotate(0deg); }
        50% { transform: scale(1.18) rotateY(180deg) translateY(-8px); }
        100% { transform: scale(1.08) rotateY(360deg) translateY(-4px); }
    }

    .login-card:hover .login-icon-badge:not(.unlocked) {
        transform: scale(1.1) rotate(0deg);
        box-shadow: 
            0 20px 30px -5px rgba(0, 242, 254, 0.7),
            0 10px 15px -5px rgba(0, 0, 0, 0.4),
            inset 0 2px 4px rgba(255, 255, 255, 0.8);
    }
    /* ------------------------------------------------------------- */

    .login-title {
        color: #ffffff;
        font-weight: 800;
        font-size: 1.6rem;
        letter-spacing: -0.025em;
        margin-bottom: 6px;
    }

    .login-subtitle {
        color: #94a3b8;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Input Field Styling */
    .input-group-custom {
        position: relative;
        margin-bottom: 20px;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 1.1rem;
        transition: color 0.3s ease;
        z-index: 2;
    }

    .form-control-custom {
        width: 100%;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        padding: 0.85rem 1rem 0.85rem 2.8rem;
        background-color: rgba(255, 255, 255, 0.05);
        color: #ffffff;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.95rem;
    }

    .form-control-custom::placeholder {
        color: #64748b;
    }

    .form-control-custom:focus {
        outline: none;
        background-color: rgba(255, 255, 255, 0.08);
        border-color: #00f2fe;
        box-shadow: 0 0 0 4px rgba(0, 242, 254, 0.15);
    }

    .form-control-custom:focus + .input-icon,
    .input-group-custom:focus-within .input-icon {
        color: #00f2fe;
    }

    /* Password Toggle Button */
    .btn-toggle-password {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #64748b;
        cursor: pointer;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.3s ease;
        z-index: 2;
    }

    .btn-toggle-password:hover {
        color: #f8fafc;
    }

    .form-label-custom {
        display: block;
        font-weight: 600;
        color: #cbd5e1;
        font-size: 0.85rem;
        margin-bottom: 8px;
    }

    /* Button Styling */
    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, #00f2fe 0%, #3b82f6 100%);
        border: none;
        border-radius: 14px;
        padding: 0.9rem 1.5rem;
        font-weight: 700;
        font-size: 1rem;
        color: #ffffff;
        letter-spacing: 0.025em;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px -5px rgba(0, 242, 254, 0.4);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .btn-submit::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            60deg,
            transparent,
            rgba(255, 255, 255, 0.2),
            transparent
        );
        transform: rotate(30deg);
        transition: transform 0.6s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -5px rgba(0, 242, 254, 0.6);
    }

    .btn-submit:hover::after {
        transform: rotate(30deg) translate(100%, 100%);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Alert / Validation Badges */
    .error-feedback {
        color: #f87171;
        font-size: 0.8rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
</style>

<!-- Background Ambient Elements -->
<div class="bg-glow-1"></div>
<div class="bg-glow-2"></div>

<div class="login-wrapper">
    <div class="login-card">
        <div class="p-4 p-sm-5">
            <!-- Header -->
            <div class="login-header">
                <!-- Icon Badge 3D Gembok Interaktif -->
                <div class="login-icon-badge" id="lockBadge">
                    <i class="bi bi-lock-fill" id="lockIcon"></i>
                </div>
                <h4 class="login-title">Selamat Datang!</h4>
                <p class="login-subtitle">Silakan masuk untuk mengakses akun Anda</p>
            </div>

            <!-- Form -->
            <form action="{{ route('auth') }}" method="POST" class="mt-4">
                @csrf
                
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="emailInput" class="form-label-custom">Alamat Email</label>
                    <div class="input-group-custom">
                        <i class="bi bi-envelope input-icon"></i>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            class="form-control-custom" 
                            id="emailInput" 
                            placeholder="nama@email.com"
                            required
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <div class="error-feedback">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Password Input -->
                <div class="mb-4">
                    <label for="passwordInput" class="form-label-custom">Kata Sandi</label>
                    <div class="input-group-custom">
                        <i class="bi bi-lock input-icon"></i>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control-custom" 
                            id="passwordInput" 
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" class="btn-toggle-password" id="togglePassword" aria-label="Toggle password visibility">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-feedback">
                            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-submit">
                    Masuk Sekarang <i class="bi bi-arrow-right-short ms-1"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Script Interaktif Gembok 3D Membuka/Menutup -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('emailInput');
        const passwordInput = document.getElementById('passwordInput');
        const lockBadge = document.getElementById('lockBadge');
        const lockIcon = document.getElementById('lockIcon');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        // Fungsi Memeriksa Status Input & Mengubah Gembok 3D
        function checkLockStatus() {
            const hasEmail = emailInput.value.trim().length > 0;
            const hasPassword = passwordInput.value.trim().length > 0;

            // Jika ada teks di email ATAU password, buka gembok
            if (hasEmail || hasPassword) {
                if (!lockBadge.classList.contains('unlocked')) {
                    lockBadge.classList.add('unlocked');
                    lockIcon.className = 'bi bi-unlock-fill';
                }
            } else {
                // Jika kosong, kunci gembok kembali
                if (lockBadge.classList.contains('unlocked')) {
                    lockBadge.classList.remove('unlocked');
                    lockIcon.className = 'bi bi-lock-fill';
                }
            }
        }

        // Event Listener ketika User mengetik
        emailInput.addEventListener('input', checkLockStatus);
        passwordInput.addEventListener('input', checkLockStatus);

        // Cek status awal (misal jika browser auto-fill data email/password)
        checkLockStatus();

        // Toggle Show/Hide Password
        if (togglePassword && passwordInput && eyeIcon) {
            togglePassword.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                eyeIcon.classList.toggle('bi-eye', !isPassword);
                eyeIcon.classList.toggle('bi-eye-slash', isPassword);
            });
        }
    });
</script>

@endsection