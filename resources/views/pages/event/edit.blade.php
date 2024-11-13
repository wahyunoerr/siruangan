@extends('layouts.dashboard.app', ['title' => 'Create Event'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Acara Create</h3>
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
                <a href="{{ route('acara.index') }}">Acara</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('acara.create') }}">Create</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Form Input Acara</h4>
                        <a href="{{ route('acara.index') }}" class="btn btn-outline-secondary btn-round ms-auto">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('acara.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row align-items-center g-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama Acara</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $event->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama Acara"
                                        autofocus>

                                    @error('name')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="harga" class="form-label">Harga</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                    <input type="number" name="harga" id="harga"
                                        value="{{ old('harga', $event->harga) }}"
                                        class="form-control @error('harga') is-invalid @enderror" placeholder="Harga">

                                    @error('harga')
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
