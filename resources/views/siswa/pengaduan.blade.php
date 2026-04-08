@extends('siswa.layout')

@section('title', 'Form Pengaduan')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Buat Pengaduan Baru</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Validasi Gagal!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('siswa.pengaduan.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Pengaduan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                   id="judul" name="judul" placeholder="Masukkan judul pengaduan"
                                   value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Pengaduan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="5"
                                      placeholder="Jelaskan detail pengaduan Anda"
                                      required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control @error('kategori') is-invalid @enderror"
                                    id="kategori" name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @forelse ($kategoris as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}" {{ old('kategori') == $kategori->nama_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @empty
                                    <option value="">Tidak ada kategori tersedia</option>
                                @endforelse
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prioritas" class="form-label">Prioritas <span class="text-danger">*</span></label>
                            <select class="form-control @error('prioritas') is-invalid @enderror"
                                    id="prioritas" name="prioritas" required>
                                <option value="">-- Pilih Prioritas --</option>
                                <option value="Rendah" {{ old('prioritas') == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="Sedang" {{ old('prioritas') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                            @error('prioritas')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Lampiran</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                   id="foto" name="foto" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF (Maksimal 10MB)</small>
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 d-grid gap-2 d-md-flex">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-paper-plane"></i> Kirim Pengaduan
                            </button>
                            <a href="{{ route('siswa.riwayat') }}" class="btn btn-secondary btn-lg">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
    .btn {
        padding: 8px 15px;
        border-radius: 5px;
    }
    .text-danger {
        color: #dc3545;
    }
</style>

<script>
    // Bootstrap form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            let forms = document.querySelectorAll('form');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

@endsection
