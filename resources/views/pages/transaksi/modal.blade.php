<div class="modal fade" id="uploadModal-{{ $t->id }}" tabindex="-1"
    aria-labelledby="uploadModalLabel-{{ $t->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('transaksi.uploadBukti', $t->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel-{{ $t->id }}">Upload Bukti Pelunasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="transaksi_id" value="{{ $t->id }}">
                    <div class="mb-3">
                        <label for="buktiPelunasan{{ $t->id }}" class="form-label">Pilih Bukti</label>
                        <input type="file" class="form-control" id="buktiPelunasan{{ $t->id }}"
                            name="buktiPelunasan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
