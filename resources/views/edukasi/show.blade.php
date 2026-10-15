<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $edukasi->judul_edukasi }} - EcoLearn</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7f6;
            color: #333;
            min-height: 100vh;
        }

        .navbar {
            background: #2e7d32;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .meta {
            display: flex;
            gap: 15px;
            color: #777;
            font-size: 13px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        h1 {
            color: #2e7d32;
            font-size: 26px;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .content {
            font-size: 15px;
            line-height: 1.8;
            color: #444;
            white-space: pre-wrap;
            margin-bottom: 35px;
        }

        .actions {
            display: flex;
            gap: 12px;
            border-top: 1px solid #eee;
            padding-top: 25px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: background 0.2s;
        }

        .btn-primary {
            background: #2e7d32;
            color: white;
        }

        .btn-primary:hover {
            background: #256628;
        }

        .btn-warning {
            background: #fbc02d;
            color: #333;
        }

        .btn-warning:hover {
            background: #f9a825;
        }

        .btn-danger {
            background: #d32f2f;
            color: white;
        }

        .btn-danger:hover {
            background: #b71c1c;
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #444;
        }

        .btn-secondary:hover {
            background: #d5d5d5;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>🌿 EcoLearn</h2>
        <div>
            <a href="{{ route('edukasi.index') }}">← Kembali ke Katalog</a>
            @include('partials.logout')
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h1>{{ $edukasi->judul_edukasi }}</h1>

            <div class="meta">
                <span>📅 Diunggah: {{ \Carbon\Carbon::parse($edukasi->tanggal_upload ?? $edukasi->created_at)->format('d F Y, H:i') }} WIB</span>
                @if ($edukasi->admin)
                    <span>👤 Penulis: {{ $edukasi->admin->nama_admin }}</span>
                @endif
            </div>

            <div class="content">
{{ $edukasi->isi_materi }}
            </div>

            <div class="actions">
                <a href="{{ route('edukasi.index') }}" class="btn btn-secondary">← Kembali</a>
                <a href="{{ route('edukasi.edit', $edukasi->id_edukasi) }}" class="btn btn-warning">Edit Materi</a>

                <form action="{{ route('edukasi.destroy', $edukasi->id_edukasi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Materi</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
