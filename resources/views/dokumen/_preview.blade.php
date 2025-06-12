<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kriteria</th>
            <th>Jenis Dokumen</th>
            <th>Deskripsi</th>
            <th>File / Link</th>
            <th>Aksi</th>
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
                {{-- File dan Link --}}
                <td class="align-middle">
                    <div class="d-flex flex-wrap gap-1">
                        @if ($doc->file_pendukung)
                            <a href="{{ asset('storage/' . $doc->file_pendukung) }}" target="_blank"
                                class="btn btn-sm btn-primary">
                                <i class="fas fa-file-alt"></i> Lihat File
                            </a>
                        @endif

                        @if ($doc->link)
                            <a href="{{ $doc->link }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-link"></i> Kunjungi Link
                            </a>
                        @endif
                    </div>

                    @if (!$doc->file_pendukung && !$doc->link)
                        <span class="text-muted fst-italic">Tidak ada file atau link</span>
                    @endif
                </td>
                <td>
                    {{-- Tombol Edit --}}
                    <a
                        href="{{ route('dokumen.edit', [
                            'kriteria' => $doc->kriteria->kriteria_nama ?? $doc->kriteria_id,
                            'jenis_list' => $jenis_list,
                            'dokumen' => $doc->pelaksanaan_id,
                        ]) }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    {{-- Tombol Hapus --}}
                    <form method="POST"
                        action="{{ route('dokumen.destroy', [$doc->kriteria->kriteria_nama, $label, $doc->pelaksanaan_id]) }}"
                        class="form-delete-dokumen" data-kriteria="{{ $doc->kriteria->kriteria_nama }}"
                        data-jenis="{{ $label }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>


                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">Tidak ada dokumen tersedia.</td>
            </tr>
        @endforelse
    </tbody>
</table>
