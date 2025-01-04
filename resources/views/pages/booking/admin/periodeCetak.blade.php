@extends('layouts.dashboard.app', ['title' => 'Cetak Booking'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Cetak Booking</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">List Booking</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Cetak Booking</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pilih Periode Waktu</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.listCetakBooking') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bulan-dari" class="form-label">Dari Bulan</label>
                                    <select id="bulan-dari" name="bulan_dari" class="form-select">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}"
                                                {{ request('bulan_dari') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bulan-ke" class="form-label">Ke Bulan</label>
                                    <select id="bulan-ke" name="bulan_ke" class="form-select">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}"
                                                {{ request('bulan_ke') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tahun-dari" class="form-label">Dari Tahun</label>
                                    <select id="tahun-dari" name="tahun_dari" class="form-select">
                                        <option value="">Pilih Tahun</option>
                                        @for ($year = now()->year; $year >= 2000; $year--)
                                            <option value="{{ $year }}"
                                                {{ request('tahun_dari') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tahun-ke" class="form-label">Ke Tahun</label>
                                    <select id="tahun-ke" name="tahun_ke" class="form-select">
                                        <option value="">Pilih Tahun</option>
                                        @for ($year = now()->year; $year >= 2000; $year--)
                                            <option value="{{ $year }}"
                                                {{ request('tahun_ke') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Tampilkan
                            </button>
                        </div>
                    </form>
                </div>
                @if (isset($bookings) && $bookings->isNotEmpty())
                    <div class="card-body mt-4">
                        <h5>Hasil Cetak Booking:</h5>
                        <p>Periode:
                            {{ $bulanDari ? \Carbon\Carbon::create()->month($bulanDari)->translatedFormat('F') . ' ' . $tahunDari : 'Semua' }}
                            -
                            {{ $bulanKe ? \Carbon\Carbon::create()->month($bulanKe)->translatedFormat('F') . ' ' . $tahunKe : 'Semua' }}
                        </p>
                    </div>
                    @include('pages.booking.admin.tablecetak', ['bookings' => $bookings])
                @else
                    <div class="card-body mt-4">
                        <p>Tidak ada data yang ditemukan untuk periode yang dipilih.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
