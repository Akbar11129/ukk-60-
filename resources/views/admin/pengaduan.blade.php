@extends('admin.layout')

@section('title', 'Kelola Pengaduan')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Pengaduan Siswa</h5>
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
                                        <th>Nama Siswa</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Prioritas</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaduans as $i => $p)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td><strong>{{ $p->siswa->nama ?? 'N/A' }}</strong></td>
                                            <td>{{ $p->judul }}</td>
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
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $p->id }}">Detail</button>
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
                                                                <label class="form-label"><strong>Nama Siswa:</strong></label>
                                                                <p>{{ $p->siswa->nama ?? 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><strong>NIS:</strong></label>
                                                                <p>{{ $p->siswa->nis ?? 'N/A' }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label"><strong>Kategori:</strong></label>
                                                                <p><span class="badge bg-info">{{ $p->kategori }}</span></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label"><strong>Prioritas:</strong></label>
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
                                                            <label class="form-label"><strong>Deskripsi:</strong></label>
                                                            <p>{{ $p->deskripsi }}</p>
                                                        </div>

                                                        <hr>

                                                        <!-- Tanggapan -->
                                                        <h6><strong>Tanggapan:</strong></h6>
                                                        @if ($p->tanggapans->count() > 0)
                                                            @foreach ($p->tanggapans as $t)
                                                                <div class="alert alert-info">
                                                                    <p>{{ $t->isi }}</p>
                                                                    <small class="text-muted">{{ $t->created_at->format('d/m/Y') }}</small>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <p class="text-muted">Belum ada tanggapan</p>
                                                        @endif

                                                        <!-- Form Tanggapan -->
                                                        <div class="mt-3">
                                                            <label class="form-label"><strong>Berikan Tanggapan:</strong></label>
                                                            <form action="{{ route('admin.pengaduan.tanggapan', $p->id) }}" method="POST">
                                                                @csrf
                                                                <textarea class="form-control mb-2" name="isi" rows="3"
                                                                          placeholder="Masukkan tanggapan..." required></textarea>

                                                                <div class="mb-2">
                                                                    <label class="form-label"><strong>Update Status:</strong></label>
                                                                    <select class="form-control" name="status" required>
                                                                        <option value="">-- Pilih Status --</option>
                                                                        <option value="menunggu" {{ $p->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                                        <option value="diproses" {{ $p->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                                        <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                                    </select>
                                                                </div>

                                                                <button type="submit" class="btn btn-success btn-sm">Kirim Tanggapan</button>
                                                            </form>
                                                        </div>
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
                            <p class="mb-0">Belum ada pengaduan dari siswa</p>
                        </div>
                    @endif
                </div>
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

@endsection
