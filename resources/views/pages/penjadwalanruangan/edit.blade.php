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
                <form action="{{ route('penjadwalan.update', $penjadwalan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                        @foreach ($ruangan as $r)
                                            <option value="{{ $r->id }}"
                                                {{ $penjadwalan->ruangan_id == $r->id ? 'selected' : '' }}>
                                                {{ $r->nama_ruangan }}
                                            </option>
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
                                        @foreach ($jadwal as $j)
                                            <option value="{{ $j->id }}"
                                                {{ $penjadwalan->jadwal_id == $j->id ? 'selected' : '' }}>
                                                {{ $j->day }},
                                                {{ $j->waktuMulai }}
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
                                        class="form-control  @error('fasilitas') is-invalid @enderror">{{ $penjadwalan->fasilitas }}</textarea>

                                    @error('fasilitas')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="acara" class="form-label">Acara</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-building"></i>
                                    </span>
                                    <select name="event_id" id="acara"
                                        class="form-control @error('event_id') is-invalid @enderror">
                                        @foreach ($event as $e)
                                            <option value="{{ $e->id }}"
                                                {{ $penjadwalan->event_id == $e->id ? 'selected' : '' }}>
                                                {{ $e->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('event_id')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
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
                                        <option value="Boking" {{ $penjadwalan->status == 'Boking' ? 'selected' : '' }}>
                                            Boking</option>
                                        <option value="Belum Diboking"
                                            {{ $penjadwalan->status == 'Belum Boking' ? 'selected' : '' }}>Belum Diboking
                                        </option>
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
                                        class="form-control @error('publish') is-invalid @enderror"
                                        placeholder="Nama Ruangan">
                                        <option value="published"
                                            {{ $penjadwalan->publish == 'published' ? 'selected' : '' }}>Terbitkan</option>
                                        <option value="dispublish"
                                            {{ $penjadwalan->dispublish == 'dispublish' ? 'selected' : '' }}>Dipendam
                                        </option>
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
