@if (count($kriteriaList) > 0)
    @foreach ($kriteriaList as $kriteria)
        <a href="{{ route('ppep.index', $kriteria->kriteria_id) }}"
           class="collapse-item">
            {{ $kriteria->kriteria_nama }}
        </a>
    @endforeach
@else
    <p class="text-muted small px-3">Belum ada kriteria.</p>
@endif
