<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            background: none;
        }

        .card {
            border-radius: 15px;
        }

        .card-title {
            text-align: center;
            color: initial;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Isi Form Booking</h3>
        <div class="card animate__animated animate__fadeInUp">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger animate__animated animate__shakeX">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('booking.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ruangan_id" id="ruangan_id">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">

                    <div class="mb-3">
                        <label for="event_id" class="form-label">Pilih Event</label>
                        <select class="form-select" name="event_id" id="event_id" required>
                            <option value="" disabled selected>-- Pilih Event --</option>
                            @foreach ($event as $e)
                                <option value="{{ $e->id }}" data-name="{{ $e->name }}">{{ $e->name }}
                                    | Rp. {{ number_format($e->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="ruangan_id" class="form-label">Pilih Ruangan</label>
                        <select class="form-select" name="ruangan_id" id="ruangan_id" required>
                            <option value="" disabled selected>-- Pilih Ruangan --</option>
                            @foreach ($ruangan as $r)
                                <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jadwal_start_time" class="form-label">Jam Mulai</label>
                            <input type="text" class="form-control" name="jadwal_start_time" id="jadwal_start_time"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="jadwal_end_time" class="form-label">Jam Selesai</label>
                            <input type="text" class="form-control" name="jadwal_end_time" id="jadwal_end_time"
                                required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_booking" class="form-label">Tanggal Booking</label>
                        <input type="date" class="form-control" name="tanggal_booking" id="tanggal_booking" required>
                    </div>

                    <div class="mb-3">
                        <div id="fileUploadContainer" style="display: none;">
                            <label for="upload_file" class="form-label">Surat izin penyewaan <span
                                    class="badge bg-info">.pdf
                                    .doxc</span>
                            </label>
                            <input type="file" class="form-control" name="upload_file" id="upload_file">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker/dist/bootstrap-clockpicker.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var eventSelect = document.getElementById('event_id');
            var fileUploadContainer = document.getElementById('fileUploadContainer');

            var eventsWithFileUpload = ['Tahfiz Quran', 'Seminar', 'Perpisahan Sekolah'];

            eventSelect.addEventListener('change', function() {
                var selectedOption = eventSelect.options[eventSelect.selectedIndex];
                var selectedEventName = selectedOption.getAttribute('data-name');

                if (eventsWithFileUpload.includes(selectedEventName)) {
                    fileUploadContainer.classList.add('animate__animated', 'animate__fadeIn');
                    fileUploadContainer.style.display = 'block';
                } else {
                    fileUploadContainer.style.display = 'none';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var bookingButtons = document.querySelectorAll('[data-bs-target="#bookingModal"]');
            var ruanganInput = document.getElementById('ruangan_id');

            bookingButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var ruanganId = button.getAttribute('data-id');
                    ruanganInput.value = ruanganId;
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#jadwal_start_time').clockpicker({
                autoclose: true
            });
            $('#jadwal_end_time').clockpicker({
                autoclose: true
            });
        });
    </script>
</body>

</html>
