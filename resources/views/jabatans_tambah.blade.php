@extends('template')

@section('content')
<div class="container mt-4">
    <h2>Form Tambah Jabatan</h2>
    <hr>

    <a href="/jabatans" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card shadow-sm p-4">
        <form action="/jabatans/tambah" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label"><strong>Nama Jabatan:</strong></label>
                <select name="nama_jabatan" class="form-select @error('nama_jabatan') is-invalid @enderror" required>
                    <option value="">-- Pilih Jabatan --</option>
                    <option value="Admin" {{ old('nama_jabatan') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Kasir" {{ old('nama_jabatan') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                    <option value="Pelanggan" {{ old('nama_jabatan') == 'Pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                </select>
                
                @error('nama_jabatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Deskripsi:</strong></label>
                <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi') }}" placeholder="Deskripsi jabatan...">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection