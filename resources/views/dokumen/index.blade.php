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
                        <input class="form-check-input" type="checkbox" name="tipe_dokumen[]" id="tipe_file" value="file">
                        <label class="form-check-label" for="tipe_file">Upload File</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tipe_dokumen[]" id="tipe_link" value="link">
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
                fileGroup.style.display = tipeFile.checked ? 'block' : 'none';
                linkGroup.style.display = tipeLink.checked ? 'block' : 'none';
            }


            tipeFile.addEventListener('change', toggleInput);
            tipeLink.addEventListener('change', toggleInput);
            toggleInput(); // initial call


            toggleInput(); // inisialisasi saat halaman load

            // Init Summernote
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

            // Handle form submit AJAX - PERBAIKAN
            $(document).on('submit', '#form-dokumen', function(e) {
                e.preventDefault();

                // Clear previous error messages
                $('.error-text').text('');
                $('.is-invalid').removeClass('is-invalid');

                const form = this;
                const formData = new FormData(form);

                // Pastikan konten Summernote ter-capture dengan benar
                if (typeof $ !== 'undefined' && $.fn.summernote) {
                    const summernoteContent = $('#summernote').summernote('code');
                    console.log('Summernote content:', summernoteContent); // Debug log
                    formData.set('description', summernoteContent);
                }

                // Set tipe dokumen berdasarkan radio button yang dipilih
                const tipeFile = document.getElementById('tipe_file');
                const tipeLink = document.getElementById('tipe_link');

                if (tipeFile && tipeFile.checked) {
                    formData.set('tipe_dokumen', 'file');
                } else if (tipeLink && tipeLink.checked) {
                    formData.set('tipe_dokumen', 'link');
                }

                // Debug: lihat semua data yang akan dikirim
                console.log('FormData contents:');
                for (let [key, value] of formData.entries()) {
                    console.log(key, ':', value);
                }

                $.ajax({
                    url: form.action,
                    method: form.method || 'POST',
                    data: formData,
                    processData: false, // Penting untuk file upload
                    contentType: false, // Penting untuk file upload
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    beforeSend: function() {
                        // Tampilkan loading
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Menyimpan...',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        }
                    },
                    success: function(response) {
                        if (typeof Swal !== 'undefined') {
                            Swal.close();
                        }

                        console.log('Success response:', response); // Debug log

                        if (response.status === true || response.status === 'true') {
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message || 'Data berhasil disimpan'
                                }).then(() => {
                                    if (response.redirect) {
                                        window.location.href = response.redirect;
                                    } else {
                                        // Fallback jika redirect tidak dikembalikan
                                        window.location.reload();
                                    }

                                    // Reset Summernote
                                    if (typeof $ !== 'undefined' && $.fn.summernote) {
                                        $('#summernote').summernote('code', '');
                                    }

                                    // Reset tampilan input file/link
                                    toggleInput();

                                    // Optional: reload page atau redirect
                                    // window.location.reload();
                                });
                            } else {
                                alert(response.message || 'Data berhasil disimpan');
                                form.reset();
                                if (typeof $ !== 'undefined' && $.fn.summernote) {
                                    $('#summernote').summernote('code', '');
                                }
                                toggleInput();
                            }
                        } else {
                            // Handle validation errors
                            if (response.msgField) {
                                displayValidationErrors(response.msgField);
                            }

                            if (typeof Swal !== 'undefined') {
                                let errorMessage = response.message ||
                                    'Terjadi kesalahan validasi';

                                if (response.msgField) {
                                    errorMessage = 'Periksa kembali data yang diinput';
                                }

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi Gagal',
                                    text: errorMessage
                                });
                            } else {
                                alert(response.message || 'Terjadi kesalahan validasi');
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        if (typeof Swal !== 'undefined') {
                            Swal.close();
                        }

                        console.error('AJAX Error:', xhr.responseText); // Debug log
                        console.error('Status:', status);
                        console.error('Error:', error);

                        let errorMessage = 'Terjadi kesalahan saat menyimpan data.';

                        try {
                            const response = JSON.parse(xhr.responseText);

                            if (response.message) {
                                errorMessage = response.message;
                            }

                            if (response.msgField) {
                                displayValidationErrors(response.msgField);
                            }
                        } catch (e) {
                            console.error('Error parsing response:', e);

                            // Handle different HTTP status codes
                            switch (xhr.status) {
                                case 422:
                                    errorMessage = 'Data yang diinput tidak valid';
                                    break;
                                case 500:
                                    errorMessage = 'Terjadi kesalahan server';
                                    break;
                                case 404:
                                    errorMessage = 'Halaman tidak ditemukan';
                           e         break;
                                case 403:
                                    errorMessage = 'Akses ditolak';
                                    break;
                            }
                        }

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: errorMessage
                            });
                        } else {
                            alert(errorMessage);
                        }
                    }
                });
            });

            // Function to display validation errors
            function displayValidationErrors(errors) {
                $.each(errors, function(field, messages) {
                    const fieldElement = $(`[name="${field}"]`);

                    if (fieldElement.length > 0) {
                        // Add invalid class
                        fieldElement.addClass('is-invalid');

                        // Find or create error message element
                        let errorElement = fieldElement.closest('.form-group').find('.invalid-feedback');
                        if (errorElement.length === 0) {
                            errorElement = fieldElement.closest('.form-group').find('.error-text');
                        }

                        if (errorElement.length > 0) {
                            errorElement.text(messages.join(', '));
                        } else {
                            // Create error element if not exists
                            fieldElement.after(
                                `<div class="invalid-feedback">${messages.join(', ')}</div>`);
                        }
                    }
                });
            }

            // Remove validation errors on input change
            $(document).on('input change', '.is-invalid', function() {
                $(this).removeClass('is-invalid');
                $(this).closest('.form-group').find('.invalid-feedback, .error-text').text('');
            });
        });
    </script>
@endsection
