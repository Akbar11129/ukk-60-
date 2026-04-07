@extends('siswa.layout')

@section('title', 'Riwayat Pengaduan')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Pengaduan Saya</h5>
                    <a href="{{ route('siswa.pengaduan') }}" class="btn btn-light btn-sm">+ Buat Pengaduan</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

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
                                                @if ($p->status == 'Proses')
                                                    <span class="badge bg-primary">{{ $p->status }}</span>
                                                @elseif ($p->status == 'Selesai')
                                                    <span class="badge bg-success">{{ $p->status }}</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $p->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $p->id }}">Lihat</button>
                                            </td>
                                        </tr>

                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $p->judul }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label><strong>Kategori:</strong></label>
                                                                <p><span class="badge bg-info">{{ $p->kategori }}</span></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><strong>Prioritas:</strong></label>
                                                                <p>
                                                                    @if ($p->prioritas == 'Tinggi')
                                                                        <span class="badge bg-danger">{{ $p->prioritas }}</span>
                                                                    @elseif ($p->prioritas == 'Sedang')
                                                                        <span class="badge bg-warning">{{ $p->prioritas }}</span>
                                                                    @else
                                                                        <span class="badge bg-success">{{ $p->prioritas }}</span>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label><strong>Status:</strong></label>
                                                            <p>
                                                                @if ($p->status == 'diproses')
                                                                    <span class="badge bg-primary">Diproses</span>
                                                                @elseif ($p->status == 'selesai')
                                                                    <span class="badge bg-success">Selesai</span>
                                                                @else
                                                                    <span class="badge bg-secondary">Menunggu</span>
                                                                @endif
                                                            </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label><strong>Deskripsi:</strong></label>
                                                            <p>{{ $p->deskripsi }}</p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label><strong>Foto Lampiran:</strong></label>
                                                            @if ($p->foto)
                                                                <div>
                                                                    <img src="{{ asset('storage/' . $p->foto) }}" alt="Foto" style="max-width: 300px; border-radius: 5px;">
                                                                </div>
                                                            @else
                                                                <p class="text-muted">Tidak ada foto lampiran</p>
                                                            @endif
                                                        </div>

                                                        <hr>

                                                        <h6><strong>Tanggapan dari Admin:</strong></h6>
                                                        @if ($p->tanggapans->count() > 0)
                                                            @foreach ($p->tanggapans as $t)
                                                                <div class="alert alert-info">
                                                                    <p>{{ $t->isi }}</p>
                                                                    <small class="text-muted">{{ $t->created_at->format('d/m/Y') }}</small>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <p class="text-muted">Belum ada tanggapan dari admin</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
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

<style>
    .container-fluid {
        background: white;
        padding: 20px;
        border-radius: 8px;
    }
    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .table th {
        font-weight: 600;
    }
    .btn {
        border-radius: 5px;
    }
</style>

<script>
    function setModalImage(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
    }
</script>

@endsection
