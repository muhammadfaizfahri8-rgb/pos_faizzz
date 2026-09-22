@extends('layouts.app')

@section('title', 'Tentang Kami - ShoePulse POS')

@section('content')

@include('layouts.navbar')

<style>
    /* CSS Kustom Perlengkap Visual */
    .about-wrapper {
        padding: 2rem 0 4rem 0;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.6) !important;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 50px rgba(0, 0, 0, 0.12);
        background: rgba(255, 255, 255, 0.95) !important;
    }

    .header-box {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 24px;
        padding: 3rem 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: #ffffff;
        box-shadow: 0 10px 20px rgba(58, 123, 213, 0.3);
        margin-bottom: 1.5rem;
    }

    .badge-pill {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        display: inline-block;
        margin-bottom: 1rem;
    }
</style>

<div class="container about-wrapper">
    {{-- Header Banner --}}
    <div class="header-box text-center text-white mb-5">
        <span class="badge-pill">SHOEPULSE POS v1.0</span>
        <h1 class="display-4 fw-bold mb-3">Tentang Sistem Kami</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 650px;">
            Solusi kasir pintar dan manajemen inventoris berbasis cloud yang dirancang khusus untuk meningkatkan efisiensi toko sepatu modern.
        </p>
    </div>

    {{-- Deskripsi Utama --}}
    <div class="row g-4 mb-5">
        <div class="col-lg-10 mx-auto">
            <div class="glass-card p-4 p-md-5 text-center">
                <h2 class="fw-bold text-dark mb-3">Mendukung Operasional Toko Sepatu Anda</h2>
                <p class="text-secondary fs-6 mb-0" style="line-height: 1.8;">
                    <strong>ShoePulse POS</strong> mempermudah pengelolaan seluruh aktivitas bisnis dalam satu platform terpadu.
                    Mulai dari pencatatan stok ukuran dan varian warna, pengelolaan produk sneakers hingga sepatu formal, hingga pemantauan riwayat penjualan harian secara otomatis dan real-time.
                </p>
            </div>
        </div>
    </div>

    {{-- Kartu Fitur Unggulan --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="glass-card p-4 h-100 text-center">
                <div class="icon-wrapper">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <h4 class="fw-bold text-dark h5 mb-2">Manajemen Ukuran & Stok</h4>
                <p class="text-muted small mb-0">Pantau ketersediaan berbagai nomor ukuran, varian warna, hingga koleksi edisi terbatas secara otomatis.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card p-4 h-100 text-center">
                <div class="icon-wrapper">
                    <i class="bi bi-lightning-charge-fill"></i>
                </div>
                <h4 class="fw-bold text-dark h5 mb-2">Kasir Cepat</h4>
                <p class="text-muted small mb-0">Antarmuka kasir yang responsif dan efisien untuk melayani transaksi dalam hitungan detik.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card p-4 h-100 text-center">
                <div class="icon-wrapper">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <h4 class="fw-bold text-dark h5 mb-2">Laporan Akurat</h4>
                <p class="text-muted small mb-0">Sajikan data penjualan harian, tren produk terlaris, dan analisis bisnis secara transparan dan terstruktur.</p>
            </div>
        </div>
    </div>
</div>
@endsection