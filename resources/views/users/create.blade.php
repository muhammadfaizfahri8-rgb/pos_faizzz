@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

@include('layouts.navbar')

<!-- Custom Modern Styling for Form (Bright Blue / Cyan Theme) -->
<style>
    .page-wrapper {
        background-color: #f0f7ff;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-form {
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
    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #bae6fd;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0072ff;
        box-shadow: 0 0 0 3px rgba(0, 114, 255, 0.15);
        background-color: #ffffff;
    }
    .form-label {
        font-weight: 600;
        color: #0b2545;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .btn-submit-custom {
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        box-shadow: 0 4px 12px rgba(0, 114, 255, 0.3);
        transition: all 0.3s ease;
    }
    .btn-submit-custom:hover {
        opacity: 0.95;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(0, 114, 255, 0.4);
    }
    .btn-back-custom {
        background: #e0f2fe;
        border: none;
        color: #0369a1;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        transition: all 0.3s ease;
    }
    .btn-back-custom:hover {
        background: #bae6fd;
        color: #0c4a6e;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner / Header -->
        <div class="hero-banner-form p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-primary px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    <i class="bi bi-person-plus-fill me-1"></i> Manajemen Akun
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Tambah Akun Baru</h1>
                <p class="text-white mb-0 opacity-75">Silakan lengkapi formulir di bawah ini untuk mendaftarkan user baru.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('admin.users') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm text-primary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card custom-card p-4 p-md-5">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        @include('users._form')

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                            <a href="{{ route('admin.users') }}" class="btn btn-back-custom">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-submit-custom">
                                <i class="bi bi-check-lg me-1"></i> Simpan Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection