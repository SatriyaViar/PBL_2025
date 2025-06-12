@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h4 class="card-title bold">{{ $page->title }}</h4>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('user/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Add New User</button>
            </div>
        </div>
        <div class="card-body">
            @if (@session('succses'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('erorr') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="level_id" name="level_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($level as $item)
                                    <option value="{{ $item->level_id }}">{{ $item->level_name }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Level Pengguna</small>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm dt-responsive nowrap" id="table_user"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>User Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection


@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        function deleteUser(user_id) {
            if (confirm("Yakin ingin menghapus user ini?")) {
                $.ajax({
                    url: '/user/' + user_id + '/delete_ajax',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },

                    success: function(response) {
                        alert(response.message);
                        if (response.status) {
                            dataUser.ajax.reload();
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            }
        }

        var dataUser;
        $(document).ready(function() {
            dataUser = $('#table_user').DataTable({
                responsive: true,
                serverSide: true,
                ajax: {
                    "url": "{{ url('user/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(d) {
                        d.level_id = $('#level_id').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex", // dari addIndexColumn() Laravel
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "username",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "name",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "level.level_name", // data relasi dari model
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "action",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#level_id').on('change', function() {
                dataUser.ajax.reload();
            });
        });
    </script>
@endpush
