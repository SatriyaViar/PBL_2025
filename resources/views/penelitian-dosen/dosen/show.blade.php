@empty($penelitianDosen)
    <div class="alert alert-danger">Data not found!</div>
@else
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Research Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr><th class="text-right">Lecturer Name</th><td>{{ $penelitianDosen->dosen->name }}</td></tr>
                <tr><th class="text-right">Letter Number</th><td>{{ $penelitianDosen->penelitian->no_surat_tugas }}</td></tr>
                <tr><th class="text-right">Research Title</th><td>{{ $penelitianDosen->penelitian->judul_penelitian }}</td></tr>
                <tr><th class="text-right">Status</th><td>{{ ucfirst($penelitianDosen->status) }}</td></tr>
                <tr><th class="text-right">Internal Funding</th><td>Rp{{ number_format((float)$penelitianDosen->penelitian->pendanaan_internal) }}</td></tr>
                <tr><th class="text-right">External Funding</th><td>Rp{{ number_format((float)$penelitianDosen->penelitian->pendanaan_eksternal) }}</td></tr>
                <tr><th class="text-right">Link</th>
                    <td><a href="{{ $penelitianDosen->penelitian->link_penelitian }}" target="_blank">{{ $penelitianDosen->penelitian->link_penelitian }}</a></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
@endempty
