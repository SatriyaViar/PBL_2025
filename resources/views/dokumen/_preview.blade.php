<div class="modal-body">
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
            @if ($dokumen->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Tidak ada dokumen tersedia.</td>
                </tr>
            @else
                @foreach ($dokumen as $index => $doc)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $doc->kriteria->kriteria_nama ?? 'Tidak Ditemukan' }}</td>
                        <td>{{ $label }}</td>
                        <td>{!! $doc->description !!}</td>
                        <td>

                            @if ($doc->file_pendukung)
                                <a href="{{ asset('storage/' . $doc->file_pendukung) }}" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-file-pdf"></i> Lihat File
                                </a>
                            @endif
                            @if ($doc->link)
                                <a href="{{ $doc->link }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-link"></i> Kunjungi Link
                                </a>
                            @endif
                            @if (!$doc->file_pendukung && !$doc->link)
                                <span class="text-muted">Tidak Ada Data Pendukung</span>
                            @endif
                        </td>
                        <!-- Kolom Aksi untuk tombol Edit dan Hapus -->
                        <td>
                            <!-- Tombol Edit -->
                            <a href="{{ route('dokumen.edit', [$doc->kriteria->kriteria_nama, $label, $doc]) }}"
                                class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form method="POST"
                                action="{{ route('dokumen.destroy', [$doc->kriteria->kriteria_nama, $jenis_list, $doc->getkey()]) }}"
                                class="form-delete-dokumen" data-kriteria="{{ $doc->kriteria->kriteria_nama }}"
                                data-jenis_list="{{ $jenis_list }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
