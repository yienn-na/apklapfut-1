<!DOCTYPE html>
<html>
<head>
    <title>Nota Booking - {{ $booking->kode_booking }}</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .invoice-box { max-width: 600px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0, 0, 0, .15); }
        h2 { text-align: center; color: #333; }
        table { width: 100%; line-height: inherit; text-align: left; border-collapse: collapse; }
        table td { padding: 8px; vertical-align: top; }
        .total { font-weight: bold; background: #eee; }
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box">
        <h2>NOTA PEMESANAN LAPANGAN FUTSAL</h2>
        <hr>
        <table>
            <tr>
                <td><strong>Kode Booking:</strong></td>
                <td>{{ $booking->kode_booking }}</td>
            </tr>
            <tr>
                <td><strong>Nama Pemesan:</strong></td>
                <td>{{ $booking->nama }}</td>
            </tr>
            <tr>
                <td><strong>Lapangan:</strong></td>
                <td>{{ $booking->nama_lapangan }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Main:</strong></td>
                <td>{{ $booking->tgl_main }}</td>
            </tr>
            <tr>
                <td><strong>Jam:</strong></td>
                <td>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
            </tr>
            <tr class="total">
                <td><strong>Total Harga:</strong></td>
                <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
</body>
</html>