@extends('admin.layout')

@section('title', 'Data Siswa')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Siswa</h5>
                    <a href="{{ route('siswa.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Tambah Siswa
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($siswas->count() > 0)
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswas as $no => $siswa)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->kelas }}</td>
                                    <td>
                                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            Belum ada data siswa. <a href="{{ route('siswa.create') }}">Tambah siswa baru</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
