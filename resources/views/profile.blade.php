<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan - Blossom Shoes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f6ff;
            color: #1e293b;
            line-height: 1.6;
        }

        /* Hero Header Warna Biru */
        .hero {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Container Content */
        .container {
            max-width: 1000px;
            margin: -40px auto 50px;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .card h2 {
            color: #1d4ed8;
            margin-bottom: 15px;
            border-bottom: 2px solid #bfdbfe;
            padding-bottom: 8px;
        }

        /* Grid Feature / Visi Misi */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-top: 20px;
        }

        .stat-item h3 {
            font-size: 2rem;
            color: #2563eb;
        }

        .stat-item p {
            font-size: 0.9rem;
            color: #64748b;
        }

        /* Navigation Link / Back Button */
        .back-nav {
            margin-bottom: 20px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: white;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .btn-back:hover {
            background-color: rgba(255, 255, 255, 0.35);
        }
    </style>
</head>
<body>

    <!-- Hero Header -->
    <header class="hero">
        <div class="back-nav">
            <a href="{{ route('dashboard') }}" class="btn-back">← Kembali ke Dashboard</a>
        </div>
        <h1>👟 Blossom Shoes</h1>
        <p>Langkah Nyaman, Gaya Maksimal untuk Setiap Momen</p>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Tentang Perusahaan -->
        <section class="card">
            <h2>Tentang Perusahaan</h2>
            <p>
                <strong>Blossom Shoes</strong> adalah penyedia sepatu berkualitas tinggi yang berfokus pada kombinasi antara kenyamanan premium, kenyamanan ergonomis, dan tren fashion terkini. Berdiri sejak tahun 2020, Blossom berkomitmen untuk menemani setiap langkah masyarakat Indonesia dengan berbagai koleksi sepatu pilihan, mulai dari sneakers harian, sepatu formal, hingga pilihan alas kaki olahraga.
            </p>
        </section>

        <!-- Visi & Misi -->
        <div class="grid-2">
            <section class="card">
                <h2>Visi Kami</h2>
                <p>
                    Menjadi merek sepatu lokal terdepan yang dikenal secara global berkat inovasi desain, kenyamanan material, dan keberlanjutan produk.
                </p>
            </section>

            <section class="card">
                <h2>Misi Kami</h2>
                <ul style="padding-left: 20px;">
                    <li>Menyediakan alas kaki berkualitas tinggi dengan harga yang terjangkau.</li>
                    <li>Menghadirkan desain modern yang terus mengikuti perkembangan tren fashion global.</li>
                    <li>Memberikan pengalaman belanja terbaik dan layanan purna jual yang memuaskan bagi para pelanggan.</li>
                </ul>
            </section>
        </div>

        <!-- Pencapaian -->
        <section class="card">
            <h2>Pencapaian & Statistik</h2>
            <div class="stats">
                <div class="stat-item">
                    <h3>50.000+</h3>
                    <p>Pasang Sepatu Terjual</p>
                </div>
                <div class="stat-item">
                    <h3>15+</h3>
                    <p>Cabang Toko</p>
                </div>
                <div class="stat-item">
                    <h3>4.9★</h3>
                    <p>Kepuasan Pelanggan</p>
                </div>
            </div>
        </section>

        <!-- Kontak -->
        <section class="card">
            <h2>Hubungi Kami</h2>
            <p><strong>Alamat:</strong> Jl. Blossom Fashion No. 88, Jakarta Selatan</p>
            <p><strong>Email:</strong> info@blossomshoes.id</p>
            <p><strong>Telepon / WA:</strong> +62 812-3456-7890</p>
        </section>
    </main>

</body>
</html>