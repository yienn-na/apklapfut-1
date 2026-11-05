<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $booking->kode_booking }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; }
        .container { padding: 20px; }
        h2 { text-align: center; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 10px; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <div class="container">
        <h2>INVOICE PEMESANAN LAPANGAN FUTSAL</h2>
        <hr>
        <table>
            <tr>
                <th>Kode Booking</th>
                <td>{{ $booking->kode_booking }}</td>
            </tr>
            <tr>
                <th>Nama Pemesan</th>
                <td>{{ $booking->nama }}</td>
            </tr>
            <tr>
                <th>Lapangan</th>
                <td>{{ $booking->nama_lapangan }}</td>
            </tr>
            <tr>
                <th>Tanggal Main</th>
                <td>{{ $booking->tgl_main }}</td>
            </tr>
            <tr>
                <th>Jam Main</th>
                <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ strtoupper($booking->status) }}</td>
            </tr>
        </table>
    </div>
</body>
</html>