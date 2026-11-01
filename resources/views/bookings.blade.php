@extends('template')

@section('content')
<div class="container mt-4">
    <h2>Data Pemesanan (Booking)</h2>
    <hr>

    <!-- Tombol Navigasi & Aksi Atas -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="/home" class="btn btn-secondary">Kembali ke Home</a>
        <a href="/bookings/export-excel" class="btn btn-success">Export Semua Data ke Excel</a>
    </div>

    <!-- Form Tambah Booking (Opsional jika ingin ditaruh langsung di halaman ini) -->
    <div class="card shadow-sm p-4 mb-4">
        <h5 class="mb-3">Tambah Booking Baru</h5>
        <form action="/bookings/tambah" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Pilih User:</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $u) <option value="{{ $u->id }}">{{ $u->nama }}</option> @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Pilih Lapangan:</label>
                    <select name="field_id" class="form-select" required>
                        <option value="">-- Pilih Lapangan --</option>
                        @foreach($fields as $f) 
                        <option value="{{ $f->id }}">{{ $f->nama_lapangan }}

        
                        </option> @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tanggal Main:</label>
                    <input type="date" name="tgl_main" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Jam Mulai:</label>
                    <input type="text" name="jam_mulai" class="form-control" placeholder="19:00:00" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Jam Selesai:</label>
                    <input type="text" name="jam_selesai" class="form-control" placeholder="21:00:00" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Durasi (Jam):</label>
                    <input type="number" name="durasi_jam" class="form-control" placeholder="Durasi" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Total Harga:</label>
                    <input type="number" name="total_harga" class="form-control" placeholder="Total Harga" required>
                </div>
                <div class="col-md-3 d-flex align-items-end mb-3">
                    <button type="submit" class="btn btn-primary w-100">Tambah Booking</button>
                </div>
            </div>
        </form>
    </div>

   
    <div class="card shadow-sm p-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Pemesan</th>
                        <th>Lapangan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{ $d->kode_booking }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->nama_lapangan }}</td>
                        <td>{{ $d->tgl_main }}</td>
                        <td>{{ $d->jam_mulai }} - {{ $d->jam_selesai }}</td>
                        <td>Rp {{ number_format($d->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $d->status }}</span>
                        </td>
                        <td>
                            <a href="/bookings/cetak-window/{{ $d->id }}" target="_blank" class="btn btn-sm btn-info text-white">Print Nota</a>
                            <a href="/bookings/export-pdf/{{ $d->id }}" target="_blank" class="btn btn-sm btn-warning text-white">PDF</a>
                            <a href="/bookings/export-excel" class="btn btn-sm btn-success text-white">Excel</a>
                            <a href="/bookings/hapus/{{ $d->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection