<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $transaksi->event->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 150px;
        }

        .header h1 {
            font-size: 24px;
            margin-top: 10px;
        }

        .footer p {
            font-size: 12px;
            color: #888;
        }

        .details {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .details h2 {
            margin-bottom: 20px;
            font-size: 20px;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details table th,
        .details table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .details table th {
            background-color: #f4f4f4;
        }

        .total {
            margin-top: 30px;
            text-align: right;
            font-size: 18px;
        }

        .total span {
            font-weight: bold;
        }

        .note {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .print-btn {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 30px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .print-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <h1>Invoice #{{ $transaksi->id }}</h1>
        </div>

        <div class="details">
            <h2>Invoice Details</h2>
            <table>
                <tr>
                    <th>Nama User</th>
                    <td>{{ $transaksi->user->name }}</td>
                </tr>
                <tr>
                    <th>Nama Acara</th>
                    <td>{{ $transaksi->event->name }}</td>
                </tr>
                <tr>
                    <th>Ruangan</th>
                    <td>{{ $transaksi->ruangan->nama_ruangan }}</td>
                </tr>
                <tr>
                    <th>Jadwal</th>
                    <td>{{ $transaksi->jadwal->day }} - {{ $transaksi->jadwal->waktuMulai }} s.d
                        {{ $transaksi->jadwal->waktuSelesai }}</td>
                </tr>
                <tr>
                    <th>Tanggal Booking</th>
                    <td>{{ date('d/m/Y', strtotime($transaksi->booking->tanggal_booking)) }}</td>
                </tr>
                <tr>
                    <th>DP</th>
                    <td>Rp. {{ number_format($transaksi->dp, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Sisa Pelunasan</th>
                    <td>Rp. {{ number_format($transaksi->sisaPelunasan, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="total">
            <p>Total: <span>Rp. {{ number_format($transaksi->event->harga, 0, ',', '.') }}</span></p>
        </div>

        <div class="note">
            <p>Terima kasih telah melakukan transaksi dengan kami. Jika Anda membutuhkan bantuan lebih lanjut, jangan
                ragu untuk menghubungi kami.</p>
        </div>

        <button class="print-btn" onclick="window.print()">Print Invoice</button>
    </div>
</body>

</html>
