<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kriteria</th>
            <th>Jenis Dokumen</th>
            <th>Deskripsi</th>
            <th>File / Link</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dokumen as $i => $doc)
        <tr>
            <td>{{ $i + 1 }}</td>

            {{-- Kriteria (jika relasi tidak ada, tampilkan ID saja) --}}
            <td>{{ $doc->kriteria->kriteria_nama ?? $doc->kriteria->kriteria_id }}</td>

            <td>{{ $label }}</td>

            {{-- Deskripsi (gunakan {!! !!} agar HTML dari Summernote bisa tampil) --}}
            <td>{!! $doc->description !!}</td>

            {{-- File / Link --}}
            <td>
                @if ($doc->file_pendukung)
                    <a href="{{ asset('storage/' . $doc->file_pendukung) }}" target="_blank" class="btn btn-sm btn-primary">
                        <i class="fas fa-file-pdf"></i> Lihat File
                    </a>
                @elseif ($doc->link)
                    <a href="{{ $doc->link }}" target="_blank" class="btn btn-sm btn-info">
                        <i class="fas fa-link"></i> Kunjungi Link
                    </a>
                @else
                    <span class="text-muted">Tidak ada file/link</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">Tidak ada dokumen tersedia.</td>
        </tr>
        @endforelse
    </tbody>
</table>
