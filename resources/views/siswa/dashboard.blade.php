@extends('siswa.layout')

@section('title', '')

@section('content')

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Selamat datang di Dashboard Siswa</h3>
            <p class="text-muted">Kelola pengaduan Anda dengan mudah</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Total Pengaduan</p>
                            <h4>{{ $totalPengaduan ?? 0 }}</h4>
                        </div>
                        <div class="stat-icon" style="font-size: 32px; color: #007bff;">📋</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Menunggu</p>
                            <h4>{{ $menunggu ?? 0 }}</h4>
                        </div>
                        <div class="stat-icon" style="font-size: 32px; color: #6c757d;">⏳</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Diproses</p>
                            <h4>{{ $diproses ?? 0 }}</h4>
                        </div>
                        <div class="stat-icon" style="font-size: 32px; color: #ffc107;">⚙️</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Selesai</p>
                            <h4>{{ $selesai ?? 0 }}</h4>
                        </div>
                        <div class="stat-icon" style="font-size: 32px; color: #28a745;">✓</div>
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
                    <h5 class="mb-0">Pengaduan Terakhir</h5>
                    <a href="{{ route('siswa.pengaduan') }}" class="btn btn-light btn-sm">+ Buat Pengaduan</a>
                </div>
                <div class="card-body">
                    @if ($pengaduans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Prioritas</th>
                                        <th>Foto</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaduans as $i => $p)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td><strong>{{ $p->judul }}</strong></td>
                                            <td>
                                                <span class="badge bg-info">{{ $p->kategori }}</span>
                                            </td>
                                            <td>
                                                @if ($p->prioritas == 'Tinggi')
                                                    <span class="badge bg-danger">{{ $p->prioritas }}</span>
                                                @elseif ($p->prioritas == 'Sedang')
                                                    <span class="badge bg-warning">{{ $p->prioritas }}</span>
                                                @else
                                                    <span class="badge bg-success">{{ $p->prioritas }}</span>
                                                @endif
                                            </td>
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
                                            <td>
                                                <a href="#" class="btn btn-sm btn-info">Lihat</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('siswa.riwayat') }}" class="btn btn-sm btn-outline-primary">
                                Lihat Semua Pengaduan →
                            </a>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <p class="mb-0">Anda belum membuat pengaduan. <a href="{{ route('siswa.pengaduan') }}">Buat pengaduan sekarang</a></p>
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
