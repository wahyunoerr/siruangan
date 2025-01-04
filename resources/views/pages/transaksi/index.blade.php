@extends('layouts.dashboard.app', ['title' => 'Transaksi'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Transaksi</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('dashboard') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('transaksi') }}">Acara</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Transaksi</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Nama User</th>
                                    <th>Nama Acara</th>
                                    <th>Ruangan</th>
                                    <th>Dp</th>
                                    <th>Sisa Pelunasan</th>
                                    <th>Jadwal</th>
                                    <th>Tanggal Booking</th>
                                    <th>Status</th>
                                    <th>Bukti Pelunasan</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $t)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $t->user->name }}</td>
                                        <td>{{ $t->event->name }}</td>
                                        <td>{{ $t->ruangan->nama_ruangan }}</td>
                                        <td>Rp. {{ number_format($t->dp, 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($t->sisaPelunasan, 0, ',', '.') }}</td>
                                        <td>{{ $t->booking->jadwal_day }},{{ $t->booking->jadwal_start_time }} s.d
                                            {{ $t->booking->jadwal_end_time }}</td>
                                        <td> {{ date('d/m/Y', strtotime($t->booking->tanggal_booking)) }}</td>
                                        <td>
                                            @if ($t->status == 'Belum Lunas')
                                                <span class="badge badge-warning">Belum Lunas</span>
                                            @else
                                                <span class="badge badge-success">Sudah Lunas</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$t->buktiPelunasan)
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#uploadModal-{{ $t->id }}"
                                                    data-id="{{ $t->id }}">Upload
                                                    Bukti</button>
                                            @else
                                                <a href="{{ Storage::disk('public')->url($t->buktiPelunasan) }}?image=250"
                                                    data-toggle="lightbox" data-caption="bukti transaksi">
                                                    <img src="{{ Storage::disk('public')->url($t->buktiPelunasan) }}"
                                                        class="img-fluid" width="250">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                @if (!$t->buktiPelunasan)
                                                    <span class="badge badge-danger">Upload Bukti Pelunasan Untuk Cetak
                                                        Invoice</span>
                                                @else
                                                    <a href="{{ route('transaksi.printInvoice', $t->id) }}" target="_blank"
                                                        class="btn btn-primary">Cetak Invoice</a @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @include('pages.transaksi.modal', ['t' => $t])
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Nama User</th>
                                    <th>Nama Acara</th>
                                    <th>Ruangan</th>
                                    <th>Dp</th>
                                    <th>Sisa Pelunasan</th>
                                    <th>Jadwal</th>
                                    <th>Tanggal Booking</th>
                                    <th>Status</th>
                                    <th>Bukti Pelunasan</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
