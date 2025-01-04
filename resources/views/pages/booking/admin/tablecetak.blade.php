@extends('layouts.dashboard.app', ['title' => 'Table Boking'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List Data Booking</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-3">
                        <button onclick="printTable()" class="btn btn-success">
                            <i class="fas fa-print"></i> Cetak
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="booking-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama User</th>
                                    <th>Event</th>
                                    <th>Harga</th>
                                    <th>Tanggal Booking</th>
                                    <th>Bukti Transaksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->event->name }}</td>
                                        <td>Rp. {{ number_format($booking->event->harga, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d-m-Y') }}</td>
                                        <td><a href="{{ $booking->buktiTransaksi }}" data-bs-toggle="lightbox"><img
                                                    src="{{ Storage::disk('public')->url($booking->buktiTransaksi) }}"
                                                    alt="" width="100px"></a></td>
                                        <td>{{ ucfirst($booking->status) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data booking pada periode ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function printTable() {
        var printContents = document.getElementById('booking-table').outerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
