@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h4 class="card-title font-weight-bold">{{ $page->title }}</h4>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="level_id">Filter Level Pengguna:</label>
                <select class="form-control" id="level_id" name="level_id">
                    <option value="">- Semua -</option>
                    <option value="1">Admin</option>
                    <option value="2">Reviewer</option>
                    <option value="3">Peneliti</option>
                </select>
                <small class="form-text text-muted">Pilih untuk memfilter berdasarkan level</small>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover table-sm dt-responsive nowrap" id="table_verifikasi" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Surat Tugas</th>
                    <th>Judul Penelitian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                    <tr>
                    <td>{{ $i }}</td>
                    <td>ST-2025-0{{ $i }}</td>
                    <td>Judul Penelitian Contoh {{ $i }}</td>
                    <td>
                        @php
                        $status = 0;
                        @endphp
                        @if($status == 1)
                        <span class="badge badge-success"><i class="fas fa-fw fa-check"></i> Terverifikasi</span>
                        @else
                        <span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> Belum Terverifikasi</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info btn-preview" data-file-url="{{ asset('dummy.pdf') }}"><i class="fas fa-fw fa-eye"></i> Lihat</button>
                        @if($status == 0)
                        <button class="btn btn-sm btn-warning"><i class="fas fa-fw fa-check"></i> Verifikasi</button>
                        @endif
                    </td>
                    </tr>
                    @endfor
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Preview PDF -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdfFrame" src="" width="100%" height="600px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#table_verifikasi').DataTable({
            responsive: true,
            pageLength: 5,
        });

        $('#level_id').on('change', function() {
            const level = $(this).val();
            table.search(level).draw();
        });

        // Preview PDF modal
        $('.btn-preview').on('click', function() {
            console.log('testing');
            const fileUrl = $(this).data('file-url');
            console.log(fileUrl);
            
            $('#pdfFrame').attr('src', fileUrl);
            $('#previewModal').modal('show');
        });
    });
</script>
@endsection