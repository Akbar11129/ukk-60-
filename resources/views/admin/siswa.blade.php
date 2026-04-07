@extends('admin.layout')

@section('content')

<h3>Data Siswa</h3>

<!-- tombol tambah siswa -->
<a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3">
Tambah Siswa
</a>

<!-- tabel data siswa -->
<table class="table table-bordered">
<tr>
<th>No</th>
<th>Nama</th>
<th>NIS</th>
<th>Kelas</th>
<th>Password</th>
</tr>

@foreach($siswa as $no => $data)
<tr>
<td>{{ $no + 1 }}</td>
<td>{{ $data['nama'] }}</td>
<td>{{ $data['nis'] }}</td>
<td>{{ $data['kelas'] }}</td>
<td>{{ $data['password'] }}</td>
</tr>
@endforeach

</table>

@endsection
