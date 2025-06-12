<div class="modal-header">
    <h5 class="modal-title">Detail Penelitian</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <ul class="list-group">
        <li class="list-group-item"><strong>Nama Dosen:</strong> {{ $penelitianDosen->dosen->name }}</li>
        <li class="list-group-item"><strong>No Surat Tugas:</strong> {{ $penelitianDosen->penelitian->no_surat_tugas }}</li>
        <li class="list-group-item"><strong>Judul Penelitian:</strong> {{ $penelitianDosen->penelitian->judul_penelitian }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($penelitianDosen->status) }}</li>
        <li class="list-group-item"><strong>Internal:</strong> Rp{{ number_format($penelitianDosen->penelitian->pendanaan_internal) }}</li>
        <li class="list-group-item"><strong>Eksternal:</strong> Rp{{ number_format($penelitianDosen->penelitian->pendanaan_eksternal) }}</li>
        <li class="list-group-item"><strong>Link:</strong> <a href="{{ $penelitianDosen->penelitian->link_penelitian }}" target="_blank">{{ $penelitianDosen->penelitian->link_penelitian }}</a></li>
    </ul>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
</div>
