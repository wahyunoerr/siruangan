<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Form Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking.save') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ruangan_id" id="ruangan_id">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}">

                    <div class="mb-3">
                        <label for="event_id" class="form-label">Pilih Event</label>
                        <select class="form-select" name="event_id" id="event_id" required>
                            <option value="" disabled selected>-- Pilih Event --</option>
                            @foreach ($event as $e)
                                <option value="{{ $e->id }}" data-name="{{ $e->name }}">{{ $e->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jadwal_id" class="form-label">Pilih Jadwal</label>
                        <select class="form-select" name="jadwal_id" id="jadwal_id" required>
                            <option value="" disabled selected>-- Pilih Jadwal --</option>
                            @php
                                $jadwalTersedia = false;
                            @endphp

                            @foreach ($jadwal as $j)
                                @if ($j->status == 'Tersedia')
                                    @php
                                        $jadwalTersedia = true;
                                    @endphp
                                    <option value="{{ $j->id }}">{{ $j->day }}, {{ $j->waktuMulai }} sd
                                        {{ $j->waktuSelesai }}</option>
                                @endif
                            @endforeach

                            {!! $jadwalTersedia ? '' : '<option value="" disabled>Jadwal Penuh</option>' !!}
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="tanggal_booking" class="form-label">Tanggal Booking</label>
                        <input type="date" class="form-control" name="tanggal_booking" id="tanggal_booking" required>
                    </div>

                    <div class="mb-3">

                    </div>

                    <div class="mb-3">
                        <div id="fileUploadContainer" style="display: none;">
                            <label for="upload_file" class="form-label">Upload Kop Surat</label>
                            <input type="file" class="form-control" name="upload_file" id="upload_file">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="buktiTransaksi" class="form-label">Bukti Transaksi</label>
                        <input type="file" class="form-control" name="buktiTransaksi" id="buktiTransaksi">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var eventSelect = document.getElementById('event_id');
        var fileUploadContainer = document.getElementById('fileUploadContainer');

        var eventsWithFileUpload = ['Tahfiz Quran', 'Seminar', 'Perpisahan Sekolah'];

        eventSelect.addEventListener('change', function() {
            var selectedOption = eventSelect.options[eventSelect.selectedIndex];
            var selectedEventName = selectedOption.getAttribute('data-name');

            if (eventsWithFileUpload.includes(selectedEventName)) {
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
