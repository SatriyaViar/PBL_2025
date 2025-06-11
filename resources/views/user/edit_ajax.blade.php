@empty($user)
    <!-- Error message remains the same -->
@else
    <form action="{{ url('/user/' . $user->user_id . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Level Pengguna</label>
                        <select name="level_id" id="level_id" class="form-control" required>
                            <option value="">- Pilih Level -</option>
                            @foreach($level as $l)
                                <option {{ ($l->level_id == $user->level_id) ? 'selected' : '' }} value="{{ $l->level_id }}">
                                    {{ $l->level_name }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-level_id" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input value="{{ $user->username }}" type="text" name="username" id="username" class="form-control"
                            required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input value="{{ $user->name }}" type="text" name="name" id="name" class="form-control" required>
                        <small id="error-name" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>NIDN</label>
                        <input value="{{ $user->nidn }}" type="text" name="nidn" id="nidn" class="form-control">
                        <small id="error-nidn" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{ $user->email }}" type="email" name="email" id="email" class="form-control">
                        <small id="error-email" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small class="form-text text-muted">Abaikan jika tidak ingin ubah password</small>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function () {
            $("#form-edit").validate({
                rules: {
                    level_id: { required: true, number: true },
                    username: { required: true, minlength: 3, maxlength: 20 },
                    name: { required: true, minlength: 3, maxlength: 100 },
                    nidn: { minlength: 5, maxlength: 30 },
                    email: { email: true },
                    password: { minlength: 6, maxlength: 20 }
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: form.action,
                        type: 'PUT',
                        data: $(form).serialize(),
                        success: function (response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataUser.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function (prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        }); 
    </script>
@endempty