@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h4 class="card-title bold">{{ $page->title }}</h4>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('penelitian/dosen/create') }}')" class="btn btn-sm btn-success mt-1">Tambah Penelitian</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm dt-responsive nowrap" id="table_penelitian_dosen"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Surat Tugas</th>
                        <th>Judul Penelitian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        function deletePenelitian(id_penelitian_dosen) {
            if (confirm("Yakin ingin menghapus data penelitian ini?")) {
                $.ajax({
                    url: '/penelitian/dosen/' + id_penelitian_dosen,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert(response.message);
                        if (response.status !== false) {
                            dataPenelitianDosen.ajax.reload();
                        }
                    },
                    error: function (xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            }
        }

        var dataPenelitianDosen;
        $(document).ready(function () {
            dataPenelitianDosen = $('#table_penelitian_dosen').DataTable({
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('penelitian/dosen/list') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'penelitian.no_surat_tugas',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'penelitian.judul_penelitian',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'status',
                        className: 'text-center',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ]
            });
        });
    </script>
@endpush
