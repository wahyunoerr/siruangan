@extends('layouts.dashboard.app', ['title' => 'Landing'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Landing</h3>
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
                <a href="{{ route('landing.manage') }}">Landing</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Landing</h4>

                        <a href="{{ route('landing.create') }}" class="btn btn-primary btn-round ms-auto">
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
                                    <th>Description</th>
                                    <th>Full Image</th>
                                    <th>Description Image</th>
                                    <th>Room Image</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($landings as $l)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $l->description }}</td>
                                        <td><img src="{{ asset('storage/' . $l->full_image) }}" alt="Full Image"
                                                width="100" class="img-preview" data-bs-toggle="modal"
                                                data-bs-target="#imageModal">
                                        </td>
                                        <td><img src="{{ asset('storage/' . $l->description_image) }}"
                                                alt="Description Image" width="100" class="img-preview"
                                                data-bs-toggle="modal" data-bs-target="#imageModal">
                                        </td>
                                        <td><img src="{{ asset('storage/' . $l->room_image) }}" alt="Room Image"
                                                width="100" class="img-preview" data-bs-toggle="modal"
                                                data-bs-target="#imageModal">
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('landing.edit', $l->id) }}" data-bs-toggle="tooltip"
                                                    title="Edit" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('landing.destroy', $l->id) }}" data-bs-toggle="tooltip"
                                                    title="Remove" class="btn btn-link btn-danger btn-lg"
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
                                    <th width="10%">No</th>
                                    <th>Description</th>
                                    <th>Full Image</th>
                                    <th>Description Image</th>
                                    <th>Room Image</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Image Preview" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.img-preview').forEach(img => {
            img.addEventListener('click', function() {
                document.getElementById('modalImage').src = this.src;
            });
        });
    </script>
@endsection
