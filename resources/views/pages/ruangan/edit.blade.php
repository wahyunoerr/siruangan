@extends('layouts.dashboard.app', ['title' => 'Edit Ruangan'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Ruangan Edit</h3>
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
                <a href="{{ route('ruangan.index') }}">Ruangan</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('ruangan.edit', $ruangan->id) }}">Edit</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Ruangan Edit</h4>

                        <a href="{{ route('ruangan.index') }}" class="btn btn-outline-secondary btn-round ms-auto">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row align-items-center g-4">
                            <div class="col-md-6">
                                <label for="kd_ruangan" class="form-label">Kode Ruangan</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-barcode"></i>
                                    </span>
                                    <input type="text" name="kd_ruangan" id="kd_ruangan"
                                        value="{{ old('kd_ruangan', $ruangan->kd_ruangan) }}"
                                        class="form-control @error('kd_ruangan') is-invalid @enderror"
                                        placeholder="Kode Ruangan">

                                    @error('kd_ruangan')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="nama_ruangan" id="nama_ruangan"
                                        value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}"
                                        class="form-control @error('nama_ruangan') is-invalid @enderror"
                                        placeholder="Nama Ruangan">

                                    @error('nama_ruangan')
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
