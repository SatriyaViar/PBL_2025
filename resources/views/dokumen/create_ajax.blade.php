@extends('layouts.template')

@section('content')
<div class="container py-4">
    <h3>Tambah Dokumen {{ $label }}</h3>

    <form action="{{ url('/dokumen/' . $kriteria_nama . '/' . strtolower($label)) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="kriteria_id" value="{{ $kriteria_id }}">

        <div class="mb-3">
            <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
            <input type="text" name="nama_dokumen" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">File Pendukung</label>
            <input type="file" name="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
