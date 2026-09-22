<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QnA / FAQ - Blossom Shoes</title>
    <!-- CSS Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        @keyframes dynamicGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background: linear-gradient(-45deg, #00d2ff, #3a7bd5, #6a11cb, #2575fc, #00c6ff);
            background-size: 400% 400%;
            animation: dynamicGradient 14s ease infinite;
            min-height: 100vh;
            margin: 0;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0 0 24px 24px;
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .btn-profile {
            color: #ffffff !important;
            font-weight: 800;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            border-radius: 20px;
            padding: 8px 18px;
            margin: 0 3px;
            font-weight: 600;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.35);
        }

        .dashboard-header {
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            color: #fff;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .custom-card {
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            padding: 25px;
        }

        .accordion-button:not(.collapsed) {
            background-color: #0072ff;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid px-4">
        <a href="{{ route('profile') }}" class="btn-profile">
            <span>👟</span> Profil Blossom Shoes
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Halaman utama</a>
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
            <li class="nav-item">
              <a class="nav-link {{ Request::is('qna*') ? 'active' : '' }}" href="{{ route('qna') }}">QnA</a>
            </li>
          </ul>

          <div class="d-flex">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
              @csrf
              <button type="submit" class="btn btn-light fw-bold text-primary rounded-3">Keluar</button>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <!-- Konten QnA -->
    <div class="container my-4">
        <div class="dashboard-header text-center">
            <h2 class="fw-bold mb-1"><i class="bi bi-question-circle-fill me-2"></i>Tanya Jawab (QnA)</h2>
            <p class="mb-0 text-white-50">Pertanyaan umum seputar penggunaan aplikasi POS Blossom Shoes</p>
        </div>

        <div class="custom-card">
            <div class="accordion" id="qnaAccordion">
                
                <div class="accordion-item mb-3 border rounded shadow-sm">
                    <h2 class="accordion-header" id="faq1">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                            1. Bagaimana Cara Menambahkan Produk Baru di Blossom Shoes?
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#qnaAccordion">
                        <div class="accordion-body">
                            Anda dapat menambahkan produk baru melalui menu <strong>Produk</strong> pada navbar, lalu tekan tombol <em>Tambah Produk</em> dan isi formulir data sepatu yang sesuai.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3 border rounded shadow-sm">
                    <h2 class="accordion-header" id="faq2">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                            2. Bagaimana Cara Mencetak Rekap Penjualan?
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#qnaAccordion">
                        <div class="accordion-body">
                            Buka menu <strong>Penjualan</strong>, pilih periode rekap (Harian, Bulanan, atau Tahunan), klik <em>Tampilkan</em>, lalu tekan tombol <strong>Print Laporan</strong>.
                        </div>
                    </div>
                </div>

                <div class="accordion-item mb-3 border rounded shadow-sm">
                    <h2 class="accordion-header" id="faq3">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                            3. Bagaimana Cara Mengelola Pengguna/Akun Kasir?
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#qnaAccordion">
                        <div class="accordion-body">
                            Pengelolaan akun dapat dilakukan oleh Admin melalui menu <strong>Akun</strong> pada navbar untuk menambah, mengedit, atau menghapus hak akses pengguna.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>