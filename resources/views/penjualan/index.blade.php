@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<!-- Font & Icons Import -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Latar belakang dinamis & menyala dengan animasi gradien bergerak */
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(-45deg, #0284c7, #38bdf8, #6366f1, #06b6d4, #0f172a);
        background-size: 400% 400%;
        animation: vibrantGradient 12s ease infinite;
        min-height: 100vh;
    }

    @keyframes vibrantGradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    .page-wrapper {
        min-height: 100vh;
        padding: 2.5rem 0 4rem 0;
    }

    /* Hero Banner Header - Glassmorphic / Menyala */
    .hero-banner-sale {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 24px;
        color: #fff;
        padding: 2.5rem 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        position: relative;
        overflow: hidden;
    }

    .hero-banner-sale::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        pointer-events: none;
        filter: blur(30px);
    }

    /* Card Container dengan efek Glassmorphism */
    .custom-card {
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(12px);
        overflow: hidden;
    }

    /* Search Box Input */
    .search-box-input {
        border: 1px solid #cbd5e1;
        border-radius: 12px 0 0 12px;
        padding: 0.75rem 1.25rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .search-box-input:focus {
        border-color: #0284c7;
        box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.15);
        background-color: #fff;
    }

    .btn-search-custom {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border: none;
        color: white;
        border-radius: 0 12px 12px 0;
        padding: 0 1.5rem;
        font-weight: 600;
        transition: opacity 0.2s ease;
    }

    .btn-search-custom:hover {
        opacity: 0.92;
        color: white;
    }

    /* Primary Create Button */
    .btn-create-sale {
        background: #ffffff;
        color: #0284c7;
        font-weight: 700;
        border-radius: 50px;
        padding: 0.65rem 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-create-sale:hover {
        background: #0f172a;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Total Payment Badge */
    .badge-total-bayar {
        background-color: #f0fdf4;
        color: #15803d;
        padding: 0.45rem 0.85rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.875rem;
        border: 1px solid #bbf7d0;
        display: inline-block;
    }

    /* Payment Method Badges */
    .badge-payment {
        padding: 0.35rem 0.75rem;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.75rem;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .badge-payment-cash {
        background-color: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }

    .badge-payment-noncash {
        background-color: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }

    /* Status Badges */
    .badge-status-completed {
        background-color: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .badge-status-pending {
        background-color: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .badge-status-cancelled {
        background-color: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    /* Action Buttons (Icon-Only Minimalist) */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
    }

    .btn-detail-soft {
        background-color: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }

    .btn-detail-soft:hover {
        background-color: #16a34a;
        color: white;
        border-color: #16a34a;
        transform: translateY(-2px);
    }

    .btn-edit-soft {
        background-color: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .btn-edit-soft:hover {
        background-color: #f59e0b;
        color: white;
        border-color: #f59e0b;
        transform: translateY(-2px);
    }

    .btn-delete-soft {
        background-color: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .btn-delete-soft:hover {
        background-color: #ef4444;
        color: white;
        border-color: #ef4444;
        transform: translateY(-2px);
    }

    /* Table Styles */
    .table-custom {
        margin-bottom: 0;
    }

    .table-custom thead th {
        background-color: rgba(248, 250, 252, 0.85);
        border-bottom: 1px solid #e2e8f0;
        color: #475569;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.75px;
        padding: 1rem 1.25rem;
    }

    .table-custom tbody td {
        padding: 1.1rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 0.925rem;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    .table-custom tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background-color: rgba(241, 245, 249, 0.6);
    }

    /* Card Footer Pagination */
    .card-footer-custom {
        background: transparent;
        border-top: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem;
    }
</style>

<div class="page-wrapper">
    <div class="container">

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4 border-0 rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Notifikasi Error -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4 border-0 rounded-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i> {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Hero Banner Header -->
        <div class="hero-banner-sale mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <span class="badge bg-white text-primary px-3 py-1.5 rounded-pill fw-bold mb-2 shadow-sm fs-7">
                    <i class="bi bi-receipt-cutoff me-1"></i> Laporan Transaksi
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Riwayat Penjualan</h1>
                <p class="text-white mb-0 opacity-90">Pantau dan kelola seluruh transaksi kasir harian secara terstruktur</p>
            </div>
            <div>
                <a href="{{ route('penjualan.create') }}" class="btn btn-create-sale shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle-fill fs-5"></i>
                    <span>Transaksi Baru</span>
                </a>
            </div>
        </div>

        <!-- Search Bar Card -->
        <div class="card custom-card p-3 mb-4">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control bg-light border-start-0 search-box-input"
                        placeholder="Cari transaksi berdasarkan nama kasir atau ID..."
                    >
                    <button class="btn btn-search-custom d-flex align-items-center gap-2" type="submit">
                        <span>Cari</span>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary px-3 ms-2 rounded-3 d-flex align-items-center gap-1">
                            <i class="bi bi-x-circle"></i> Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="card custom-card">
            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4" style="width: 5%;">#</th>
                            <th scope="col" style="width: 22%;">Tanggal & Waktu</th>
                            <th scope="col" style="width: 20%;">Kasir / Petugas</th>
                            <th scope="col" style="width: 18%;">Total Pembayaran</th>
                            <th scope="col" style="width: 15%;">Metode Pembayaran</th>
                            <th scope="col" style="width: 10%;">Status</th>
                            <th scope="col" class="text-end pe-4" style="width: 10%;">Aksi</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <td class="ps-4 fw-semibold text-muted">{{ $sales->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar-event text-primary fs-6"></i>
                                    <span class="fw-medium text-dark">
                                        {{ $sale->created_at ? $sale->created_at->translatedFormat('d M Y, H:i') : '-' }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark d-flex align-items-center gap-1.5">
                                    <i class="bi bi-person-badge text-secondary"></i>
                                    {{ $sale->user->name ?? 'Sistem / Terhapus' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-total-bayar">
                                    Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                @php $isCash = ($sale->metode_pembayaran ?? 'CASH') === 'CASH'; @endphp
                                <span class="badge-payment {{ $isCash ? 'badge-payment-cash' : 'badge-payment-noncash' }}">
                                    <i class="bi {{ $isCash ? 'bi-cash-stack' : 'bi-credit-card-2-front' }}"></i>
                                    {{ $sale->metode_pembayaran ?? 'CASH' }}
                                </span>
                            </td>
                            <td>
                                @if(($sale->status ?? '') === 'COMPLETED')
                                    <span class="badge badge-payment badge-status-completed">
                                        <i class="bi bi-check-circle-fill"></i> Selesai
                                    </span>
                                @elseif(($sale->status ?? '') === 'PENDING')
                                    <span class="badge badge-payment badge-status-pending">
                                        <i class="bi bi-clock-history"></i> Pending
                                    </span>
                                @else
                                    <span class="badge badge-payment badge-status-cancelled">
                                        <i class="bi bi-x-circle-fill"></i> {{ $sale->status ?? 'Batal' }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-1.5 align-items-center">
                                    <!-- Tombol Detail (Selalu Tampil) -->
                                    <a href="{{ route('penjualan.show', $sale) }}" 
                                       class="btn-action btn-detail-soft" 
                                       data-bs-toggle="tooltip" 
                                       title="Lihat Rincian Transaksi">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    <!-- Tombol Edit & Hapus (Status BUKAN COMPLETED) -->
                                    @if(($sale->status ?? '') !== 'COMPLETED')
                                        <a href="{{ route('penjualan.edit', $sale) }}" 
                                           class="btn-action btn-edit-soft" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit Transaksi">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn-action btn-delete-soft" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')"
                                                    data-bs-toggle="tooltip" 
                                                    title="Hapus Transaksi">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <div class="py-3">
                                    <i class="bi bi-receipt fs-1 text-secondary opacity-50 d-block mb-2"></i>
                                    <p class="fw-semibold mb-1">Riwayat penjualan tidak ditemukan</p>
                                    <small class="text-muted">Coba ubah kata kunci pencarian atau buat transaksi baru.</small>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            @if($sales->hasPages())
            <div class="card-footer-custom">
                <div class="d-flex justify-content-center justify-content-md-end">
                    {{ $sales->withQueryString()->links() }}
                </div>
            </div>
            @endif
        </div>

    </div>
</div>

@endsection