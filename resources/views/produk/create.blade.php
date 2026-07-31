@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<!-- Custom Colorful Styling for Form (Blue Theme) -->
<style>
    .page-wrapper {
        background-color: #f0f7ff;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-form {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
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
    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #bfdbfe;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        background-color: #ffffff;
    }
    .form-label {
        font-weight: 600;
        color: #1e3a8a;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .btn-submit-custom {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        transition: all 0.3s ease;
    }
    .btn-submit-custom:hover {
        opacity: 0.9;
        color: white;
        transform: translateY(-1px);
    }
    .btn-back-custom {
        background: #dbeafe;
        border: none;
        color: #1e40af;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        transition: all 0.3s ease;
    }
    .btn-back-custom:hover {
        background: #bfdbfe;
        color: #1e3a8a;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner / Header -->
        <div class="hero-banner-form p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-primary px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    📦 Manajemen Produk
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Tambah Produk Baru</h1>
                <p class="text-white mb-0 opacity-75">Silakan lengkapi formulir di bawah ini untuk menambahkan produk ke inventaris.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('produk.index') }}" class="btn btn-light text-primary rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card custom-card p-4 p-md-5">
                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        @include('produk._form')

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                            <a href="{{ route('produk.index') }}" class="btn btn-back-custom">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-submit-custom">
                                <i class="bi bi-check-lg me-1"></i> Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection