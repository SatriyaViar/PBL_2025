<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dokumen PPEPP - {{ $kriteria->kriteria_nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            font-size: 20px;
            margin-bottom: 30px;
        }
        .sub-header {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }
        .dokumen-section {
            margin-bottom: 25px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .dokumen-title {
            font-size: 14px;
            font-weight: bold;
        }
        .dokumen-description {
            font-size: 13px;
            margin: 8px 0;
        }
        .section-label {
            font-size: 16px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }
        .dokumen-footer {
            font-size: 11px;
            color: gray;
            text-align: center;
            margin-top: 40px;
        }
        a {
            color: #000;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Preview Dokumen PPEPP</h2>
    </div>

    <div class="sub-header">
        <p>Semua dokumen yang terkait dengan kriteria: <strong>{{ $kriteria->kriteria_nama }}</strong></p>
    </div>

    @php
        $sections = [
            'Penetapan' => $dokumen_penetapan,
            'Pelaksanaan' => $dokumen_pelaksanaan,
            'Evaluasi' => $dokumen_evaluasi,
            'Pengendalian' => $dokumen_pengendalian,
            'Peningkatan' => $dokumen_peningkatan,
        ];
    @endphp

    @foreach ($sections as $label => $dokumens)
        <div class="section-label">{{ $label }}</div>

        @if ($dokumens->isEmpty())
            <p><i>Tidak ada dokumen pada bagian ini.</i></p>
        @else
            @foreach ($dokumens as $item)
                <div class="dokumen-section">
                    <div class="dokumen-title">{!! $item->description !!}</div>
                    @if($item->file_pendukung)
                        <div class="dokumen-description"><strong>File:</strong> {{ basename($item->file_pendukung) }}</div>
                    @endif
                    @if($item->link)
                        <div class="dokumen-description"><strong>Link:</strong> {{ $item->link }}</div>
                    @endif
                </div>
            @endforeach
        @endif
    @endforeach

    <div class="dokumen-footer">
        <p>Generated on {{ now()->format('d M Y, H:i') }}</p>
    </div>

</body>
</html>
