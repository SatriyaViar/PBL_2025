@empty($penelitianDosen)
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Errors!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="fas fa-ban"></i> Errors !!!</h5>
                    No data on lecturers was found in the study.
                </div>
                <a href="{{ route('penelitian.index') }}" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>
@else
    <form id="form-delete" action="{{ route('penelitian.destroy', $penelitianDosen->id_penelitian_dosen) }}" method="post">
        @csrf
        @method('DELETE')

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content shadow">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">Remove Lecturer from Research</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="fas fa-exclamation-triangle"></i> Confirmation !!!</h5>
                        Are you sure you want to remove the following lecturer from the research?
                    </div>

                    <table class="table table-bordered table-striped table-sm">
                        <tr>
                            <th class="text-end col-4">Lecturer Name</th>
                            <td class="col-8">{{ $penelitianDosen->dosen->name ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">Research Title</th>
                            <td>{{ $penelitianDosen->penelitian->judul_penelitian ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">No Assignment Letter</th>
                            <td>{{ $penelitianDosen->penelitian->no_surat_tugas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">Status</th>
                            <td>{{ ucfirst($penelitianDosen->status) }}</td>
                        </tr>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function () {
            $('#form-delete').validate({
                rules: {},
                submitHandler: function (form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function (res, textStatus, xhr) {
                            if (xhr.status == 200) {
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
@endempty
