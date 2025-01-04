@extends('layouts.dashboard.app', ['title' => 'Ruangan'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Ruangan</h3>
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
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Ruangan</h4>

                        <a href="{{ route('ruangan.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Add Row
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Kode Ruangan</th>
                                    <th>Nama Ruangan</th>
                                    <th>Foto Ruangan</th>
                                    <th>Video Ruangan</th>
                                    <th>Status Ruangan</th>
                                    <th>Keterangan</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruangans as $ruangan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge badge-secondary">{{ $ruangan->kd_ruangan }}</span>
                                        </td>
                                        <td>{{ $ruangan->nama_ruangan }}</td>
                                        <td>
                                            @if ($ruangan->images->isNotEmpty())
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#imageModal-{{ $ruangan->id }}">
                                                    View Images
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="imageModal-{{ $ruangan->id }}" tabindex="-1"
                                                    aria-labelledby="imageModalLabel-{{ $ruangan->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="imageModalLabel-{{ $ruangan->id }}">
                                                                    {{ $ruangan->nama_ruangan }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="carousel-{{ $ruangan->id }}"
                                                                    class="carousel slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        @php
                                                                            $images = json_decode(
                                                                                $ruangan->images->first()->images,
                                                                            );
                                                                        @endphp
                                                                        @foreach ($images as $index => $image)
                                                                            <div
                                                                                class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                                <img src="{{ Storage::disk('public')->url($image) }}"
                                                                                    class="d-block w-100" height="500">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <button class="carousel-control-prev" type="button"
                                                                        data-bs-target="#carousel-{{ $ruangan->id }}"
                                                                        data-bs-slide="prev">
                                                                        <span class="carousel-control-prev-icon"
                                                                            aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button"
                                                                        data-bs-target="#carousel-{{ $ruangan->id }}"
                                                                        data-bs-slide="next">
                                                                        <span class="carousel-control-next-icon"
                                                                            aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Next</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="badge badge-danger">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($ruangan->videos)
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#videoModal-{{ $ruangan->id }}">
                                                    View Videos
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="videoModal-{{ $ruangan->id }}" tabindex="-1"
                                                    aria-labelledby="videoModalLabel-{{ $ruangan->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="videoModalLabel-{{ $ruangan->id }}">
                                                                    {{ $ruangan->nama_ruangan }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @foreach (json_decode($ruangan->videos) as $video)
                                                                    <video width="100%" height="500" controls>
                                                                        <source
                                                                            src="{{ Storage::disk('public')->url($video) }}"
                                                                            type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="badge badge-danger">No Video</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($ruangan->status == 'Sudah Dibooking')
                                                <span class="badge badge-success">Sudah Dibooking</span>
                                            @elseif ($ruangan->status == 'Belum Dibooking')
                                                <span class="badge badge-warning">Belum Dibooking</span>
                                            @else
                                                <span class="badge badge-danger">Data booking tidak ditemukan</span>
                                            @endif
                                        </td>
                                        <td>{{ $ruangan->keterangan }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('ruangan.edit', $ruangan->id) }}"
                                                    data-bs-toggle="tooltip" title="Edit"
                                                    class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('ruangan.destroy', $ruangan->id) }}"
                                                    data-bs-toggle="tooltip" title="Remove"
                                                    class="btn btn-link btn-danger btn-lg" data-original-title="Remove"
                                                    data-confirm-delete="true">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Ruangan</th>
                                    <th>Nama Ruangan</th>
                                    <th>Foto Ruangan</th>
                                    <th>Video Ruangan</th>
                                    <th>Status Ruangan</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('cdn-ligtbox')
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush
