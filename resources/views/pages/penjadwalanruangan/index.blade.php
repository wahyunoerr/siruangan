@extends('layouts.dashboard.app', ['title' => 'Penjadwalan Ruangan'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Penjadwalan Ruangan</h3>
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
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Penjadwalan Ruangan</h4>

                        <a href="{{ route('penjadwalan.create') }}" class="btn btn-primary btn-round ms-auto">
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
                                    <th>No</th>
                                    <th>Ruangan</th>
                                    <th>Jadwal</th>
                                    <th>Status</th>
                                    <th>Publish</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjadwalanR as $pr)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pr->ruangan->nama_ruangan }}</td>
                                        <td>{{ $pr->jadwal->day }}, {{ $pr->jadwal->waktuMulai }} -
                                            {{ $pr->jadwal->waktuSelesai }}</td>
                                        <td>
                                            @if ($pr->status == 'Boking')
                                                <span class="badge badge-success">{{ $pr->status }}</span>
                                            @elseif ($pr->status == 'Belum Diboking')
                                                <span class="badge badge-danger">{{ $pr->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pr->publish == 'published')
                                                <span class="badge badge-success">{{ $pr->publish }}</span>
                                            @elseif ($pr->publish == 'dispublish')
                                                <span class="badge badge-warning">{{ $pr->publish }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('penjadwalan.edit', $pr->id) }}" data-bs-toggle="tooltip"
                                                    title="Edit" class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('penjadwalan.destroy', $pr->id) }}"
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
                                    <th>Ruangan</th>
                                    <th>Jadwal</th>
                                    <th>Status</th>
                                    <th>Publish</th>
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
