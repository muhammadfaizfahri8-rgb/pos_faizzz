@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')

@include('layouts.navbar')

<!-- Custom Modern Styling for Users Management (Bright Blue / Cyan Theme) -->
<style>
    .page-wrapper {
        background-color: #f0f7ff;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner {
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
        background: #ffffff;
        border-radius: 16px;
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
    .avatar-initial {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
        color: white;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 114, 255, 0.25);
    }
    .badge-role {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        color: #0369a1;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
        border: 1px solid rgba(0, 114, 255, 0.15);
    }
    .btn-create {
        background: #ffffff;
        color: #0072ff;
        font-weight: bold;
        border-radius: 50px;
        transition: all 0.3s ease;
        border: none;
    }
    .btn-create:hover {
        background: #0b2545;
        color: #ffffff;
        transform: translateY(-2px);
    }
    .btn-edit-custom {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 20px;
        padding: 5px 15px;
        box-shadow: 0 3px 8px rgba(217, 119, 6, 0.3);
    }
    .btn-edit-custom:hover {
        color: #fff;
        box-shadow: 0 5px 12px rgba(217, 119, 6, 0.4);
    }
    .btn-delete-custom {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 20px;
        padding: 5px 15px;
        box-shadow: 0 3px 8px rgba(220, 38, 38, 0.3);
    }
    .btn-delete-custom:hover {
        color: #fff;
        box-shadow: 0 5px 12px rgba(220, 38, 38, 0.4);
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner Cyan/Blue Theme -->
        <div class="hero-banner p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-primary px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    <i class="bi bi-people-fill me-1"></i> Manajemen Pengguna
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Halaman Akun</h1>
                <p class="text-white mb-0 opacity-75">Kelola daftar pengguna, administrator, dan hak akses sistem</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('admin.users.create') }}" class="btn btn-create btn-lg shadow-sm px-4">
                    + Tambah Akun
                </a>
            </div>
        </div>

        <!-- Search Bar Card -->
        <div class="card custom-card p-3 mb-4 search-box">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="input-group">
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 bg-light py-2 px-3"
                        placeholder="Cari nama atau email akun..."
                    >
                    <button class="btn btn-primary px-4 fw-semibold" type="submit" style="background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%); border: none;">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary px-3">
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
                            <th scope="col" class="py-3">Nama</th>
                            <th scope="col" class="py-3">Email</th>
                            <th scope="col" class="py-3">Role</th>
                            <th scope="col" class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">{{ $users->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-initial me-3">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-bold text-dark">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $user->email }}</span>
                            </td>
                            <td>
                                <span class="badge-role">
                                    {{ $user->role->name ?? 'No Role' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-edit-custom btn-sm">
                                        Edit Akun
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete-custom btn-sm" onclick="return confirm('Yakin hapus user ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Tidak ada data pengguna ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="card-footer bg-white border-0 py-4 px-4">
                <div class="d-flex justify-content-center justify-content-md-end">
                    {{ $users->withQueryString()->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection