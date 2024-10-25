@extends('layouts.dashboard.app', ['title' => 'Create Jadwal'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Jadwal Create</h3>
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
                <a href="{{ route('jadwal.index') }}">Jadwal</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('jadwal.create') }}">Create</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Form Input Jadwal</h4>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary btn-round ms-auto">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row align-items-center g-4">
                            <div class="col-md-4">
                                <label for="hari" class="form-label">Hari</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                    <input type="text" name="hari" id="hari" value="{{ old('hari') }}"
                                        class="form-control @error('hari') is-invalid @enderror" placeholder="Hari"
                                        autofocus>

                                    @error('hari')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="waktuMulai" class="form-label">Waktu Mulai</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-clock"></i>
                                    </span>
                                    <input type="time" name="waktuMulai" id="waktuMulai" value="{{ old('waktuMulai') }}"
                                        class="form-control @error('waktuMulai') is-invalid @enderror">

                                    @error('waktuMulai')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="waktuSelesai" class="form-label">Waktu Selesai</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-clock"></i>
                                    </span>
                                    <input type="time" name="waktuSelesai" id="waktuSelesai"
                                        value="{{ old('waktuSelesai') }}"
                                        class="form-control @error('waktuSelesai') is-invalid @enderror">

                                    @error('waktuSelesai')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
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
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                                    </select>

                                    @error('status')
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
