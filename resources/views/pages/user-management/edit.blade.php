@extends('layouts.dashboard.app', ['title' => 'Create Users'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Users Edit</h3>
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
                <a href="{{ route('user.index') }}">Users</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('user.edit', $user->id) }}">Edit</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">User Edit</h4>
                        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary btn-round ms-auto">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row align-items-center g-4">
                            <div class="col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $user->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Fullname">

                                    @error('name')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="Email">

                                    @error('email')
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">User Update Password</h4>
                    </div>
                </div>
                <form action="{{ route('user.update-password', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row align-items-center g-4">
                            <div class="col-md-12">
                                <label for="New password" class="form-label">New Password</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-user-lock"></i>
                                    </span>
                                    <input type="password" name="new_password" id="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        placeholder="New Password">

                                    @error('new_password')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-user-lock"></i>
                                    </span>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Password Confirmation">

                                    @error('password_confirmation')
                                        <small id="emailHelp" class="form-text text-muted">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn w-100 btn-success rounded-pill px-4">
                                        <i class="fa fa-check-circle me-2"></i>Update Password
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
