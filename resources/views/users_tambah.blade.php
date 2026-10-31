@extends('template')

@section('content')
<div class="container mt-4">
    <h2>Form Tambah User</h2>
    <hr>

    <a href="/users" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card shadow-sm p-4">
        <!-- 1 Form utuh untuk semua input termasuk file foto -->
        <form action="/users/tambah" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Jabatan:</label>
                <select name="id_jabatan" class="form-select" required>
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach($jabatans as $j) 
                        <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option> 
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap:</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP:</label>
                <input type="text" name="no_hp" class="form-control" placeholder="No HP" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Profil:</label>
                <input type="file" name="foto" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan User</button>
        </form>
    </div>
</div>
@endsection