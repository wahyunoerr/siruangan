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
                                    <th>Kop Surat</th>
                                    <th width="50%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->jadwal_day }}, {{ $item->jadwal_start_time }} s.d
                                            {{ $item->jadwal_end_time }}
                                        </td>
                                        <td>{{ $item->event->name }}</td>
                                        <td>{{ $item->ruangan->nama_ruangan }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_booking)) }}</td>
                                        <td>
                                            @if ($item->status == 'menunggu')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif ($item->status == 'tolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @elseif ($item->status == 'setujui' && !$item->buktiTransaksi)
                                                <span class="badge badge-warning">Upload Bukti Transaksi Anda</span>
                                            @elseif ($item->status == 'setujui')
                                                <span class="badge badge-success">Disetujui</span>
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
                                    <th>Kop Surat</th>
                                    <th width="50%">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
