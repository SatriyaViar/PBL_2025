@extends('layouts.template')

@section('content')
{{-- Daftar Dokumen --}}
<div class="card shadow-sm mt-4">
    <div class="card-header bg-primary text-white fw-bold">
        Daftar Dokumen
    </div>
    <div class="card-body">
        @if (count($dokumenList ?? []) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>Tipe</th>
                            <th>Link / Nama File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokumenList as $index => $dokumen)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{!! $dokumen->description !!}</td>
                                <td>{{ ucfirst($dokumen->tipe_dokumen) }}</td>
                                <td>
                                    @if ($dokumen->tipe_dokumen == 'link')
                                        <a href="{{ $dokumen->link }}" target="_blank">{{ $dokumen->link }}</a>
                                    @elseif ($dokumen->tipe_dokumen == 'file')
                                        <a href="{{ asset('storage/dokumen/' . $dokumen->file_pendukung) }}" target="_blank">
                                            {{ $dokumen->file_pendukung }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{-- Tambahkan tombol aksi jika diperlukan --}}
                                    <form action="{{ route('dokumen.destroy', $dokumen->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Belum ada dokumen yang ditambahkan.</p>
        @endif
    </div>
</div>

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
      <form id="form-dokumen" action="{{ url('/dokumen/' . $kriteria_nama . '/' . ($jenis_list ?? 'default') . '/store') }}"

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
                if (tipeFile && tipeFile.checked) {
                    fileGroup.style.display = 'block';
                    linkGroup.style.display = 'none';
                    // Clear link input
                    const linkInput = document.getElementById('link');
                    if (linkInput) linkInput.value = '';
                } else if (tipeLink && tipeLink.checked) {
                    fileGroup.style.display = 'none';
                    linkGroup.style.display = 'block';
                    // Clear file input
                    const fileInput = document.getElementById('file_pendukung');
                    if (fileInput) fileInput.value = '';
                }
            }

            // Add event listeners if elements exist
            if (tipeFile) tipeFile.addEventListener('change', toggleInput);
            if (tipeLink) tipeLink.addEventListener('change', toggleInput);

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
                                    // Reset form
                                    form.reset();

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
                                    break;
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
