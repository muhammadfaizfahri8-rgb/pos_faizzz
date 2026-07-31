<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Ringkasan Hari Ini')

<!-- batas awal isi konten -->
@section('content')

@include('layouts.navbar')

<!-- Custom Modern Styling for Dashboard (Bright Blue / Cyan Theme) -->
<style>
    .page-wrapper {
        background-color: #f0f7ff;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .dashboard-header {
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        border-radius: 20px;
        color: #fff;
        padding: 2.5rem;
        box-shadow: 0 10px 25px rgba(0, 114, 255, 0.25);
        margin-bottom: 2.5rem;
    }
    .section-title {
        font-weight: 800;
        color: #0b2545;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }
    .section-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 4px;
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        border-radius: 2px;
    }
    .custom-card {
        border: 1px solid rgba(0, 114, 255, 0.08);
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 114, 255, 0.06);
        background: #ffffff;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 114, 255, 0.12);
    }
    .card-header-custom {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        border-bottom: 1px solid rgba(0, 114, 255, 0.1);
        font-weight: 600;
        color: #0369a1;
        padding: 1.2rem;
    }
    .stat-value {
        font-weight: 800;
        font-size: 1.75rem;
        color: #0284c7;
    }
    .table-custom thead {
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        color: white;
    }
    .table-custom thead th {
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 1rem;
    }
    .badge-stock-low {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: #fff;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
    }
    .badge-stock-empty {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: #fff;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
    }
    .badge-best-seller {
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        color: #fff;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Header Banner -->
        <div class="dashboard-header text-center">
            <h1 class="display-5 fw-bold mb-2">Ringkasan Hari Ini</h1>
            <p class="text-white-50 fs-5 mb-0">
                <i class="bi bi-calendar-check me-2"></i>({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
            </p>
        </div>

        @can('__viewAny', App\Models\User::class)
        <!-- Today's Sales Section -->
        <div class="mb-5">
            <h2 class="section-title">Penjualan hari ini</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card custom-card text-center h-100">
                        <div class="card-header card-header-custom">
                            <h5 class="mb-0 fw-bold" style="color: #0369a1;"><i class="bi bi-wallet2 me-2"></i> Total Nilai Penjualan Hari Ini</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center py-4">
                            <div class="stat-value">Rp. {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card text-center h-100">
                        <div class="card-header card-header-custom">
                            <h5 class="mb-0 fw-bold" style="color: #0369a1;"><i class="bi bi-receipt me-2"></i> Jumlah Penjualan Hari Ini</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center py-4">
                            <div class="stat-value">{{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }} Penjualan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cash & Payment Status Section -->
        <div class="mb-5">
            <h2 class="section-title">Tunai dan status pembayaran</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card custom-card text-center h-100">
                        <div class="card-header card-header-custom">
                            <h5 class="mb-0 fw-bold" style="color: #0369a1;"><i class="bi bi-cash-stack me-2"></i> Total Pembayaran Tunai</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center py-4">
                            <div class="stat-value">Rp. {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card text-center h-100">
                        <div class="card-header card-header-custom">
                            <h5 class="mb-0 fw-bold" style="color: #0369a1;"><i class="bi bi-credit-card-2-front me-2"></i> Total Pembayaran Non-Tunai</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center py-4">
                            <div class="stat-value">Rp. {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        <!-- Critical Inventory Status Section -->
        <div class="mb-5">
            <h2 class="section-title">Status persediaan kritis</h2>
            <div class="row g-4">
                <!-- Produk Stok Rendah -->
                <div class="col-md-6">
                    <div class="card custom-card h-100">
                        <div class="card-header card-header-custom">
                            <h4 class="mb-0 fw-bold" style="color: #d97706;"><i class="bi bi-exclamation-triangle me-2"></i> Daftar Produk Stok Rendah</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="ps-4">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col" class="text-center">Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produkStokRendah as $index => $produk)
                                        <tr>
                                            <td class="ps-4 fw-bold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                            <td class="fw-bold text-dark">{{ $produk->nama }}</td>
                                            <td class="text-center">
                                                <span class="badge-stock-low">{{ $produk->stok }} pcs</span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                Seluruh produk berada dalam kondisi stok aman.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 py-3">
                            {{ $produkStokRendah->links() }}
                        </div>
                    </div>
                </div>

                <!-- Produk Habis Stok -->
                <div class="col-md-6">
                    <div class="card custom-card h-100">
                        <div class="card-header card-header-custom">
                            <h4 class="mb-0 fw-bold" style="color: #dc2626;"><i class="bi bi-x-circle me-2"></i> Produk Habis Stok</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="ps-4">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col" class="text-center">Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produkStokHabis as $index => $produk)
                                        <tr>
                                            <td class="ps-4 fw-bold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                            <td class="fw-bold text-dark">{{ $produk->nama }}</td>
                                            <td class="text-center">
                                                <span class="badge-stock-empty">{{ $produk->stok }} pcs</span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                Seluruh produk berada dalam kondisi stok aman.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 py-3">
                            {{ $produkStokHabis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Best Seller Products Section -->
        <div class="mb-4">
            <h2 class="section-title">Barang paling laris</h2>
            <div class="card custom-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-4">Nama Produk</th>
                                    <th scope="col">Stok Tersisa</th>
                                    <th scope="col" class="text-center">Unit Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $produk)
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">{{ $produk->nama }}</td>
                                    <td>{{ $produk->stok }} pcs</td>
                                    <td class="text-center">
                                        <span class="badge-best-seller">{{ $produk->total_terjual }} terjual</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-4">
                                        Belum ada data penjualan produk.
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