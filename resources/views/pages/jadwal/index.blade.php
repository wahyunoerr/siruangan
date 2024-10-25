@extends('layouts.dashboard.app', ['title' => 'Jadwal'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Jadwal</h3>
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
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Jadwal</h4>

                        <a href="{{ route('jadwal.create') }}" class="btn btn-primary btn-round ms-auto">
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
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jadwal->day }}</td>
                                        <td>{{ $jadwal->waktuMulai }} - {{ $jadwal->waktuSelesai }}</td>
                                        <td>
                                            @if ($jadwal->status == 'Tersedia')
                                                <span class="badge badge-success">{{ $jadwal->status }}</span>
                                            @elseif ($jadwal->status == 'Tidak Tersedia')
                                                <span class="badge badge-primary">{{ $jadwal->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('jadwal.edit', $jadwal->id) }}" data-bs-toggle="tooltip"
                                                    title="Edit" class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('jadwal.destroy', $jadwal->id) }}"
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
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Status</th>
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
