<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form id="formCreate" action="{{ url('penelitian-dosen') }}" method="POST">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Tambah Penelitian</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>No Surat Tugas</label>
                    <input type="text" name="no_surat_tugas" class="form-control">
                    <small class="text-danger" id="error-no_surat_tugas"></small>
                </div>
                <div class="form-group">
                    <label>Judul Penelitian</label>
                    <input type="text" name="judul_penelitian" class="form-control">
                    <small class="text-danger" id="error-judul_penelitian"></small>
                </div>
                <div class="form-group">
                    <label>Pendanaan Internal</label>
                    <input type="text" name="pendanaan_internal" class="form-control">
                </div>
                <div class="form-group">
                    <label>Pendanaan Eksternal</label>
                    <input type="text" name="pendanaan_eksternal" class="form-control">
                </div>
                <div class="form-group">
                    <label>Link Penelitian</label>
                    <input type="text" name="link_penelitian" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </form>

    </div>
</div>

<script>
    $('#formCreate').submit(function(e) {
        e.preventDefault();

        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(res) {
                toastr.success(res.message || 'Berhasil disimpan');
                $('#myModal').modal('hide');
                $('#table_master').DataTable().ajax.reload();
            },
            error: function(err) {
                $('.text-danger').text('');
                if (err.responseJSON?.errors) {
                    $.each(err.responseJSON.errors, function(field, messages) {
                        $('#error-' + field).text(messages[0]);
                    });
                }
                toastr.error('Terjadi kesalahan saat menyimpan');
            }
        });
    });
</script>
