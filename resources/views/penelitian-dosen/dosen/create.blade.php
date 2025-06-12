<form id="form-tambah" action="{{ route('penelitian.store') }}" method="post">
    @csrf

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add Research Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                {{-- No Surat Tugas --}}
                <div class="mb-3">
                    <label class="form-label">No Assignment Letter</label>
                    <input type="text" class="form-control" name="no_surat_tugas" required>
                    <small id="error-no_surat_tugas" class="form-text text-danger error-text"></small>
                </div>

                {{-- Judul Penelitian --}}
                <div class="mb-3">
                    <label class="form-label">Research Title</label>
                    <input type="text" class="form-control" name="judul_penelitian" required>
                    <small id="error-judul_penelitian" class="form-text text-danger error-text"></small>
                </div>

                {{-- Pendanaan Internal --}}
                <div class="mb-3">
                    <label class="form-label">Internal Funding</label>
                    <input type="text" class="form-control" name="pendanaan_internal">
                    <small id="error-pendanaan_internal" class="form-text text-danger error-text"></small>
                </div>

                {{-- Pendanaan Eksternal --}}
                <div class="mb-3">
                    <label class="form-label">External Funding</label>
                    <input type="text" class="form-control" name="pendanaan_eksternal">
                    <small id="error-pendanaan_eksternal" class="form-text text-danger error-text"></small>
                </div>

                {{-- Link Penelitian --}}
                <div class="mb-3">
                    <label class="form-label">Research Links</label>
                    <textarea name="link_penelitian" id="link_penelitian" class="form-control"></textarea>
                    <small id="error-link_penelitian" class="form-text text-danger error-text"></small>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</form>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

<script>
    $(document).ready(function () {
        $('#link_penelitian').summernote({
            placeholder: 'Enter the research link or description',
            tabsize: 2,
            height: 200,
        });

        $('#form-tambah').validate({
            rules: {
                no_surat_tugas: { required: true },
                judul_penelitian: { required: true },
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (res, textStatus, xhr) {
                        if (xhr.status === 200) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message
                            });
                            dataMaster.ajax.reload();
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'An error has occurred',
                            text: xhr.responseJSON?.message || 'An error has occurred!'
                        });

                        if (xhr.responseJSON?.msgField) {
                            $('.error-text').text('');
                            $.each(xhr.responseJSON.msgField, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.mb-3').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
