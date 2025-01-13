@extends('layouts.dashboard.app', ['title' => 'Edit Landing'])

@section('content')
    <div class="page-header">
        <h3 class="fw-bold mb-3">Edit Landing</h3>
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
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('landing.edit', $landing->id) }}">Edit</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Form Edit Landing</h4>
                        <a href="{{ route('landing.manage') }}" class="btn btn-outline-secondary btn-round ms-auto">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <form action="{{ route('landing.update', $landing->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row align-items-center g-4">
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-align-left"></i>
                                    </span>
                                    <input type="text" name="description" value="{{ $landing->description }}"
                                        id="description" value="{{ old('description') }}"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Description" autofocus>

                                    @error('description')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="full_image" class="form-label">Full Image</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-image"></i>
                                    </span>
                                    <input type="file" name="full_image" id="full_image"
                                        class="form-control @error('full_image') is-invalid @enderror"
                                        onchange="previewImage(event, 'full_image_preview')">
                                    <img id="full_image_preview" src="#" alt="Full Image Preview"
                                        style="display:none; max-width: 100%; margin-top: 10px;" />
                                    @error('full_image')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="description_image" class="form-label">Description Image</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-image"></i>
                                    </span>
                                    <input type="file" name="description_image" id="description_image"
                                        class="form-control @error('description_image') is-invalid @enderror"
                                        onchange="previewImage(event, 'description_image_preview')">
                                    <img id="description_image_preview" src="#" alt="Description Image Preview"
                                        style="display:none; max-width: 100%; margin-top: 10px;" />
                                    @error('description_image')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="room_image" class="form-label">Room Image</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-image"></i>
                                    </span>
                                    <input type="file" name="room_image" id="room_image"
                                        class="form-control @error('room_image') is-invalid @enderror"
                                        onchange="previewImage(event, 'room_image_preview')">
                                    <img id="room_image_preview" src="#" alt="Room Image Preview"
                                        style="display:none; max-width: 100%; margin-top: 10px;" />
                                    @error('room_image')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="full_image" class="form-label">Full Images</label>
                                <div id="full_image" class="d-flex flex-wrap gap-2">
                                    @foreach ($existingImages as $image)
                                        <img src="{{ asset('storage/' . $image->full_image) }}" height="100"
                                            class="me-2 mb-2">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="description_image" class="form-label">Description Images</label>
                                <div id="description_image" class="d-flex flex-wrap gap-2">
                                    @foreach ($existingImages as $image)
                                        <img src="{{ asset('storage/' . $image->description_image) }}" height="100"
                                            class="me-2 mb-2">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="description_image" class="form-label">Room Images</label>
                                <div id="description_image" class="d-flex flex-wrap gap-2">
                                    @foreach ($existingImages as $image)
                                        <img src="{{ asset('storage/' . $image->room_image) }}" height="100"
                                            class="me-2 mb-2">
                                    @endforeach
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
    <script>
        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewId);
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
