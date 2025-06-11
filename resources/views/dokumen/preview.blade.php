<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Dokumen</th>
            <th>Deskripsi</th>
            <th>File</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dokumen as $i => $doc)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $doc->nama }}</td>
            <td>{{ $doc->deskripsi }}</td>
            <td>
                <a href="{{ asset('storage/dokumen/' . $doc->file) }}" target="_blank" class="btn btn-sm btn-primary">
                    <i class="fas fa-file-pdf"></i> Lihat
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">Tidak ada dokumen tersedia.</td>
        </tr>
        @endforelse
    </tbody>
</table>
