<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Dokumen - {{ $label }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
        }
        .dokumen-section {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .dokumen-title {
            font-size: 18px;
            font-weight: bold;
        }
        .dokumen-description {
            font-size: 16px;
            margin: 10px 0;
        }
        .dokumen-footer {
            font-size: 12px;
            color: gray;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $label }}</h1>
            <p>Berikut adalah semua dokumen yang terkait dengan kriteria {{ $kriteria_nama }}</p>
        </div>

        @foreach ($dokumen as $item)
            <div class="dokumen-section">
                <div class="dokumen-title">{{ $item->description }}</div>
                @if($item->file_pendukung)
                    <p><strong>File:</strong> <a href="{{ asset('storage/' . $item->file_pendukung) }}" target="_blank">{{ basename($item->file_pendukung) }}</a></p>
                @endif
                @if($item->link)
                    <p><strong>Link:</strong> <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a></p>
                @endif
            </div>
        @endforeach

        <div class="dokumen-footer">
            <p>Generated on {{ now()->format('d M Y, H:i') }}</p>
        </div>
    </div>
</body>
</html>
