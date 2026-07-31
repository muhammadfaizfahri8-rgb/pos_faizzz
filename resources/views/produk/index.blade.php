@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')

@include('layouts.navbar')

<!-- Custom Modern Styling for Produk (Bright Blue / Cyan Theme) -->
<style>
    .page-wrapper {
        background-color: #f0f7ff;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-product {
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        border-radius: 20px;
        color: #fff;
        box-shadow: 0 10px 25px rgba(0, 114, 255, 0.25);
    }
    .custom-card {
        border: 1px solid rgba(0, 114, 255, 0.08);
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 114, 255, 0.06);
        background: #ffffff;
        overflow: hidden;
    }
    .search-box {
        background: #fff;
        border-radius: 14px;
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
    }
    .product-img {
        width: 65px;
        height: 65px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(0, 114, 255, 0.15);
    }
    .badge-price-buy {
        background-color: #e0f2fe;
        color: #0369a1;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .badge-price-sell {
        background-color: #dcfce7;
        color: #15803d;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .badge-stock {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #cbd5e1;
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 600;
    }
    .btn-create-product {
        background: #ffffff;
        color: #0072ff;
        font-weight: bold;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .btn-create-product:hover {
        background: #0b2545;
        color: #ffffff;
    }
    .btn-search-custom {
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        border: none;
        color: white;
    }
    .btn-search-custom:hover {
        opacity: 0.9;
        color: white;
    }
    .btn-detail-custom {
        background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
    }
    .btn-edit-custom {
        background: linear-gradient(135deg, #ffe259 0%, #ffa751 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
    }
    .btn-delete-custom {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner Header -->
        <div class="hero-banner-product p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-primary px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    <i class="bi bi-box-seam-fill me-1"></i> Manajemen Inventaris
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Halaman Produk</h1>
                <p class="text-white mb-0 opacity-75">Kelola daftar barang, harga beli, harga jual, dan stok inventaris toko Anda.</p>
            </div>
            <div class="mt-3 mt-md-0">
                @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn btn-create-product btn-lg shadow-sm px-4">
                    <i class="bi bi-plus-circle-fill me-1"></i> Tambah Produk
                </a>
                @endcan
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- ALERT SECTION --}}
        {{-- ========================================== --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4 border-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4 border-0" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- ========================================== --}}

        <!-- Search Bar Card -->
        <div class="card custom-card p-3 mb-4 search-box">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-0 text-primary ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 bg-white py-2 px-2"
                        placeholder="Cari nama produk..."
                    >
                    <button class="btn btn-search-custom px-4 fw-semibold" type="submit">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary px-3">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="card custom-card">
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4 py-3">#</th>
                            <th scope="col" class="py-3">User</th>
                            <th scope="col" class="py-3">Foto</th>
                            <th scope="col" class="py-3">Nama</th>
                            <th scope="col" class="py-3">Harga Beli</th>
                            <th scope="col" class="py-3">Harga Jual</th>
                            <th scope="col" class="py-3">Stok</th>
                            <th scope="col" class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                   <tbody>
    @forelse ($products as $product)
    <tr>
        <th scope="row" class="ps-4 fw-bold text-muted">{{ $products->firstItem() + $loop->index }}</th>
        <td>
            <span class="fw-semibold text-dark"><i class="bi bi-person-circle me-1 text-primary"></i> {{ $product->user->name }}</span>
        </td>
        <td>
            <img src="{{ asset('storage/'.$product->foto) }}" class="product-img" alt="{{ $product->nama }}">
        </td>
        <td>
            <span class="fw-bold text-dark fs-6">{{ $product->nama }}</span>
        </td>
        <td>
            <span class="badge-price-buy">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</span>
        </td>
        <td>
            <span class="badge-price-sell">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
        </td>
        <td>
            <span class="badge-stock">{{ $product->stok }} pcs</span>
        </td>
        <td class="text-center">
            <div class="d-inline-flex gap-1 justify-content-center">
                <a href="{{ route('produk.show', $product) }}" class="btn btn-detail-custom btn-sm px-3">
                    <i class="bi bi-eye me-1"></i> Rincian
                </a>
                
                @can('update', $product)
                <a href="{{ route('produk.edit', $product) }}" class="btn btn-edit-custom btn-sm px-3">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                @endcan
                
                @can('delete', $product)
                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-delete-custom btn-sm px-3" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                        <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                </form>
                @endcan
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="text-center py-5">
            <div class="text-muted fs-5">Data tidak tersedia.</div>
        </td>
    </tr>
    @endforelse
</tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="card-footer bg-white border-0 py-4 px-4">
                <div class="d-flex justify-content-center justify-content-md-end">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection