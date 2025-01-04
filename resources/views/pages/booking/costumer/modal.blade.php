<div class="modal fade" id="uploadModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="uploadModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel{{ $item->id }}">Upload Bukti Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('upload.bukti', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="buktiTransaksi{{ $item->id }}" class="form-label">Upload Bukti Transaksi</label>
                        <input type="file" name="buktiTransaksi" id="buktiTransaksi{{ $item->id }}"
                            class="form-control" required>
                        <div class="md-12">
                            <div class="alert alert-primary" role="alert">
                                <h5 class="alert heading">No Rekening</h5>
                                <div class="col-md-7">
                                    <ul>
                                        <li>BCA <span class="ms-2"> : <strong>999999999 A/N Nama</strong></span>
                                        </li>
                                        <li>BCA <span class="ms-2"> : <strong>999999999 A/N Nama</strong></span>
                                        </li>
                                        <li>BCA <span class="ms-2"> : <strong>999999999 A/N Nama</strong></span>
                                        </li>
                                        <li>BCA <span class="ms-2"> : <strong>999999999 A/N Nama</strong></span>
                                        </li>
                                        <li>BCA <span class="ms-2"> : <strong>999999999 A/N Nama</strong></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
