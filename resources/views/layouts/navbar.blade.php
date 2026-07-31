<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi POS - Toko Bunga</title>
    <!-- Contoh menyertakan CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Kustomisasi Navbar Tema Bright Blue & Modern Rounded */
        .navbar-custom {
            background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%) !important;
            box-shadow: 0 8px 20px rgba(0, 114, 255, 0.25);
            border-radius: 0 0 20px 20px; /* Lengkungan di bawah navbar */
            padding-top: 12px;
            padding-bottom: 12px;
        }

        /* Warna Brand / Logo */
        .navbar-custom .navbar-brand {
            color: #ffffff !important;
            font-weight: 800;
            letter-spacing: 0.5px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Warna Link Menu dengan Ujung Tumpul Soft */
        .navbar-custom .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.88) !important;
            transition: all 0.3s ease;
            border-radius: 12px;
            padding: 8px 16px;
            margin: 0 4px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        /* Efek Hover dan Active pada Link Menu */
        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.22);
            backdrop-filter: blur(4px);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Tombol Toggler (Hamburger) Mobile */
        .navbar-custom .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            padding: 6px 10px;
        }

        .navbar-custom .navbar-toggler-icon {
            filter: brightness(0) invert(1);
        }

        /* Kustomisasi Tombol Keluar (Logout) */
        .navbar-custom .btn-logout {
            background-color: #ffffff;
            color: #0072ff;
            font-weight: 700;
            border-radius: 12px;
            padding: 8px 20px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .btn-logout:hover {
            background-color: #e0f2fe;
            color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>

    <!-- Navbar POS Toko Bunga -->
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid px-3">
        <a class="navbar-brand" href="#">
          <span>⚡</span> Blossom POS
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Menu Utama di Sebelah Kiri -->
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
          </ul>

          <!-- Tombol Logout di Sebelah Kanan -->
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