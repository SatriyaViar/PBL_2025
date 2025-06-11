@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $page->title }}</h1>
        </div>

        @if ($kriteria_nama !== 'Semua')
            <div class="row">
                @foreach ($jenis_list as $jenis_kode => $jenis)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-{{ $jenis['color'] }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jenis['title'] }}</div>
                                        <div
                                            class="text-xs font-weight-bold text-{{ $jenis['color'] }} text-uppercase mb-1">
                                            {{ $page->title }} - {{ $jenis_kode }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas {{ $jenis['icon'] }} fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <div class="mt-3">

                                </div>
                                <div class="mt-3">
                                    <a href="{{ url('/dokumen/' . $kriteria_nama . '/' . $jenis_kode) }}"
                                        class="btn btn-{{ $jenis['color'] }} btn-sm btn-block">
                                        <i class="fas fa-plus"></i> Tambah Dokumen
                                    </a>
                                    <button class="btn btn-{{ $jenis['color'] }} btn-sm btn-block preview-btn"
                                        data-toggle="modal" data-target="#previewModal"
                                        data-kriteria="{{ $kriteria_nama }}" data-jenis="{{ $jenis_kode }}"
                                        data-title="{{ $jenis['title'] }}">
                                        <i class="fas fa-eye"></i> Preview Dokumen
                                    </button>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Silakan pilih kriteria dari menu sidebar.
            </div>
        @endif
    </div>
    <!-- Modal Preview Dokumen -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="previewModalLabel">Preview Dokumen</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="previewDokumenContent">
                        <p class="text-muted">Memuat dokumen...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            $('.preview-btn').on('click', function() {
                const kriteria = $(this).data('kriteria');
                const jenis = $(this).data('jenis');
                const title = $(this).data('title');

                $('#previewModalLabel').text(`Preview Dokumen - ${title}`);
                $('#previewDokumenContent').html('<p class="text-muted">Memuat dokumen...</p>');

                $.ajax({
                    url: `/dokumen/preview/${kriteria}/${jenis}`,
                    type: 'GET',
                    success: function(data) {
                        $('#previewDokumenContent').html(data);
                    },
                    error: function() {
                        $('#previewDokumenContent').html(
                            '<div class="alert alert-danger">Gagal memuat data dokumen.</div>');
                    }
                });
            });
        </script>
    @endpush

@endsection
