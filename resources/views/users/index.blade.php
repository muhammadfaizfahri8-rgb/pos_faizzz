@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')

@include('layouts.navbar')

<!-- Font & Icons Import -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Latar belakang dinamis & dinamis dengan animasi gradien berganti warna */
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

    /* Hero Banner Styling - Glassmorphism Modern */
    .hero-banner {
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

    .hero-banner::before {
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

    /* Custom Modern Card dengan Backdrop Blur Lembut */
    .custom-card {
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(12px);
        overflow: hidden;
    }

    /* Search Input Styling */
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

    .btn-search {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        border: none;
        color: white;
        border-radius: 0 12px 12px 0;
        padding: 0 1.5rem;
        font-weight: 600;
        transition: opacity 0.2s ease;
    }

    .btn-search:hover {
        opacity: 0.92;
        color: white;
    }

    /* Button Create */
    .btn-create {
        background: #ffffff;
        color: #0284c7;
        font-weight: 700;
        border-radius: 50px;
        padding: 0.65rem 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-create:hover {
        background: #0f172a;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
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

    /* Avatar Initial */
    .avatar-initial {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        color: #0284c7;
        font-weight: 800;
        font-size: 1rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(2, 132, 199, 0.15);
    }

    /* Role Badges */
    .badge-role {
        background-color: #f0f9ff;
        color: #0369a1;
        padding: 0.4rem 0.85rem;
        border-radius: 50rem;
        font-weight: 600;
        font-size: 0.8rem;
        border: 1px solid #bae6fd;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    /* Custom Action Buttons */
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

    /* Card Footer Pagination */
    .card-footer-custom {
        background: transparent;
        border-top: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner -->
        <div class="hero-banner mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <span class="badge bg-white text-primary px-3 py-1.5 rounded-pill fw-bold mb-2 shadow-sm fs-7">
                    <i class="bi bi-shield-check me-1"></i> Admin Panel
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Manajemen Akun</h1>
                <p class="text-white mb-0 opacity-90">Kelola data pengguna, hak akses, dan kredensial sistem dalam satu tempat</p>
            </div>
            <div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-create shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="bi bi-person-plus-fill fs-5"></i>
                    <span>Tambah Akun Baru</span>
                </a>
            </div>
        </div>

        <!-- Search Bar Card -->
        <div class="card custom-card p-3 mb-4">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control bg-light border-start-0 search-box-input"
                        placeholder="Cari berdasarkan nama atau email akun..."
                    >
                    <button class="btn btn-search d-flex align-items-center gap-2" type="submit">
                        <span>Cari</span>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary px-3 ms-2 rounded-3 d-flex align-items-center gap-1">
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
                            <th scope="col" style="width: 35%;">Pengguna</th>
                            <th scope="col" style="width: 30%;">Email</th>
                            <th scope="col" style="width: 15%;">Role / Peran</th>
                            <th scope="col" class="text-end pe-4" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 fw-semibold text-muted">{{ $users->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-initial">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-0">{{ $user->name }}</div>
                                        <small class="text-muted d-md-none">{{ $user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary fw-medium">{{ $user->email }}</span>
                            </td>
                            <td>
                                <span class="badge-role">
                                    <i class="bi bi-person-badge"></i>
                                    {{ $user->role->name ?? 'Tidak Ada Role' }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                       class="btn-action btn-edit-soft" 
                                       data-bs-toggle="tooltip" 
                                       data-bs-placement="top" 
                                       title="Edit Akun">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    <!-- Delete Button Form -->
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-action btn-delete-soft" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')"
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                title="Hapus Akun">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="py-3">
                                    <i class="bi bi-person-x fs-1 text-secondary opacity-50 d-block mb-2"></i>
                                    <p class="fw-semibold mb-1">Tidak ada data pengguna ditemukan</p>
                                    <small class="text-muted">Coba kata kunci pencarian lain atau tambahkan akun baru.</small>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            @if($users->hasPages())
            <div class="card-footer-custom">
                <div class="d-flex justify-content-center justify-content-md-end">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
            @endif
        </div>

    </div>
</div>

@endsection