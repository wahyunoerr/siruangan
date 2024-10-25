@extends('layouts.dashboard.app', ['title' => 'Create Penjadwalan Ruangan'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Penjadwalan Ruangan Create</h3>
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
                <a href="{{ route('penjadwalan.index') }}">Penjadwalan Ruangan</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('penjadwalan.create') }}">Create</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Form Input Penjadwalan Ruangan</h4>
                        <a href="{{ route('penjadwalan.index') }}" class="btn btn-outline-secondary btn-round ms-auto">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('penjadwalan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row align-items-center g-4">
                            <div class="col-md-6">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-building"></i>
                                    </span>
                                    <select name="ruangan_id" id="ruangan"
                                        class="form-control @error('ruangan_id') is-invalid @enderror">
                                        <option value="" selected disabled>--Pilih--</option>
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                                        @endforeach
                                    </select>

                                    @error('ruangan_id')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="jadwal" class="form-label">Jadwal</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    <select name="jadwal_id" id="jadwal"
                                        class="form-control @error('jadwal_id') is-invalid @enderror">
                                        <option value="" selected disabled>--Pilih--</option>
                                        @foreach ($jadwal as $j)
                                            <option value="{{ $j->id }}">{{ $j->day }}, {{ $j->waktuMulai }}
                                                - {{ $j->waktuSelesai }}</option>
                                        @endforeach
                                    </select>

                                    @error('jadwal_id')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="jadwal" class="form-label">Fasilitas</label>
                                <div class="input-icon">
                                    <textarea name="fasilitas" id="fasilitas" cols="30" rows="2"
                                        class="form-control  @error('fasilitas') is-invalid @enderror"></textarea>

                                    @error('fasilitas')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="harga" class="form-label">Harga
                                </label>
                                <div class="input-icon">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="number" name="harga" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                        <span class="input-group-text">,-</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="status" class="form-label">Status</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-chevron-down"></i>
                                    </span>
                                    <select name="status" id="status"
                                        class="form-control @error('status') is-invalid @enderror"
                                        placeholder="Nama Ruangan">
                                        <option selected disabled>--Pilih--
                                        </option>
                                        <option value="Boking">Boking</option>
                                        <option value="Belum Diboking">Belum Diboking</option>
                                    </select>

                                    @error('status')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="publish" class="form-label">Publish</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-chevron-down"></i>
                                    </span>
                                    <select name="publish" id="publish"
                                        class="form-control @error('publis') is-invalid @enderror"
                                        placeholder="Nama Ruangan">
                                        <option selected disabled>--Pilih--</option>
                                        <option value="published">Terbitkan</option>
                                        <option value="dispublish">Dipendam</option>
                                    </select>

                                    @error('publish')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="reset" class="btn btn-secondary rounded-pill px-4">
                                        <i class="fa fa-redo-alt me-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-success rounded-pill px-4">
                                        <i class="fa fa-check-circle me-2"></i>Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
