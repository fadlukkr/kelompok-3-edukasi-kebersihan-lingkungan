<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Materi Edukasi - EcoLearn</title>
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
            margin-right: 15px;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header-section h1 {
            color: #2e7d32;
            font-size: 24px;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
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

        .btn-info {
            background: #0288d1;
            color: white;
        }

        .btn-info:hover {
            background: #0277bd;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Alert Hasil Operasi */
        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: #f8faf9;
            border-bottom: 2px solid #e0e0e0;
        }

        th {
            padding: 15px 20px;
            font-size: 13px;
            text-transform: uppercase;
            color: #666;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            vertical-align: middle;
        }

        tr:hover {
            background: #fafbfb;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #888;
        }

        .empty-state p {
            margin-top: 10px;
            font-size: 15px;
        }

        .pagination {
            padding: 20px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>🌿 EcoLearn</h2>
        <div>
            <a href="{{ auth('admin')->check() ? route('admin.dashboard') : route('dashboard') }}">Dashboard</a>
            <a href="{{ route('edukasi.index') }}">Materi Edukasi</a>
            @include('partials.logout')
        </div>
    </div>

    <div class="container">
        <!-- Notifikasi / Penanganan Hasil Operasi -->
        @if (session('success'))
            <div class="alert alert-success">
                <span>✅ {{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <span>⚠️ {{ session('error') }}</span>
            </div>
        @endif

        <div class="header-section">
            <div>
                <h1>Katalog Materi Edukasi</h1>
                <p style="color: #666; font-size: 14px; margin-top: 4px;">Kelola materi dan panduan kebersihan lingkungan untuk warga.</p>
            </div>
            <a href="{{ route('edukasi.create') }}" class="btn btn-primary">
                + Tambah Materi Baru
            </a>
        </div>

        <div class="card">
            @if ($materi->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 250px;">Judul Materi</th>
                            <th>Ringkasan Isi Materi</th>
                            <th style="width: 130px;">Tgl Upload</th>
                            <th style="width: 180px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materi as $index => $item)
                            <tr>
                                <td>{{ $materi->firstItem() + $index }}</td>
                                <td><strong>{{ $item->judul_edukasi }}</strong></td>
                                <td>{{ Str::limit($item->isi_materi, 90, '...') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_upload ?? $item->created_at)->format('d M Y') }}</td>
                                <td style="text-align: center;">
                                    <div class="actions" style="justify-content: center;">
                                        <a href="{{ route('edukasi.show', $item->id_edukasi) }}" class="btn btn-info btn-sm">Lihat</a>
                                        <a href="{{ route('edukasi.edit', $item->id_edukasi) }}" class="btn btn-warning btn-sm">Edit</a>
                                        
                                        <!-- Form Hapus Materi dengan Penanganan Konfirmasi -->
                                        <form action="{{ route('edukasi.destroy', $item->id_edukasi) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi \'{{ addslashes($item->judul_edukasi) }}\'? Data yang dihapus tidak dapat dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $materi->links() }}
                </div>
            @else
                <div class="empty-state">
                    <h3>Belum Ada Materi Edukasi</h3>
                    <p>Materi edukasi lingkungan masih kosong. Silakan tambahkan materi pertama Anda.</p>
                    <div style="margin-top: 20px;">
                        <a href="{{ route('edukasi.create') }}" class="btn btn-primary">+ Tambah Materi Sekarang</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

</body>
</html>
