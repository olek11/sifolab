<!-- resources/views/admin/user/modal.blade.php -->
<div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Hapus {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">×</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-6">
                        Nama Bahan
                    </div>
                    <div class="col-6">
                        : {{ $item->name }}
                    </div>
                    <div class="col-6">
                        Jumlah Bahan
                    </div>
                    <div class="col-6">
                        : {{ $item->jumlah_bahan }}
                    </div>
                    <div class="col-6">
                        Satuan
                    </div>
                    <div class="col-6">
                        : {{ $item->satuan }}
                    </div>
                    <div class="col-6">
                        Deskripsi
                    </div>
                    <div class="col-6">
                        : {{ $item->deskripsi ?? '-' }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Tutup
                </button>
                <form action="{{ route('admin.bahan.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
