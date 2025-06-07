@extends('layouts.template')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Dokumen {{ $label }}</h2>
            <p class="text-muted">Untuk Kriteria <strong>{{ strtoupper($kriteria_nama) }}</strong></p>
        </div>
    </div>

    {{-- Tabel dokumen --}}
    <div class="table-responsive shadow-sm rounded mb-4">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama Dokumen</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dokumen as $item)
                    <tr>
                        <td>{{ $item->nama_dokumen }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-warning btn-sm me-1"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">Belum ada dokumen.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Form Tambah Dokumen --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
            Tambah Dokumen Baru
        </div>
        <div class="card-body">
            <form action="{{ url('/dokumen/' . $kriteria_nama . '/' . strtolower(substr($label, 0, 1))) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                    <input type="text" name="nama_dokumen" id="nama_dokumen" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="isi_dokumen" class="form-label">Isi Dokumen</label>
                    <textarea name="isi_dokumen" id="isi_dokumen" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-1"></i> Simpan Dokumen
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('isi_dokumen', {
            height: 300,
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endpush
w