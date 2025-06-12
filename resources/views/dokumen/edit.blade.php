@extends('layouts.template')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Edit Dokumen {{ $label }}</h2>
        <p class="text-muted">
            Kriteria <strong>{{ strtoupper($kriteria_nama) }}</strong>
             ID #{{ $dokumen->id }}
        </p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-warning text-white fw-bold">
        Perbarui Dokumen
    </div>
    <div class="card-body">
        <form id="form-dokumen"
              action="{{ route('dokumen.update', [$kriteria, $jenis_list, $dokumen->id]) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Isi Dokumen</label>
                <textarea id="summernote" name="description" class="form-control"
                          rows="10">{{ old('description', $dokumen->description) }}</textarea>
            </div>

            {{-- Pilihan tipe dokumen --}}
            <div class="mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input"
                           type="checkbox"
                           id="tipe_file"
                           name="tipe_dokumen[]"
                           value="file"
                           {{ $dokumen->file_pendukung ? 'checked' : '' }}>
                    <label class="form-check-label" for="tipe_file">Upload File</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input"
                           type="checkbox"
                           id="tipe_link"
                           name="tipe_dokumen[]"
                           value="link"
                           {{ $dokumen->link ? 'checked' : '' }}>
                    <label class="form-check-label" for="tipe_link">Input Link</label>
                </div>
            </div>

            {{-- Input file --}}
            <div class="mb-3" id="input-file-group">
                <label class="form-label">File Pendukung
                    @if ($dokumen->file_pendukung)
                        (<a href="{{ asset('storage/'.$dokumen->file_pendukung) }}"
                            target="_blank">lihat file lama</a>)
                    @endif
                </label>
                <input type="file" name="file_pendukung" class="form-control">
            </div>

            {{-- Input link --}}
            <div class="mb-3" id="input-link-group">
                <label class="form-label">Link Pendukung</label>
                <input type="url" name="link" id="link" class="form-control"
                       placeholder="https://contoh.com"
                       value="{{ old('link', $dokumen->link) }}">
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
            <a href="{{ route('dokumen.preview', [$kriteria_nama, $jenis_list]) }}"
               class="btn btn-secondary ms-2">Batal</a>
        </form>
    </div>
</div>

{{-- ====== JavaScript (re-pakai logika lama) ====== --}}
@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tipeFile  = document.getElementById('tipe_file');
    const tipeLink  = document.getElementById('tipe_link');
    const fileGroup = document.getElementById('input-file-group');
    const linkGroup = document.getElementById('input-link-group');

    function toggleInput() {
        fileGroup.style.display = tipeFile.checked ? 'block' : 'none';
        linkGroup.style.display = tipeLink.checked ? 'block' : 'none';
    }
    // inisialisasi tampilan berdasarkan data lama
    toggleInput();
    tipeFile.addEventListener('change', toggleInput);
    tipeLink.addEventListener('change', toggleInput);

    // Summernote
    if (typeof $ !== 'undefined' && $.fn.summernote) {
        $('#summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    }

    // kirim via AJAX persis seperti versi tambah:
    $(document).on('submit', '#form-dokumen', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        // overwrite description
        if ($.fn.summernote) formData.set('description', $('#summernote').summernote('code'));

        if (tipeFile.checked) formData.set('tipe_dokumen', 'file');
        if (tipeLink.checked) formData.set('tipe_dokumen', 'link');

        $.ajax({
            url: this.action,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            beforeSend() {
                Swal.fire({title:'Menyimpan...',allowOutsideClick:false,showConfirmButton:false,didOpen:()=>Swal.showLoading()});
            },
            success(res){
                Swal.close();
                if (res.status) {
                    Swal.fire({icon:'success',title:'Tersimpan',text:res.message}).then(()=>{
                        window.location.href = "{{ route('dokumen.preview', [$kriteria_nama, $jenis_list]) }}";
                    });
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error(xhr){
                Swal.close();
                Swal.fire('Gagal', 'Terjadi kesalahan.', 'error');
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endpush
@endsection
