<form id="form-edit" action="{{ route('penelitian.update', $penelitianDosen->id_penelitian_dosen) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Research Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- No Surat Tugas --}}
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">No Assignment Letter</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="no_surat_tugas"
                            value="{{ $penelitianDosen->penelitian->no_surat_tugas }}" required>
                        <small id="error-no_surat_tugas" class="text-danger error-text"></small>
                    </div>
                </div>

                {{-- Judul Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Research Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="judul_penelitian"
                            value="{{ $penelitianDosen->penelitian->judul_penelitian }}" required>
                        <small id="error-judul_penelitian" class="text-danger error-text"></small>
                    </div>
                </div>

                {{-- Pendanaan Internal --}}
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Internal Funding</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="pendanaan_internal"
                            value="{{ $penelitianDosen->penelitian->pendanaan_internal }}">
                        <small id="error-pendanaan_internal" class="text-danger error-text"></small>
                    </div>
                </div>

                {{-- Pendanaan Eksternal --}}
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">External Funding</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="pendanaan_eksternal"
                            value="{{ $penelitianDosen->penelitian->pendanaan_eksternal }}">
                        <small id="error-pendanaan_eksternal" class="text-danger error-text"></small>
                    </div>
                </div>

                {{-- Link Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Research Links</label>
                    <div class="col-sm-9">
                        <textarea name="link_penelitian" id="link_penelitian" class="form-control summernote">{!! $penelitianDosen->penelitian->link_penelitian !!}</textarea>
                        <small id="error-link_penelitian" class="text-danger error-text"></small>
                    </div>
                </div>

                {{-- Status Penelitian --}}
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Research Status</label>
                    <div class="col-sm-9">
                        <select name="status" class="form-select" required>
                            <option value="accepted" {{ $penelitianDosen->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ $penelitianDosen->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</form>

<!-- Include Summernote CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>

<script>
    $(document).ready(function () {
        $('#link_penelitian').summernote({
            placeholder: 'Enter the research link or description',
            tabsize: 2,
            height: 200
        });

        $('#form-edit').validate({
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
