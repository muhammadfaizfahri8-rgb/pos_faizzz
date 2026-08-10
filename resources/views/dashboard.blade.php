<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Ringkasan Hari Ini')

<!-- batas awal isi konten -->
@section('content')

@include('layouts.navbar')

<!-- Google Fonts & Bootstrap Icons Import -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f4f8fa;
    }
    
    .page-wrapper {
        min-height: 100vh;
        padding: 2.5rem 0 4rem 0;
    }

    /* Header Banner */
    .dashboard-header {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border-radius: 24px;
        color: #fff;
        padding: 3rem 2rem;
        box-shadow: 0 20px 30px -10px rgba(2, 132, 199, 0.3);
        margin-bottom: 2.5rem;
        position: relative;
        overflow: hidden;
    }
    
    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        pointer-events: none;
    }

    /* Section Title Styling */
    .section-title {
        font-weight: 800;
        color: #0f172a;
        font-size: 1.35rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Custom Modern Cards */
    .custom-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        background: #ffffff;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }

    .custom-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
    }

    /* Stat Cards Specific */
    .stat-card {
        position: relative;
        padding: 1.75rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        flex-shrink: 0;
    }

    .stat-label {
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-weight: 800;
        font-size: 1.85rem;
        color: #0f172a;
        line-height: 1.2;
    }

    /* Card Headers for Tables */
    .card-header-custom {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Table Styles */
    .table-custom {
        margin-bottom: 0;
    }

    .table-custom thead th {
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        color: #475569;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.75px;
        padding: 0.85rem 1.25rem;
    }

    .table-custom tbody td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 0.925rem;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    /* Custom Badges */
    .badge-pill-custom {
        padding: 0.4rem 0.85rem;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .badge-warning-soft {
        background-color: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .badge-danger-soft {
        background-color: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .badge-primary-soft {
        background-color: #f0f9ff;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }

    /* Pagination Overlay Fix */
    .card-footer {
        background: transparent;
        border-top: 1px solid #f1f5f9;
        padding: 1rem 1.5rem;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Header Banner -->
        <div class="dashboard-header text-center text-md-start d-md-flex align-items-center justify-content-between">
            <div>
                <h1 class="display-6 fw-bold mb-2">Ringkasan Hari Ini</h1>
                <p class="text-white-50 fs-6 mb-0">
                    <i class="bi bi-calendar-event me-2"></i>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div class="mt-3 mt-md-0">
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-semibold shadow-sm">
                    <i class="bi bi-clock-history me-1"></i> Update Real-time
                </span>
            </div>
        </div>

        @can('__viewAny', App\Models\User::class)
        <!-- Today's Sales Section -->
        <div class="mb-5">
            <h2 class="section-title">
                <i class="bi bi-graph-up-arrow text-primary"></i> Penjualan Hari Ini
            </h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="stat-card">
                            <div>
                                <div class="stat-label">Total Nilai Penjualan</div>
                                <div class="stat-value text-primary">Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}</div>
                            </div>
                            <div class="stat-icon-wrapper bg-primary-subtle text-primary">
                                <i class="bi bi-wallet2"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="stat-card">
                            <div>
                                <div class="stat-label">Jumlah Transaksi</div>
                                <div class="stat-value text-info">{{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }} <span class="fs-6 fw-semibold text-muted">Penjualan</span></div>
                            </div>
                            <div class="stat-icon-wrapper bg-info-subtle text-info">
                                <i class="bi bi-receipt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cash & Payment Status Section -->
        <div class="mb-5">
            <h2 class="section-title">
                <i class="bi bi-credit-card text-primary"></i> Tunai dan Status Pembayaran
            </h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="stat-card">
                            <div>
                                <div class="stat-label">Total Pembayaran Tunai</div>
                                <div class="stat-value text-success">Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</div>
                            </div>
                            <div class="stat-icon-wrapper bg-success-subtle text-success">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card">
                        <div class="stat-card">
                            <div>
                                <div class="stat-label">Total Pembayaran Non-Tunai</div>
                                <div class="stat-value text-purple" style="color: #6366f1;">Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}</div>
                            </div>
                            <div class="stat-icon-wrapper text-indigo" style="background-color: #e0e7ff; color: #4f46e5;">
                                <i class="bi bi-qr-code-scan"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        <!-- Critical Inventory Status Section -->
        <div class="mb-5">
            <h2 class="section-title">
                <i class="bi bi-box-seam text-primary"></i> Status Persediaan Kritis
            </h2>
            <div class="row g-4">
                <!-- Produk Stok Rendah -->
                <div class="col-lg-6">
                    <div class="card custom-card">
                        <div class="card-header-custom">
                            <h3 class="card-header-title text-warning">
                                <i class="bi bi-exclamation-triangle-fill"></i> Stok Menipis
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom align-middle">
                                    <thead>
                                        <tr>
                                            <th class="ps-4" style="width: 10%;">#</th>
                                            <th>Nama Produk</th>
                                            <th class="text-end pe-4">Stok Sisa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produkStokRendah as $index => $produk)
                                        <tr>
                                            <td class="ps-4 fw-semibold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                            <td class="fw-bold">{{ $produk->nama }}</td>
                                            <td class="text-end pe-4">
                                                <span class="badge-pill-custom badge-warning-soft">
                                                    <i class="bi bi-dot"></i> {{ $produk->stok }} pcs
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">
                                                <i class="bi bi-check-circle text-success fs-3 d-block mb-1"></i>
                                                Semua stok produk dalam batas aman.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($produkStokRendah->hasPages())
                        <div class="card-footer">
                            {{ $produkStokRendah->links() }}
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Produk Habis Stok -->
                <div class="col-lg-6">
                    <div class="card custom-card">
                        <div class="card-header-custom">
                            <h3 class="card-header-title text-danger">
                                <i class="bi bi-x-circle-fill"></i> Stok Habis
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom align-middle">
                                    <thead>
                                        <tr>
                                            <th class="ps-4" style="width: 10%;">#</th>
                                            <th>Nama Produk</th>
                                            <th class="text-end pe-4">Stok Sisa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produkStokHabis as $index => $produk)
                                        <tr>
                                            <td class="ps-4 fw-semibold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                            <td class="fw-bold">{{ $produk->nama }}</td>
                                            <td class="text-end pe-4">
                                                <span class="badge-pill-custom badge-danger-soft">
                                                    <i class="bi bi-x-lg"></i> {{ $produk->stok }} pcs
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">
                                                <i class="bi bi-check-circle text-success fs-3 d-block mb-1"></i>
                                                Tidak ada produk yang kehabisan stok.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($produkStokHabis->hasPages())
                        <div class="card-footer">
                            {{ $produkStokHabis->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Best Seller Products Section -->
        <div class="mb-4">
            <h2 class="section-title">
                <i class="bi bi-fire text-primary"></i> Barang Paling Laris
            </h2>
            <div class="card custom-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom align-middle">
                            <thead>
                                <tr>
                                    <th class="ps-4">Nama Produk</th>
                                    <th>Stok Tersisa</th>
                                    <th class="text-end pe-4">Total Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $produk)
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">{{ $produk->nama }}</td>
                                    <td>
                                        <span class="text-muted fw-semibold">{{ $produk->stok }} pcs</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <span class="badge-pill-custom badge-primary-soft">
                                            <i class="bi bi-bag-check-fill"></i> {{ $produk->total_terjual }} Terjual
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-3 d-block mb-1 text-secondary"></i>
                                        Belum ada data penjualan produk hari ini.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- batas Akhir isi konten -->
@endsection