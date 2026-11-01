@extends('template')

@section('content')
<div class="container mt-4">
    <h2>Data Users</h2>
    <hr>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="/home" class="btn btn-secondary">Kembali ke Home</a>
        <a href="/users/tambah-form" class="btn btn-primary">+ Tambah User</a>
    </div>

    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Jabatan</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->id }}</td>
                        <td>
                          @if(!empty($d->img))
        <img src="{{ asset('img/' . $d->img) }}" width="50" alt="Foto" class="rounded">
    @else
        <span class="badge bg-secondary">Tidak ada</span>
    @endif
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $d->nama_jabatan }}</span>
                        </td>
                        <td><strong>{{ $d->nama }}</strong></td>
                        <td>{{ $d->email }}</td>
                        <td>{{ $d->no_hp }}</td>
                        <td>
                            <a href="/users/hapus/{{ $d->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">Hapus</a>
                            <a href="/users/edit/{{ $d->id }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection