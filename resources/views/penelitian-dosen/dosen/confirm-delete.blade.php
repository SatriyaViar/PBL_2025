@empty($penelitianDosen)
    <div class="alert alert-danger">Data tidak ditemukan.</div>
@else
    <form action="{{ route('penelitian-dosen.destroy', $penelitianDosen->id_penelitian_dosen) }}" method="POST"
        id="form-delete">
        @csrf
        @method('DELETE')
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Penelitian Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <strong>Yakin ingin menghapus?</strong><br>
                        Judul: <b>{{ $penelitianDosen->penelitian->judul_penelitian }}</b>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#form-delete').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message ||
                                'Data penelitian dan dosen berhasil dihapus',
                            confirmButtonColor: '#6c5ce7',
                            confirmButtonText: 'OK'
                        });

                        $('#myModal').modal('hide');
                        $('#table_master').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON?.message ||
                                'Terjadi kesalahan saat menghapus data.'
                        });
                    }
                });
            });
        });
    </script>
@endempty
