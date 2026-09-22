<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Penjualan - Blossom Shoes</title>
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

        .btn-profile {
            color: #ffffff !important;
            font-weight: 800;
            letter-spacing: 0.5px;
            font-size: 1.1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .navbar-custom .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
            border-radius: 20px;
            padding: 8px 18px;
            margin: 0 3px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(8px);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
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
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15),
                        inset 0 1px 1px rgba(255, 255, 255, 0.5);
            margin-bottom: 2rem;
        }

        /* 5. KARTU & PANEL KONTEN KACA 3D */
        .custom-card, .table-card {
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            padding: 25px;
        }

        /* STYLING PRINT (Hanya elemen laporan yang dicetak) */
        @media print {
            body {
                background: white !important;
                color: black !important;
            }
            body::before, body::after, .navbar-custom, .print-hide {
                display: none !important;
            }
            .container {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .custom-card {
                background: white !important;
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
            }
            .dashboard-header {
                background: none !important;
                color: black !important;
                border: none !important;
                box-shadow: none !important;
                padding: 10px 0 !important;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar POS Toko Sepatu -->
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
            <!-- Menu Baru QnA -->
            <li class="nav-item">
              <a class="nav-link {{ Request::is('qna*') ? 'active' : '' }}" href="{{ url('/qna') }}">QnA</a>
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

    <!-- Konten Utama Rekap Penjualan -->
    <div class="container my-4">
        
        <!-- Header Banner -->
        <div class="dashboard-header text-center">
            <h2 class="fw-bold mb-1"><i class="bi bi-journal-bookmark-fill me-2"></i>Rekap Penjualan</h2>
            <p class="mb-0 text-white-50" id="periodeJudul">Laporan Penjualan Blossom Shoes</p>
        </div>

        <!-- Filter & Card Penjualan -->
        <div class="custom-card">
            
            <!-- Controls (Di-hide saat cetak) -->
            <div class="row g-3 align-items-center mb-4 print-hide">
                <div class="col-md-3">
                    <label class="form-label fw-bold">Tipe Rekap:</label>
                    <select id="jenisRekap" class="form-select" onchange="toggleFilterInput()">
                        <option value="semua">Semua Data</option>
                        <option value="harian">Harian</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Pilih Periode:</label>
                    <input type="date" id="inputTanggal" class="form-control" style="display:none;">
                    <input type="month" id="inputBulan" class="form-control" style="display:none;">
                    <input type="number" id="inputTahun" class="form-control" placeholder="Contoh: 2026" min="2000" max="2100" style="display:none;">
                    <input type="text" id="inputSemua" class="form-control" value="Menampilkan Semua Data" disabled>
                </div>

                <div class="col-md-5 d-flex align-items-end gap-2 mt-auto">
                    <button class="btn btn-primary fw-bold w-100" onclick="filterData()">
                        <i class="bi bi-filter me-1"></i> Tampilkan
                    </button>
                    <button class="btn btn-success fw-bold w-100" onclick="window.print()">
                        <i class="bi bi-printer me-1"></i> Print Laporan
                    </button>
                </div>
            </div>

            <!-- Tabel Data Rekap -->
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle border">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 130px;">Tanggal</th>
                            <th>Nama Produk</th>
                            <th style="width: 100px;">Jumlah</th>
                            <th style="width: 160px;">Harga Satuan</th>
                            <th style="width: 180px;">Total</th>
                        </tr>
                    </thead>
                    <tbody id="tabelBody">
                        <!-- Data otomatis diisi JavaScript -->
                    </tbody>
                    <tfoot>
                        <tr class="table-secondary fw-bold fs-6">
                            <td colspan="5" class="text-end">Grand Total:</td>
                            <td id="grandTotal" class="text-end text-primary">Rp 0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

    <!-- Script Bootstrap & Logic Rekap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Data Sampel Transaksi Penjualan Blossom Shoes
        const dataPenjualan = [
            { tanggal: "2026-03-01", produk: "Sepatu Sneaker Blossom White", jumlah: 2, harga: 350000 },
            { tanggal: "2026-03-01", produk: "Sepatu Running Sport", jumlah: 1, harga: 450000 },
            { tanggal: "2026-03-02", produk: "Flat Shoes Floral", jumlah: 3, harga: 180000 },
            { tanggal: "2026-03-15", produk: "Heels Classic Rose", jumlah: 1, harga: 500000 },
            { tanggal: "2026-04-05", produk: "Sepatu Casual Canvas", jumlah: 2, harga: 250000 },
            { tanggal: "2025-12-20", produk: "Boots Leather Edition", jumlah: 1, harga: 750000 }
        ];

        // Format angka ke format Rupiah (Rp)
        function formatRupiah(angka) {
            return "Rp " + angka.toLocaleString("id-ID");
        }

        // Mengatur jenis input tanggal yang muncul
        function toggleFilterInput() {
            const jenis = document.getElementById("jenisRekap").value;
            document.getElementById("inputTanggal").style.display = (jenis === "harian") ? "block" : "none";
            document.getElementById("inputBulan").style.display = (jenis === "bulanan") ? "block" : "none";
            document.getElementById("inputTahun").style.display = (jenis === "tahunan") ? "block" : "none";
            document.getElementById("inputSemua").style.display = (jenis === "semua") ? "block" : "none";
        }

        // Proses Filter & Menampilkan ke Tabel
        function filterData() {
            const jenis = document.getElementById("jenisRekap").value;
            const tbody = document.getElementById("tabelBody");
            const periodeJudul = document.getElementById("periodeJudul");
            
            tbody.innerHTML = "";
            let totalKeseluruhan = 0;
            let filteredData = [];

            if (jenis === "harian") {
                const val = document.getElementById("inputTanggal").value;
                if (!val) return alert("Pilih tanggal terlebih dahulu!");
                filteredData = dataPenjualan.filter(item => item.tanggal === val);
                periodeJudul.innerText = `Laporan Penjualan Harian (${val})`;
            } else if (jenis === "bulanan") {
                const val = document.getElementById("inputBulan").value;
                if (!val) return alert("Pilih bulan dan tahun terlebih dahulu!");
                filteredData = dataPenjualan.filter(item => item.tanggal.startsWith(val));
                periodeJudul.innerText = `Laporan Penjualan Bulanan (${val})`;
            } else if (jenis === "tahunan") {
                const val = document.getElementById("inputTahun").value;
                if (!val) return alert("Masukkan tahun terlebih dahulu!");
                filteredData = dataPenjualan.filter(item => item.tanggal.startsWith(val));
                periodeJudul.innerText = `Laporan Penjualan Tahunan (${val})`;
            } else {
                filteredData = dataPenjualan;
                periodeJudul.innerText = "Laporan Penjualan Semua Periode";
            }

            if (filteredData.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-center py-3 text-muted">Tidak ada data transaksi pada periode ini.</td></tr>`;
                document.getElementById("grandTotal").innerText = formatRupiah(0);
                return;
            }

            filteredData.forEach((item, index) => {
                const total = item.jumlah * item.harga;
                totalKeseluruhan += total;

                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td class="text-center">${index + 1}</td>
                    <td class="text-center">${item.tanggal}</td>
                    <td>${item.produk}</td>
                    <td class="text-center">${item.jumlah}</td>
                    <td class="text-end">${formatRupiah(item.harga)}</td>
                    <td class="text-end fw-bold">${formatRupiah(total)}</td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById("grandTotal").innerText = formatRupiah(totalKeseluruhan);
        }

        // Jalankan fungsi awal saat halaman dibuka
        filterData();
    </script>
</body>
</html>