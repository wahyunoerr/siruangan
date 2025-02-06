@extends('layouts.dashboard.app', ['title' => 'Booking Costumer'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Pengajuan Booking Anda</h3>
        <ul class="breadcrumbs mb-3">
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jadwal</th>
                                    <th>Nama Acara</th>
                                    <th>Nama Ruangan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Bukti Transaksi</th>
                                    <th>Surat Izin Penyewaan</th>
                                    <th>Keterangan</th>
                                    <th width="50%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->jadwal_start_time }} s.d {{ $item->jadwal_end_time }}</td>
                                        <td>{{ $item->event->name }}</td>
                                        <td>{{ $item->ruangan->nama_ruangan }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_booking)) }}</td>
                                        <td>
                                            @if ($item->status == 'menunggu')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif ($item->status == 'tolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @elseif ($item->status == 'setujui')
                                                @if (!$item->buktiTransaksi)
                                                    <span class="badge badge-warning">
                                                        <div id="countdown-{{ $item->id }}"></div>
                                                    </span>
                                                @else
                                                    <span class="badge badge-success">Disetujui</span>
                                                @endif
                                            @endif
                                        </td>
                                        @if ($item->buktiTransaksi)
                                            <td>
                                                <a href="{{ $item->buktiTransaksi }}" data-bs-toggle="lightbox">
                                                    <img src="{{ Storage::disk('public')->url($item->buktiTransaksi) }}"
                                                        width="100px">
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                <p>Tidak ada</p>
                                            </td>
                                        @endif
                                        @if ($item->uploadKopSurat)
                                            <td>
                                                <a href="{{ $item->uploadKopSurat }}">Lihat file
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                <p>Tidak ada</p>
                                            </td>
                                        @endif
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            @if ($item->status == 'setujui' && !$item->buktiTransaksi)
                                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#uploadModal{{ $item->id }}">
                                                    Upload Bukti
                                                </button>
                                            @elseif ($item->status == 'setujui' && $item->buktiTransaksi)
                                                <a href="{{ route('transaksi.printUserInvoice', ['id' => $item->id]) }}"
                                                    target="_blank" class="btn btn-primary">Invoice</a>
                                            @else
                                                <p>Sedang Dalam Proses</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('pages.booking.costumer.modal', ['item' => $item])
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Jadwal</th>
                                    <th>Nama Acara</th>
                                    <th>Nama Ruangan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Bukti Transaksi</th>
                                    <th>Surat Izin Penyewaan</th>
                                    <th>Keterangan</th>
                                    <th width="50%">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        @foreach ($booking as $item)
            @if ($item->status == 'setujui' && !$item->buktiTransaksi)
                var countDownDate{{ $item->id }} = new Date(
                    "{{ \Carbon\Carbon::parse($item->updated_at)->addDay()->format('M d, Y H:i:s') }}").getTime();
                var x{{ $item->id }} = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countDownDate{{ $item->id }} - now;
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById("countdown-{{ $item->id }}").innerHTML =
                        "Lakukan pembayaran sebelum: " + hours + "h " + minutes + "m " +
                        seconds + "s ";
                    if (distance < 0) {
                        clearInterval(x{{ $item->id }});
                        document.getElementById("countdown-{{ $item->id }}").innerHTML = "Waktu anda habis";
                    }
                }, 1000);
            @endif
        @endforeach
    </script>
@endsection
