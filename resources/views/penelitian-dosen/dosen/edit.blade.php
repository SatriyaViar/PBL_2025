<form id="formEdit" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title">Edit Penelitian</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value="{{ $penelitianDosen->id_penelitian_dosen }}">
        <div class="form-group">
            <label>No Surat Tugas</label>
            <input type="text" name="no_surat_tugas" class="form-control" value="{{ $penelitianDosen->penelitian->no_surat_tugas }}" required>
        </div>
        <div class="form-group">
            <label>Judul Penelitian</label>
            <input type="text" name="judul_penelitian" class="form-control" value="{{ $penelitianDosen->penelitian->judul_penelitian }}" required>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="accepted" {{ $penelitianDosen->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="rejected" {{ $penelitianDosen->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <div class="form-group">
            <label>Pendanaan Internal</label>
            <input type="number" name="pendanaan_internal" class="form-control" value="{{ $penelitianDosen->penelitian->pendanaan_internal }}">
        </div>
        <div class="form-group">
            <label>Pendanaan Eksternal</label>
            <input type="number" name="pendanaan_eksternal" class="form-control" value="{{ $penelitianDosen->penelitian->pendanaan_eksternal }}">
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" id="saveBtn">Update</button>
        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </div>
</form>

<script>
$('#formEdit').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '{{ url("penelitian-dosen/" . $penelitianDosen->id_penelitian_dosen) }}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(res) {
            toastr.success(res.message);
            $('#myModal').modal('hide');
            $('#table_master').DataTable().ajax.reload();
        },
        error: function(err) {
            toastr.error(err.responseJSON.message || 'Gagal update data.');
        }
    });
});
</script>
