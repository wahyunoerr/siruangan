@extends('layouts.dashboard.app', ['title' => 'List Booking'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Booking</h3>
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
                <a href="{{ route('acara.index') }}">List Booking</a>
            </li>
        </ul>
    </div>

    @hasrole('Administrator|Perlengkapan')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Booking</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th>Nama User</th>
                                        <th>Nama Event</th>
                                        @role('Perlengkapan')
                                            <th>Kop Surat</th>
                                        @endrole
                                        @role('Administrator')
                                            <th>Harga</th>
                                            <th>Jadwal</th>
                                            <th>Ruangan</th>
                                            <th>Bukti Transfer</th>
                                            <th>Tanggal Booking</th>
                                        @endrole
                                        <th>Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $booking)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $booking->user->name }}</td>
                                            <td>{{ $booking->event->name }}</td>

                                            @role('Perlengkapan')
                                                @if (in_array($booking->event->name, ['Tahfiz Quran', 'Seminar', 'Perpisahan Sekolah']))
                                                    <td>
                                                        @if ($booking->uploadKopSurat)
                                                            <a href="{{ Storage::disk('public')->url($booking->uploadKopSurat) }}"
                                                                target="_blank">Lihat Kop Surat</a>
                                                        @else
                                                            <span class="text-muted">Tidak Ada</span>
                                                        @endif
                                                    </td>
                                                @endif
                                            @endrole

                                            @role('Administrator')
                                                <td>Rp. {{ number_format($booking->event->harga, 0, ',', '.') }}</td>
                                                <td>{{ $booking->jadwal->day }}, {{ $booking->jadwal->waktuMulai }} sd
                                                    {{ $booking->jadwal->waktuSelesai }}</td>
                                                <td>{{ $booking->ruangan->nama_ruangan }}</td>
                                                @if ($booking->buktiTransaksi)
                                                    <td><a href="{{ $booking->buktiTransaksi }}" data-bs-toggle="lightbox"><img
                                                                src="{{ Storage::disk('public')->url($booking->buktiTransaksi) }}"
                                                                alt="" width="100px"></a></td>
                                                @else
                                                    <td>Tidak ada</td>
                                                @endif
                                                <td>{{ date('d/m/Y', strtotime($booking->tanggal_booking)) }}</td>
                                            @endrole

                                            <td>
                                                @if ($booking->status == 'setujui')
                                                    <span class="badge badge-success">Disetujui</span>
                                                @elseif ($booking->status == 'tolak')
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @else
                                                    <span class="badge badge-warning">Menunggu</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->hasRole('Perlengkapan') && $booking->uploadKopSurat)
                                                    <div class="form-button-action float-end">
                                                        <div class="btn-group dropend">
                                                            <button type="button"
                                                                class="btn btn-secondary btn-round dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Ubah Status
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <form
                                                                        action="{{ route('dataBooking.status', $booking->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="setujui">
                                                                        <button type="submit"
                                                                            class="dropdown-item">Setujui</button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <div class="dropdown-divider"></div>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('dataBooking.status', $booking->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="tolak">
                                                                        <button type="submit"
                                                                            class="dropdown-item">Tolak</button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <div class="dropdown-divider"></div>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('dataBooking.status', $booking->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="menunggu">
                                                                        <button type="submit"
                                                                            class="dropdown-item">Menunggu</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @elseif (Auth::user()->hasRole('Administrator'))
                                                    @if (!$booking->uploadKopSurat)
                                                        <div class="btn-group dropend">
                                                            <button type="button"
                                                                class="btn btn-secondary btn-round dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Status
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <button type="button" class="dropdown-item"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#dpModal{{ $booking->id }}">
                                                                        Setujui
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <div class="dropdown-divider"></div>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('dataBooking.status', $booking->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="tolak">
                                                                        <button type="submit"
                                                                            class="dropdown-item">Tolak</button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <div class="dropdown-divider"></div>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('dataBooking.status', $booking->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="menunggu">
                                                                        <button type="submit"
                                                                            class="dropdown-item">Menunggu</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @elseif ($booking->uploadKopSurat && $booking->status == 'menunggu')
                                                        <span class="badge badge-warning">Menunggu Persetujuan
                                                            Perlengkapan</span>
                                                    @elseif ($booking->uploadKopSurat && !$booking->buktiTransaksi)
                                                        <span class="badge badge-warning">Menunggu Upload Bukti</span>
                                                    @elseif ($booking->uploadKopSurat && $booking->status == 'setujui')
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#dpModal{{ $booking->id }}">
                                                            Setujui
                                                        </button>
                                                    @else
                                                        <span class="badge badge-danger">Perlengkapan Tidak Setuju</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Tidak ada data untuk ditampilkan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th>Nama User</th>
                                        <th>Nama Event</th>
                                        @role('Perlengkapan')
                                            <th>Kop Surat</th>
                                        @endrole
                                        @role('Administrator')
                                            <th>Harga</th>
                                            <th>Jadwal</th>
                                            <th>Ruangan</th>
                                            <th>Bukti Transfer</th>
                                            <th>Tanggal Booking</th>
                                        @endrole
                                        <th>Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endrole
@endsection

@include('pages.booking.admin.modal')
