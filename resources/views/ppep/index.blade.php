@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <a href="{{ route('dokumen.generatePDF', ['kriteria_nama' => $kriteria_nama]) }}" target="_blank" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Generate PDF Seluruh Dokumen
            </a>
        </div>
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
                                    <a href="{{ url('/dokumen/' . $kriteria_nama . '/' . $jenis_kode . '/preview') }}"
                                        class="btn btn-info btn-sm btn-block preview-btn"
                                        data-kriteria_nama="{{ $kriteria_nama }}" data-jenis_list="{{ $jenis_kode }}">
                                        <i class="fas fa-eye"></i> Preview
                                    </a>


                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('dokumen.generatePDF', ['kriteria_nama' => $kriteria_nama]) }}" target="_blank">
                    <i class="fas fa-file-pdf"></i> Generate PDF
                </a>

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

    @push('js')
        <script>
            $(document).ready(function() {
                $('.preview-btn').on('click', function(e) {
                    e.preventDefault();

                    const url = $(this).attr('href');

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            $('#previewDokumenContent').html(data);
                            $('#previewModal').modal('show');
                        },
                        error: function(xhr) {
                            $('#previewDokumenContent').html(
                                '<div class="alert alert-danger">Gagal memuat data dokumen.</div>'
                            );
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
            $(document).on('submit', '.form-delete-dokumen', function(e) {
                e.preventDefault();

                const form = $(this);
                const url = form.attr('action');
                const token = form.find('input[name="_token"]').val();
                const method = form.find('input[name="_method"]').val();
                const kriteria = form.data('kriteria');
                const jenis = form.data('jenis_list')
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: token,
                                _method: method,
                            },
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: response.message,
                                        icon: 'success',
                                        timer: 1500,
                                        showConfirmButton: false
                                    });
                                    console.log(jenis);

                                    // Refresh isi modal
                                    $.get(`/dokumen/${kriteria}/${jenis}/preview`, function(data) {

                                        $('#previewDokumenContent').html(data);
                                    });
                                } else {
                                    Swal.fire('Gagal', response.message, 'error');
                                }
                            },

                            error: function(xhr) {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus dokumen.',
                                    'error');
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
