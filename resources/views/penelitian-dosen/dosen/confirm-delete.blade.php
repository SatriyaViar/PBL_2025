<form id="formDelete" method="POST">
    @csrf
    @method('DELETE')
    <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus data penelitian ini?</p>
        <p><strong>{{ $penelitianDosen->penelitian->judul_penelitian }}</strong></p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" id="deleteBtn">Hapus</button>
        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </div>
</form>

<script>
$('#formDelete').submit(function(e) {
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
            toastr.error(err.responseJSON.message || 'Gagal menghapus data.');
        }
    });
});
</script>
