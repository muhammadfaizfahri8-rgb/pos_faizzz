@extends('layouts.app')

@section('title', 'POS Kasir')

@section('content')

@include('layouts.navbar')

<!-- Custom Colorful Styling for POS (Blue Theme) -->
<style>
    .page-wrapper {
        background-color: #eff6ff;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-pos {
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
    .product-item-card {
        border: 1px solid #bfdbfe;
        border-radius: 12px;
        transition: all 0.2s ease;
        background: #ffffff;
    }
    .product-item-card:hover {
        border-color: #2563eb;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        transform: translateY(-1px);
    }
    .product-img {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .table-cart thead {
        background: #dbeafe;
        color: #1e40af;
    }
    .table-cart thead th {
        border: none;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .total-display {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1d4ed8;
    }
    .btn-checkout {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.7rem 1.5rem;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        transition: all 0.3s ease;
    }
    .btn-checkout:hover {
        opacity: 0.9;
        color: white;
        transform: translateY(-1px);
    }
    .btn-add-product {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        border: none;
        color: white;
    }
    .btn-add-product:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
        color: white;
    }
    .search-input {
        border-radius: 50px;
        padding: 0.75rem 1.25rem;
        border: 1px solid #bfdbfe;
        background-color: #f8fafc;
    }
    .search-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        background-color: #ffffff;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Notifikasi Error -->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-12 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Hero Banner -->
        <div class="hero-banner-pos p-4 p-md-4 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-primary px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    ⚡ Kasir Point of Sale
                </span>
                <h1 class="h3 fw-bold mb-1 text-white">Transaksi Penjualan Baru</h1>
                <p class="text-white mb-0 opacity-75 small fw-semibold">Pilih produk di sebelah kiri dan kelola keranjang belanja di sebelah kanan.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('penjualan.index') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm text-primary">
                    <i class="bi bi-clock-history me-1"></i> Riwayat Penjualan
                </a>
            </div>
        </div>

        <div class="row g-4">
            
            {{-- ====================== KOLOM 1: DAFTAR PRODUK ============================ --}}
            <div class="col-md-6">
                <div class="card custom-card h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-grid-fill text-primary me-2"></i> Katalog Produk</h5>
                        <!-- Form Pencarian -->
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent search-input border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control search-input border-start-0 ps-0"
                                       placeholder="Cari nama produk..."
                                       onkeyup="this.form.submit()">
                            </div>
                        </form>
                    </div>

                    <div class="card-body px-4 py-3" style="max-height: 60vh; overflow-y: auto;">
                        <div class="d-flex flex-column gap-2">
                            @forelse($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="product-item-card p-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="row align-items-center g-2">
                                    <!-- Detail Produk & Tombol Pilih -->
                                    <div class="col-7">
                                        <div class="d-flex align-items-center gap-2">
                                            @if($product->foto)
                                                <img src="{{ asset('storage/' . $product->foto) }}" class="product-img" alt="Foto">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center product-img text-muted">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold text-dark small">{{ $product->nama }}</div>
                                                <div class="text-primary small fw-semibold">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Input Qty -->
                                    <div class="col-3">
                                        <input type="number" name="quantity" value="1" min="1"
                                               class="form-control form-control-sm text-center {{ isset($sale) && $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                                    </div>

                                    <!-- Tombol Tambah (+) -->
                                    <div class="col-2">
                                        <button class="btn btn-add-product btn-sm w-100 fw-bold {{ isset($sale) && $sale->status === 'COMPLETED' ? 'disabled' : '' }}" title="Tambah ke Keranjang">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @empty
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-box-seam fs-1 d-block mb-2 text-primary"></i>
                                <p class="mb-0">Produk tidak ditemukan.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====================== KOLOM 2: KERANJANG BELANJA =========================== --}}
            <div class="col-md-6">
                <div class="card custom-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-cart3 text-primary me-2"></i> Keranjang Belanja</h5>
                        </div>

                        <div class="card-body px-0 py-3">
                            <div class="table-responsive" style="max-height: 42vh; overflow-y: auto;">
                                <table class="table table-cart align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Produk</th>
                                            <th>Harga</th>
                                            <th style="width: 90px;">Qty</th>
                                            <th>Subtotal</th>
                                            <th class="text-end pe-4">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sale->itemPenjualan ?? [] as $item)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="fw-semibold text-dark small">{{ $item->produk->nama ?? '-' }}</span>
                                            </td>
                                            <td class="small text-muted">Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                                    @csrf @method('PUT')
                                                    <input type="number" name="quantity"
                                                           value="{{ $item->kuantitas }}"
                                                           class="form-control form-control-sm text-center"
                                                           onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="fw-semibold text-primary small">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                            <td class="text-end pe-4">
                                                @can('delete', $item)
                                                <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm border-0" title="Hapus Item">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="bi bi-cart-x fs-2 d-block mb-2 text-primary opacity-50"></i>
                                                Keranjang belanja masih kosong
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Footer / Checkout -->
                    <div class="card-footer bg-light border-0 p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted fw-semibold">Total Pembayaran:</span>
                            <span class="total-display">Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</span>
                        </div>

                        <!-- Form Checkout -->
                        @if(isset($sale))
                        <form method="POST" 
                              action="{{ route('penjualan.update', $sale->id) }}"
                              onsubmit="return validasiCheckout()">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <select name="payment_method" id="payment_method" class="form-select rounded-pill px-3 py-2 bg-white" required onchange="toggleCashInput()">
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="CASH">Cash (Tunai)</option>
                                    <option value="QRIS">QRIS / Non-Tunai</option>
                                </select>
                            </div>

                            <!-- Section Uang Dibayar & Kembalian (Muncul jika pilih CASH) -->
                            <div id="cash-section" class="mb-3 p-3 bg-white rounded-3 border shadow-sm" style="display: none;">
                                <div class="mb-2">
                                    <label for="paid_amount" class="form-label small fw-bold text-muted mb-1">Uang Dibayar (Rp)</label>
                                    <input type="number" 
                                           id="paid_amount" 
                                           name="paid_amount" 
                                           class="form-control rounded-pill px-3" 
                                           placeholder="Masukkan nominal uang..."
                                           oninput="hitungKembalian()">
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                                    <span class="small fw-semibold text-muted">Kembalian:</span>
                                    <span id="change-amount" class="fw-bold text-dark fs-6">Rp 0</span>
                                </div>
                            </div>

                            <button class="btn btn-checkout w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                <i class="bi bi-check-circle-fill me-1"></i> Selesaikan Checkout
                            </button>
                        </form>

                        <!-- Tombol Batal Transaksi -->
                        @can('delete', $sale)
                        <form action="{{ route('penjualan.destroy', $sale->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')"
                              class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger w-100 rounded-pill py-2 small fw-semibold">
                                <i class="bi bi-x-circle me-1"></i> Batalkan Transaksi
                            </button>
                        </form>
                        @endcan
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script Logika Cash & Perhitungan Kembalian -->
<script>
    const totalPembayaran = {{ $sale->total_pembayaran ?? 0 }};

    function toggleCashInput() {
        const method = document.getElementById('payment_method').value;
        const cashSection = document.getElementById('cash-section');
        const paidInput = document.getElementById('paid_amount');

        if (method === 'CASH') {
            cashSection.style.display = 'block';
            paidInput.setAttribute('required', 'required');
            paidInput.focus();
        } else {
            cashSection.style.display = 'none';
            paidInput.removeAttribute('required');
            paidInput.value = '';
            hitungKembalian();
        }
    }

    function hitungKembalian() {
        const paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;
        const changeElement = document.getElementById('change-amount');
        const kembalian = paidAmount - totalPembayaran;

        if (paidAmount === 0) {
            changeElement.innerText = 'Rp 0';
            changeElement.className = 'fw-bold text-dark fs-6';
        } else if (kembalian >= 0) {
            changeElement.innerText = 'Rp ' + kembalian.toLocaleString('id-ID');
            changeElement.className = 'fw-bold text-success fs-6';
        } else {
            changeElement.innerText = 'Kurang Rp ' + Math.abs(kembalian).toLocaleString('id-ID');
            changeElement.className = 'fw-bold text-danger fs-6';
        }
    }

    function validasiCheckout() {
        const method = document.getElementById('payment_method').value;
        const paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;

        if (method === 'CASH' && paidAmount < totalPembayaran) {
            alert('Uang pembayaran masih kurang!');
            return false;
        }

        return confirm('Yakin ingin memproses checkout transaksi ini?');
    }
</script>

@endsection