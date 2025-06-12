@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ $page->title ?? 'Daftar Penelitian Dosen' }}</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Penelitian Dosen</h6>
                <button class="btn btn-sm btn-success"
                    onclick="modalAction('{{ url('penelitian-dosen/create') }}')">Tambah</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table_master">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Judul Penelitian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Container -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Konten akan di-load via AJAX -->
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function modalAction(url) {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        // delegasi event karena formCreate dimuat lewat AJAX
        $(document).on('submit', '#formCreate', function(e) {
            e.preventDefault();

            let form = $(this);
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(res) {
                    toastr.success(res.message || 'Berhasil disimpan');
                    $('#myModal').modal('hide');
                    $('#table_master').DataTable().ajax.reload();
                },
                error: function(err) {
                    $('.text-danger').text('');
                    if (err.responseJSON?.errors) {
                        $.each(err.responseJSON.errors, function(field, messages) {
                            $('#error-' + field).text(messages[0]);
                        });
                    }
                    toastr.error('Terjadi kesalahan saat menyimpan');
                }
            });
        });

        $(document).ready(function() {
            $('#table-penelitian').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('penelitian-dosen/list/data') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'dosen.nama_dosen',
                        name: 'dosen.nama_dosen'
                    },
                    {
                        data: 'penelitian.judul_penelitian',
                        name: 'penelitian.judul_penelitian'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
