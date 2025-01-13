@foreach ($data as $booking)
    <div class="modal fade" id="dpModal{{ $booking->id }}" tabindex="-1" aria-labelledby="dpModalLabel{{ $booking->id }}"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('transaksi.inputDp', $booking->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="dpModalLabel{{ $booking->id }}">Input Jumlah DP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="dpAmount{{ $booking->id }}" class="form-label">Jumlah DP (Rp)</label>
                            <input type="number" name="dp" id="dpAmount{{ $booking->id }}" class="form-control"
                                required>
                        </div>
                        <input type="hidden" name="status" value="setujui">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
