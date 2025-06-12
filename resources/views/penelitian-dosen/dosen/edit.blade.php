<form id="formEdit" action="{{ route('penelitian-dosen.update', $penelitianDosen->id_penelitian_dosen) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Research Data</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Letter Number</label>
                    <input type="text" name="no_surat_tugas" class="form-control"
                        value="{{ $penelitianDosen->penelitian->no_surat_tugas }}">
                    <small class="text-danger" id="error-no_surat_tugas"></small>
                </div>
                <div class="form-group">
                    <label>Research Title</label>
                    <input type="text" name="judul_penelitian" class="form-control"
                        value="{{ $penelitianDosen->penelitian->judul_penelitian }}">
                    <small class="text-danger" id="error-judul_penelitian"></small>
                </div>
                <div class="form-group">
                    <label>Internal Funding</label>
                    <input type="text" name="pendanaan_internal" class="form-control"
                        value="{{ $penelitianDosen->penelitian->pendanaan_internal }}">
                    <small class="text-danger" id="error-pendanaan_internal"></small>
                </div>
                <div class="form-group">
                    <label>External Funding</label>
                    <input type="text" name="pendanaan_eksternal" class="form-control"
                        value="{{ $penelitianDosen->penelitian->pendanaan_eksternal }}">
                    <small class="text-danger" id="error-pendanaan_eksternal"></small>
                </div>
                <div class="form-group">
                    <label>Research Link</label>
                    <input type="text" name="link_penelitian" class="form-control"
                        value="{{ $penelitianDosen->penelitian->link_penelitian }}">
                    <small class="text-danger" id="error-link_penelitian"></small>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="accepted" {{ $penelitianDosen->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="rejected" {{ $penelitianDosen->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <small class="text-danger" id="error-status"></small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#formEdit").validate({
            rules: {
                no_surat_tugas: { required: true },
                judul_penelitian: { required: true, minlength: 3 },
                pendanaan_internal: { required: true },
                pendanaan_eksternal: { required: true },
                link_penelitian: { required: true, url: true },
                status: { required: true }
            },
            messages: {
                link_penelitian: {
                    url: "Invalid link format!"
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function (response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Successful',
                                text: response.message
                            });
                            $('#table_master').DataTable().ajax.reload();
                        } else {
                            $('.text-danger').text('');
                            $.each(response.msgField || {}, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'An error has occurred',
                                text: response.message || 'Failed to update data!'
                            });
                        }
                    },
                    error: function (err) {
                        $('.text-danger').text('');
                        if (err.responseJSON?.errors) {
                            $.each(err.responseJSON.errors, function (field, messages) {
                                $('#error-' + field).text(messages[0]);
                            });
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'An error has occurred',
                            text: 'Failed to update data!'
                        });
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
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
