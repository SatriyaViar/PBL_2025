@empty($user)
    <!-- Error message remains the same -->
@else
    <form action="{{ url('/user/' . $user->user_id . '/delete_ajax') }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-ban"></i> Konfirmasi !!!</h5>
                        Apakah Anda Yakin ingin menghapus data di bawah ini?
                    </div>
                    <table class="table table-sm table-bordered table-striped">
                        <tr>
                            <th class="text-right col-3">Level Pengguna :</th>
                            <td class="col-9">{{ $user->level->level_name }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Username :</th>
                            <td class="col-9">{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Nama :</th>
                            <td class="col-9">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">NIDN :</th>
                            <td class="col-9">{{ $user->nidn ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Email :</th>
                            <td class="col-9">{{ $user->email ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>
    <!-- Script remains the same -->
    <script>
        $(document).ready(function() {
            $('#form-delete').on('submit', function(e) {
                e.preventDefault(); // menghindari form reload halaman

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(), // ambil semua field termasuk _method & _token
                    success: function(response) {
                        alert(response.message);
                        if (response.status) {
                            $('#myModal').modal('hide'); // tutup modal
                            $('#table_user').DataTable().ajax.reload(); // kemudian refresh tabel
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endempty
