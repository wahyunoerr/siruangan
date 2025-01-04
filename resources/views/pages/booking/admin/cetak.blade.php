@extends('layouts.dashboard.app', ['title' => 'Cetak Booking'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Cetak Booking</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Data Booking</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama User</th>
                        <th>Event</th>
                        <th>Tanggal Booking</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->event->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d-m-Y') }}</td>
                            <td>{{ ucfirst($booking->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data booking pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
