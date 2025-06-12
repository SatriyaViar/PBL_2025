<div class="modal fade" id="modalShowPenelitian" tabindex="-1" aria-labelledby="modalShowPenelitianLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalShowPenelitianLabel">Research Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- No Surat Tugas --}}
                <div class="mb-3">
                    <label class="form-label">No Assignment Letter</label>
                    <input type="text" class="form-control" value="{{ $penelitianDosen->penelitian->no_surat_tugas }}" readonly>
                </div>

                {{-- Judul Penelitian --}}
                <div class="mb-3">
                    <label class="form-label">Research Title</label>
                    <input type="text" class="form-control" value="{{ $penelitianDosen->penelitian->judul_penelitian }}" readonly>
                </div>

                {{-- Pendanaan Internal --}}
                <div class="mb-3">
                    <label class="form-label">Internal Funding</label>
                    <input type="text" class="form-control" value="{{ $penelitianDosen->penelitian->pendanaan_internal ?? 'Tidak ada' }}" readonly>
                </div>

                {{-- Pendanaan Eksternal --}}
                <div class="mb-3">
                    <label class="form-label">External Funding</label>
                    <input type="text" class="form-control" value="{{ $penelitianDosen->penelitian->pendanaan_eksternal ?? 'Tidak ada' }}" readonly>
                </div>

                {{-- Link Penelitian --}}
                <div class="mb-3">
                    <label class="form-label">Research Links</label>
                    <textarea class="form-control summernote" id="link_penelitian" readonly>{!! $penelitianDosen->penelitian->link_penelitian !!}</textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Summernote CDN --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#link_penelitian').summernote({
            height: 200,
            toolbar: false,
            disableResizeEditor: true,
            airMode: false,
            disableDragAndDrop: true
        }).summernote('disable');
    });
</script>
