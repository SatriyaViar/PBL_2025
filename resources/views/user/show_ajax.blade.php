@empty($user)
    <!-- Error message remains the same -->
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info-circle"></i> Informasi</h5>
                    Berikut adalah detail data user yang dipilih.
                </div>

                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th class="text-right col-4">Username:</th>
                        <td class="col-8">{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-4">Nama:</th>
                        <td class="col-8">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-4">Level:</th>
                        <td class="col-8">{{ $user->level->level_name }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-4">NIDN:</th>
                        <td class="col-8">{{ $user->nidn ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-4">Email:</th>
                        <td class="col-8">{{ $user->email ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
@endempty