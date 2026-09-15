<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi POS - Toko Bunga</title>
    <!-- CSS Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* 1. Animasi Bergerak Latar Belakang & Elemen 3D */
        @keyframes dynamicGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes floatOrb1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(120px, 80px) scale(1.2); }
        }

        @keyframes floatOrb2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-100px, -60px) scale(1.15); }
        }

        /* 2. BODY DENGAN BACKGROUND 3D VIBRANT BERGANTI WARNA */
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            /* Gradient Vibrant (Vivid Blue -> Royal Purple -> Cyan -> Deep Indigo) */
            background: linear-gradient(-45deg, #00d2ff, #3a7bd5, #6a11cb, #2575fc, #00c6ff);
            background-size: 400% 400%;
            animation: dynamicGradient 14s ease infinite;
            min-height: 100vh;
            margin: 0;
            position: relative;
            overflow-x: hidden;
        }

        /* Bola-Bola Gradasi 3D Melayang di Latar Belakang */
        body::before,
        body::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.6;
            pointer-events: none;
        }

        body::before {
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, #00f2fe 0%, #4facfe 100%);
            top: -10%;
            left: -5%;
            animation: floatOrb1 12s ease-in-out infinite;
        }

        body::after {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #00c6ff 0%, #0072ff 100%);
            bottom: -15%;
            right: -5%;
            animation: floatOrb2 15s ease-in-out infinite;
        }

        /* 3. NAVBAR KACA 3D (GLASSMORPHISM) */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15), 
                        inset 0 1px 0 rgba(255, 255, 255, 0.4);
            border-radius: 0 0 24px 24px;
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .navbar-custom .navbar-brand {
            color: #ffffff !important;
            font-weight: 800;
            letter-spacing: 0.5px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .navbar-custom .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
            border-radius: 12px;
            padding: 8px 16px;
            margin: 0 4px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .navbar-custom .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            padding: 6px 10px;
        }

        .navbar-custom .navbar-toggler-icon {
            filter: brightness(0) invert(1);
        }

        .navbar-custom .btn-logout {
            background: linear-gradient(135deg, #ffffff, #f0f4f8);
            color: #0072ff;
            font-weight: 700;
            border-radius: 12px;
            padding: 8px 20px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            color: #0056b3;
        }

        /* 4. HEADER BANNER MODEREN 3D */
        .dashboard-header {
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            color: #fff;
            padding: 3rem 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15),
                        inset 0 1px 1px rgba(255, 255, 255, 0.5);
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
        }

        /* 5. KARTU & PANEL KONTEN KACA 3D (EFEK MELAYANG) */
        .custom-card, .table-card {
            background: rgba(255, 255, 255, 0.88) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08), 
                        0 5px 15px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .custom-card:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            background: rgba(255, 255, 255, 0.95) !important;
        }
    </style>
</head>
<body>

    <!-- Navbar POS Toko Bunga -->
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid px-4">
<a href="{{ route('profile') }}" class="btn-profile">
    <span>👟</span> Profil Blossom Shoes
</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Menu Utama -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Halaman utama</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">Akun</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('produk*') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('penjualan*') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
            </li>
            <li class="nav-item">
          <a class="nav-link {{ Request::is('about*') ? 'active' : '' }}" href="{{ route('about') }}">Tentang</a>
        </li>
          </ul>

          <!-- Tombol Logout -->
          <div class="d-flex mt-3 mt-lg-0">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
              @csrf
              <button type="submit" class="btn btn-logout">Keluar</button>
            </form>
          </div>

        </div>
      </div>
    </nav>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>