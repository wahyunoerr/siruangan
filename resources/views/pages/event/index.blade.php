@extends('layouts.dashboard.app', ['title' => 'Acara'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Acara</h3>
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
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Acara</h4>

                        <a href="{{ route('acara.create') }}" class="btn btn-primary btn-round ms-auto">
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
                                    <th>Nama Acara</th>
                                    <th>Harga</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event as $e)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $e->name }}</td>
                                        <td>Rp. {{ number_format($e->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('acara.edit', $e->id) }}" data-bs-toggle="tooltip"
                                                    title="Edit" class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('acara.delete', $e->id) }}" data-bs-toggle="tooltip"
                                                    title="Remove" class="btn btn-link btn-danger btn-lg"
                                                    data-original-title="Remove" data-confirm-delete="true">
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
                                    <th>Nama Acara</th>
                                    <th>Harga</th>
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
