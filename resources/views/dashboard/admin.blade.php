@extends('admin.layout')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h3>Dashboard Admin</h3>
            <p class="text-muted">Kelola aplikasi APSA School</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row my-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Siswa</p>
                            <h4>{{ $totalSiswa ?? 0 }}</h4>
                        </div>
                        <div style="font-size: 32px; color: #007bff;">👥</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Pengaduan</p>
                            <h4>{{ $totalPengaduan ?? 0 }}</h4>
                        </div>
                        <div style="font-size: 32px; color: #6c757d;">📋</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Pengaduan Menunggu</p>
                            <h4>{{ $menunggu ?? 0 }}</h4>
                        </div>
                        <div style="font-size: 32px; color: #ffc107;">⏳</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Pengaduan Selesai</p>
                            <h4>{{ $selesai ?? 0 }}</h4>
                        </div>
                        <div style="font-size: 32px; color: #28a745;">✓</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Akses Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('admin.siswa') }}" class="btn btn-outline-primary w-100">
                                Kelola Siswa
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.pengaduan') }}" class="btn btn-outline-primary w-100">
                                Kelola Pengaduan
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('siswa.create') }}" class="btn btn-outline-success w-100">
                                Tambah Siswa
                            </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Complaints -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pengaduan Terbaru</h5>
                    <a href="{{ route('admin.pengaduan') }}" class="btn btn-light btn-sm">Lihat Semua</a>
                </div>
                <div class="card-body">
                    @if ($pengaduans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Foto</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaduans as $p)
                                        <tr>
                                            <td>{{ $p->siswa->nama ?? 'N/A' }}</td>
                                            <td>{{ $p->judul }}</td>
                                            <td><span class="badge bg-info">{{ $p->kategori }}</span></td>
                                            <td>
                                                @if ($p->foto)
                                                    <img src="{{ asset('storage/' . $p->foto) }}" alt="Foto" class="img-thumbnail" style="max-width: 80px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#fotoModal" onclick="setModalImage('{{ asset('storage/' . $p->foto) }}')">
                                                @else
                                                    <span class="badge bg-secondary">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($p->status == 'diproses')
                                                    <span class="badge bg-primary">Diproses</span>
                                                @elseif ($p->status == 'selesai')
                                                    <span class="badge bg-success">Selesai</span>
                                                @else
                                                    <span class="badge bg-secondary">Menunggu</span>
                                                @endif
                                            </td>
                                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center mb-0">
                            Belum ada pengaduan
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menampilkan foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fotoModalLabel">Foto Pengaduan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Foto" style="max-width: 100%;">
            </div>
        </div>
    </div>
</div>

<script>
    function setModalImage(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
    }
</script>

<style>
    .container-fluid {
        background: white;
        padding: 20px;
        border-radius: 8px;
    }

    .stat-card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 8px;
        transition: transform 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    .stat-card h4 {
        color: #333;
        margin: 0;
    }

    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 8px;
    }

    .table th {
        font-weight: 600;
    }

    .btn {
        border-radius: 5px;
    }

    h3 {
        color: #333;
        font-weight: 600;
    }
</style>

@endsection
