@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<!-- Custom Colorful Styling for Penjualan (Blue Theme) -->
<style>
    .page-wrapper {
        background-color: #eff6ff;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-sale {
        background: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%);
        border-radius: 16px;
        color: #fff;
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.25);
    }
    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.08);
        background: #ffffff;
        overflow: hidden;
    }
    .search-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.05);
    }
    .table-custom thead {
        background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%);
        color: white;
    }
    .table-custom thead th {
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }
    .badge-total-bayar {
        background-color: #dbeafe;
        color: #1e40af;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
    }
    .btn-create-sale {
        background: #ffffff;
        color: #1d4ed8;
        font-weight: bold;
        border-radius: 50px;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-create-sale:hover {
        background: #1e3a8a;
        color: #ffffff;
    }
    .btn-detail-custom {
        background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
    }
    .btn-edit-custom {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
    }
    .btn-delete-custom {
        background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
    }
</style>

<div class="page-wrapper">
    <div class="container">

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="alert alert-success shadow-sm rounded-4 border-0 mb-4 alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Notifikasi Error -->
        @if($errors->any())
            <div class="alert alert-danger shadow-sm rounded-4 border-0 mb-4 alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Hero Banner Colorful -->
        <div class="hero-banner-sale p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-primary px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    💎 Laporan Transaksi
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Halaman Penjualan</h1>
                <p class="text-white mb-0 fw-semibold opacity-75">Kelola dan pantau seluruh transaksi penjualan harian dengan mudah.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('penjualan.create') }}" class="btn btn-create-sale btn-lg shadow-sm px-4">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Penjualan
                </a>
            </div>
        </div>

        <!-- Search Bar Card -->
        <div class="card custom-card p-3 mb-4 search-box">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-0 text-primary ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 bg-white py-2 px-2"
                        placeholder="Cari transaksi berdasarkan nama kasir / ID..."
                    >
                    <button class="btn btn-primary px-4 fw-semibold" type="submit" style="background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); border: none;">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary px-3 d-flex align-items-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Card Colorful -->
        <div class="card custom-card">
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4 py-3">#</th>
                            <th scope="col" class="py-3">Tanggal Transaksi</th>
                            <th scope="col" class="py-3">Kasir</th>
                            <th scope="col" class="py-3">Total Pembayaran</th>
                            <th scope="col" class="py-3">Metode Pembayaran</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3 text-center">Aksi</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <th scope="row" class="ps-4 fw-bold text-muted">{{ $sales->firstItem() + $loop->index }}</th>
                            <td>
                                <span class="fw-semibold text-dark"><i class="bi bi-calendar-event me-1 text-primary"></i> {{ $sale->created_at ? $sale->created_at->translatedFormat('d-m-Y H:i:s') : '-' }}</span>
                            </td>
                            <td>
                                <span class="fw-bold text-dark"><i class="bi bi-person-badge me-1 text-info"></i> {{ $sale->user->name ?? 'Sistem / Terhapus' }}</span>
                            </td>
                            <td>
                                <span class="badge-total-bayar">Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2 fw-semibold {{ ($sale->metode_pembayaran ?? 'CASH') === 'CASH' ? 'bg-success' : 'bg-primary' }}">
                                    {{ $sale->metode_pembayaran ?? 'CASH' }}
                                </span>
                            </td>
                            <td>
                                @if(($sale->status ?? '') === 'COMPLETED')
                                    <span class="badge bg-success rounded-pill px-3 py-2 fw-semibold">COMPLETED</span>
                                @elseif(($sale->status ?? '') === 'PENDING')
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-semibold">PENDING</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3 py-2 fw-semibold">{{ $sale->status ?? 'CANCELLED' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1 align-items-center justify-content-center">
                                    <!-- Tombol Detail (Selalu Tampil) -->
                                    <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-detail-custom btn-sm px-3" title="Detail">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                    
                                    <!-- Tombol Edit & Hapus Hanya Tampil Jika Status BUKAN COMPLETED -->
                                    @if(($sale->status ?? '') !== 'COMPLETED')
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-edit-custom btn-sm px-3" title="Edit">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </a>
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete-custom btn-sm px-3" onclick="return confirm('Apakah Anda yakin ingin menghapus data penjualan ini?')">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted fs-5"><i class="bi bi-inbox fs-1 d-block mb-2 text-primary opacity-50"></i> Data Penjualan Tidak Ditemukan</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            @if($sales->hasPages())
            <div class="card-footer bg-white border-0 py-4 px-4">
                <div class="d-flex justify-content-center justify-content-md-end">
                    {{ $sales->withQueryString()->links() }}
                </div>
            </div>
            @endif
        </div>

    </div>
</div>

@endsection