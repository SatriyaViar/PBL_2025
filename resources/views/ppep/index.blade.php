@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $page->title }}</h1>
        </div>

        @if($kriteria_nama !== 'Semua')
            <div class="row">
                @foreach($jenis_list as $jenis_kode => $jenis)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-{{ $jenis['color'] }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jenis['title'] }}</div>
                                        <div class="text-xs font-weight-bold text-{{ $jenis['color'] }} text-uppercase mb-1">
                                            {{ $page->title }} - {{ $jenis_kode }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas {{ $jenis['icon'] }} fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ url('/dokumen/' . $kriteria_nama . '/' . $jenis_kode) }}" 
                                       class="btn btn-{{ $jenis['color'] }} btn-sm btn-block">
                                        <i class="fas fa-arrow-right"></i> Tambah Dokumen
                                    </a>
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
@endsection