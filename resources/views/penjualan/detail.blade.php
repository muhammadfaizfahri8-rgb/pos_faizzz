@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<!-- Custom Colorful Styling for Sales Detail (Blue Theme) -->
<style>
    .page-wrapper {
        background-color: #eff6ff;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-sales {
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
    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.15);
    }
    .badge-total {
        background-color: #dbeafe;
        color: #1e40af;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .info-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #475569;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }
    .info-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
    }

    /* Style Khusus Tampilan Struk Kasir (Sembunyi di Layar Display) */
    #receipt-print {
        display: none;
    }

    /* Style ketika Tombol Print Ditekan */
    @media print {
        body * {
            visibility: hidden;
        }
        #receipt-print, #receipt-print * {
            visibility: visible;
        }
        #receipt-print {
            display: block !important;
            position: absolute;
            left: 0;
            top: 0;
            width: 80mm; /* Ukuran standar kertas printer kasir thermal */
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            padding: 5px;
        }
        .text-center-print { text-align: center; }
        .text-end-print { text-align: right; }
        .line-print { border-top: 1px dashed #000; margin: 6px 0; }
        .table-print { width: 100%; border-collapse: collapse; }
        .table-print td, .table-print th { font-size: 11px; vertical-align: top; }
        @page { size: auto; margin: 0; }
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner (Tanpa Tombol) -->
        <div class="hero-banner-sales p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-primary px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    🧾 Transaksi POS
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Rincian Penjualan</h1>
                <p class="text-white mb-0 opacity-75">Informasi lengkap transaksi dan daftar item produk yang dibeli.</p>
            </div>
        </div>

        <!-- Informasi Utama Transaksi (Card Ringkasan) -->
        <div class="card custom-card p-4 mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-6 col-md-3">
                    <div class="info-label">Kasir / Petugas</div>
                    <div class="info-value" style="color: #2563eb;">
                        <i class="bi bi-person-circle me-1"></i> {{ $sale->user->name ?? 'Kasir / Terhapus' }}
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="info-label">Tanggal Transaksi</div>
                    <div class="info-value">
                        <i class="bi bi-calendar-event me-1 text-muted"></i> {{ $sale->created_at ? $sale->created_at->translatedFormat('d-m-Y H:i:s') : '-' }}
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="info-label">Metode & Status</div>
                    <div>
                        <span class="badge bg-primary rounded-pill me-1">{{ $sale->metode_pembayaran ?? 'CASH' }}</span>
                        @if(($sale->status ?? '') === 'COMPLETED')
                            <span class="badge bg-success rounded-pill">COMPLETED</span>
                        @else
                            <span class="badge bg-warning text-dark rounded-pill">{{ $sale->status ?? 'PENDING' }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-6 col-md-3 text-md-end">
                    <div class="info-label">Total Pembayaran</div>
                    <div class="mt-1">
                        <span class="badge-total">
                            Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
                            ({{ $sale->metode_pembayaran ?? 'Cash' }})
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Item Produk yang Dibeli -->
        <div class="card custom-card">
            <div class="card-header bg-white border-0 py-3 px-4 fw-bold fs-5" style="color: #1e293b;">
                <i class="bi bi-cart-check me-2" style="color: #2563eb;"></i> Item Produk Terjual
            </div>
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4 py-3">#</th>
                            <th scope="col" class="py-3">Foto</th>
                            <th scope="col" class="py-3">Nama Produk</th>
                            <th scope="col" class="py-3 text-center">Harga Satuan</th>
                            <th scope="col" class="py-3 text-center">Qty</th>
                            <th scope="col" class="py-3 text-end pe-4">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sale->itemPenjualan ?? [] as $index => $item)
                        <tr>
                            <th scope="row" class="ps-4 fw-bold text-muted">{{ $index + 1 }}</th>
                            <td>
                                @if($item->produk && $item->produk->foto)
                                    <img src="{{ asset('storage/' . $item->produk->foto) }}" class="product-img" alt="{{ $item->produk->nama }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center product-img text-muted">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $item->produk->nama ?? 'Produk Dihapus' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="text-muted">Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}</span>
                            </td>
                            <td class="text-center fw-bold">
                                {{ $item->kuantitas ?? 1 }}
                            </td>
                            <td class="text-end pe-4">
                                <span class="fw-semibold" style="color: #1e40af;">Rp {{ number_format($item->subtotal ?? (($item->produk->harga_jual ?? 0) * ($item->kuantitas ?? 1)), 0, ',', '.') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted fs-5"><i class="bi bi-inbox fs-1 d-block mb-2 opacity-50" style="color: #2563eb;"></i> Tidak ada item produk dalam transaksi ini.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Card Footer (Tombol Cetak Struk & Kembali Hanya Ada di Sini) -->
            <div class="card-footer bg-white border-0 py-4 px-4 text-end d-flex justify-content-end gap-2">
                <button onclick="window.print()" class="btn btn-warning rounded-pill px-4 fw-semibold">
                    <i class="bi bi-printer me-1"></i> Cetak Struk
                </button>
                <a href="{{ route('penjualan.index') }}" class="btn rounded-pill px-4 fw-semibold text-white" style="background: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%);">
                    Kembali ke Daftar Penjualan
                </a>
            </div>
        </div>

    </div>
</div>

<!-- ================= STRUK PENJUALAN (KHUSUS UNTUK PRINT) ================= -->
<div id="receipt-print">
    <div class="text-center-print">
        <h3 style="margin: 0; font-size: 16px;">TOKO KAMI</h3>
        <p style="margin: 2px 0;">Jl. Contoh Raya No. 123</p>
        <p style="margin: 2px 0;">Telp: 0812-3456-7890</p>
    </div>
    
    <div class="line-print"></div>
    
    <div>
        <div>No. Trx : #{{ $sale->id ?? '-' }}</div>
        <div>Tgl     : {{ $sale->created_at ? $sale->created_at->format('d/m/Y H:i') : '-' }}</div>
        <div>Kasir   : {{ $sale->user->name ?? '-' }}</div>
        <div>Bayar   : {{ $sale->metode_pembayaran ?? 'Cash' }}</div>
    </div>
    
    <div class="line-print"></div>
    
    <table class="table-print">
        @foreach($sale->itemPenjualan ?? [] as $item)
        <tr>
            <td colspan="3"><strong>{{ $item->produk->nama ?? 'Produk' }}</strong></td>
        </tr>
        <tr>
            <td>{{ $item->kuantitas ?? 1 }} x {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}</td>
            <td class="text-end-print">Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
    
    <div class="line-print"></div>
    
    <table class="table-print">
        <tr>
            <td><strong>TOTAL ({{ $sale->metode_pembayaran ?? 'Cash' }})</strong></td>
            <td class="text-end-print"><strong>Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</strong></td>
        </tr>
    </table>
    
    <div class="line-print"></div>
    
    <div class="text-center-print" style="margin-top: 10px;">
        <p style="margin: 2px 0;">-- Terima Kasih --</p>
        <p style="margin: 2px 0;">Selamat Belanja Kembali</p>
    </div>
</div>

@endsection