<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Booking</title>
    <style>
        @media print {
            @page {
                margin: 10mm;
            }
            body {
                -webkit-print-color-adjust: exact;
            }
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            width: 30%;
        }
    </style>
</head>
<body>
    <h1>Detail Booking #{{ $booking->id }}</h1>

    <table>
        <tr>
            <th>Kode Booking</th>
            <td>{{ $booking->kode_booking ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama Pemesan</th>
            <td>{{ $booking->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Booking</th>
            <td>{{ $booking->tanggal ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jam Lapangan</th>
            <td>{{ $booking->jam ?? '-' }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp {{ number_format($booking->total_harga ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $booking->status ?? '-' }}</td>
        </tr>
    </table>
    
    <script>
        window.print(); // Otomatis memunculkan dialog print
    </script>
</body>
</html>