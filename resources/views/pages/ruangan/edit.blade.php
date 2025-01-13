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
                        <h4 class="card-title">Form Edit Ruangan</h4>
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
                            <div class="col-md-4">
                                <label for="kd_ruangan" class="form-label">Kode Ruangan</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-barcode"></i>
                                    </span>
                                    <input type="text" name="kd_ruangan" id="kd_ruangan"
                                        value="{{ old('kd_ruangan', $ruangan->kd_ruangan) }}"
                                        class="form-control @error('kd_ruangan') is-invalid @enderror"
                                        placeholder="Kode Ruangan" autofocus>

                                    @error('kd_ruangan')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
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

                            <div class="col-md-4">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-building"></i>
                                    </span>
                                    <input type="text" name="kapasitas" id="kapasitas"
                                        value="{{ old('kapasitas', $ruangan->kapasitas) }}"
                                        class="form-control @error('kapasitas') is-invalid @enderror"
                                        placeholder="Kapasitas">

                                    @error('kapasitas')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="images" class="form-label">Foto Ruangan</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                    <input type="file" name="images[]" id="images" multiple
                                        class="form-control @error('images.*') is-invalid @enderror"
                                        placeholder="Foto Ruangan" onchange="previewImages()">

                                    @error('images.*')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div id="imagePreview" class="mt-3 d-flex flex-wrap gap-2"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="existing_images" class="form-label">Existing Images</label>
                                <div id="existing_images" class="d-flex flex-wrap gap-2">
                                    @foreach ($existingImages as $image)
                                        <img src="{{ asset('storage/' . $image) }}" height="100" class="me-2 mb-2">
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="videos" class="form-label">Video Ruangan</label>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                    <input type="file" name="videos" id="videos"
                                        class="form-control @error('videos') is-invalid @enderror"
                                        placeholder="Video Ruangan">

                                    @error('videos')
                                        <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="jam_penyewaan" class="form-label">Jam Penyewaan</label>
                                <input type="name" name="jam_penyewaan" id="jam_penyewaan"
                                    class="form-control @error('jam_penyewaan') is-invalid @enderror"
                                    placeholder="Jam Penyewaan"
                                    value="{{ old('jam_penyewaan', $ruangan->jamPenyewaan) }}">
                                @error('jam_penyewaan')
                                    <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>


                            <div class="col-md-12">
                                <label for="keterangan" class="form-label">Fasilitas</label>
                                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                    placeholder="Fasilitas">{{ old('keterangan', $ruangan->keterangan) }}</textarea>
                                @error('keterangan')
                                    <small id="emailHelp" class="form-text text-muted my-1 text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
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
        function previewImages() {
            var preview = document.querySelector('#imagePreview');
            preview.innerHTML = '';
            if (this.files) {
                [].forEach.call(this.files, readAndPreview);
            }

            function readAndPreview(file) {
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    return alert(file.name + " is not an image");
                }

                var reader = new FileReader();
                reader.addEventListener("load", function() {
                    var image = new Image();
                    image.height = 100;
                    image.title = file.name;
                    image.src = this.result;
                    image.classList.add('me-2', 'mb-2');
                    preview.appendChild(image);
                });
                reader.readAsDataURL(file);
            }
        }

        document.querySelector('#images').addEventListener("change", previewImages);
    </script>
@endsection
