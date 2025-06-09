@extends('layouts.template')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Dokumen {{ $label }}</h2>
            <p class="text-muted">Untuk Kriteria <strong>{{ strtoupper($kriteria_nama) }}</strong></p>
        </div>
    </div>

    {{-- Form Dokumen --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
            Tambah Dokumen Baru
        </div>
        <div class="card-body">
            <form id="form-dokumen" action="{{ url('/dokumen/' . $kriteria_nama . '/' . $jenis_list . '/store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Isi Dokumen</label>
                    <textarea name="description" id="summernote" class="form-control" placeholder="description" rows="10"></textarea>
                </div>

                {{-- Pilihan tipe dokumen --}}
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipe_dokumen" id="tipe_file" value="file"
                            checked>
                        <label class="form-check-label" for="tipe_file">Upload File</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipe_dokumen" id="tipe_link" value="link">
                        <label class="form-check-label" for="tipe_link">Input Link</label>
                    </div>
                </div>

                {{-- Input untuk file --}}
                <div class="mb-3" id="input-file-group">
                    <label for="file_pendukung" class="form-label">File Pendukung</label>
                    <input type="file" name="file_pendukung" id="file_pendukung" class="form-control">
                </div>

                {{-- Input untuk link --}}
                <div class="mb-3" id="input-link-group" style="display: none;">
                    <label for="link" class="form-label">Link Pendukung</label>
                    <input type="url" name="link" id="link" class="form-control"
                        placeholder="https://contoh.com">
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Simpan Dokumen
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipeFile = document.getElementById('tipe_file');
            const tipeLink = document.getElementById('tipe_link');
            const fileGroup = document.getElementById('input-file-group');
            const linkGroup = document.getElementById('input-link-group');

            function toggleInput() {
                if (tipeFile.checked) {
                    fileGroup.style.display = 'block';
                    linkGroup.style.display = 'none';
                    // Clear link input
                    document.getElementById('link').value = '';
                } else if (tipeLink.checked) {
                    fileGroup.style.display = 'none';
                    linkGroup.style.display = 'block';
                    // Clear file input
                    document.getElementById('file_pendukung').value = '';
                }
            }

            tipeFile.addEventListener('change', toggleInput);
            tipeLink.addEventListener('change', toggleInput);

            toggleInput(); // inisialisasi saat halaman load

            // Init Summernote
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
        });

        // Handle form submit AJAX - PERBAIKAN
        $('#form-dokumen').on('submit', function(e) {
            e.preventDefault();
            $('.error-text').text('');

            const form = this;
            const formData = new FormData(form);

            // Pastikan konten Summernote ter-capture dengan benar
            const summernoteContent = $('#summernote').summernote('code');
            console.log('Summernote content:', summernoteContent); // Debug log

            formData.set('description', summernoteContent);

            // Debug: lihat semua data yang akan dikirim
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }

            $.ajax({
                url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function() {
                    // Tampilkan loading
                    Swal.fire({
                        title: 'Menyimpan...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    Swal.close();

                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then(() => {
                            // Reset form
                            form.reset();
                            $('#summernote').summernote('code', '');
                            toggleInput(); // reset tampilan input file/link
                        });
                    } else {
                        // Handle validation errors
                        if (response.msgField) {
                            let errorMessage = '';
                            $.each(response.msgField, function(field, messages) {
                                errorMessage += messages.join(', ') + '\n';
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                text: errorMessage
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message || 'Terjadi kesalahan'
                            });
                        }
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    console.error('AJAX Error:', xhr.responseText); // Debug log

                    let errorMessage = 'Terjadi kesalahan saat menyimpan data.';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: errorMessage
                    });
                }
            });
        });
    </script>
@endsection
