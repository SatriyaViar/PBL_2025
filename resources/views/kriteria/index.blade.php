@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h4 class="card-title bold">{{ $page->title }}</h4>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('kriteria/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah
                    Kriteria</button>
            </div>
        </div>
        <div class="card-body">
            @if (@session('succses'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('erorr') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm dt-responsive nowrap" id="table_kriteria"
                style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kriteria</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%"></div>
@endsection


@push('css')
@endpush


@push('js')
    <script>
        function  modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
        var dataKriteria
        $(document).ready(function() {
            dataKriteria = $('#table_kriteria').DataTable({
                responsive: true,
                // serverSide: true, jika ingin menggunakan server side processing 
                serverSide: true,
                ajax: {
                    "url": "{{ url('kriteria/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [{ // nomor urut dari laravel datatable addIndexColumn() 
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    data: "kriteria_nama",
                    className: "",
                    // orderable: true, jika ingin kolom ini bisa diurutkan  
                    orderable: true,
                    // searchable: true, jika ingin kolom ini bisa dicari 
                    searchable: true
                }, {
                    data: "kriteria_link",
                    className: "",
                    orderable: true,
                    searchable: true
                }, {
                    data: "action",
                    className: "",
                    orderable: false,
                    searchable: false
                }]
            });
            $('#kriteria_id').on('change', function() {
                dataKriteria.ajax.reload();
            });
        });
    </script>
@endpush
