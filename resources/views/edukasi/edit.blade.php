<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi Edukasi - EcoLearn</title>
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
            max-width: 750px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .card h1 {
            color: #2e7d32;
            font-size: 22px;
            margin-bottom: 8px;
        }

        .card p.desc {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #2e7d32;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.15);
        }

        .is-invalid {
            border-color: #d32f2f;
            background-color: #fff8f8;
        }

        .invalid-feedback {
            color: #d32f2f;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: background 0.2s;
            text-align: center;
        }

        .btn-primary {
            background: #2e7d32;
            color: white;
        }

        .btn-primary:hover {
            background: #256628;
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #444;
        }

        .btn-secondary:hover {
            background: #d5d5d5;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h2>🌿 EcoLearn</h2>
        <div>
            <a href="{{ route('edukasi.index') }}">← Kembali ke Daftar</a>
            @include('partials.logout')
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h1>Edit / Perbarui Materi Edukasi</h1>
            <p class="desc">Perbarui konten edukasi yang sudah tersimpan dengan validasi judul dan isi materi.</p>

            <!-- Penanganan Error Hasil Operasi -->
            @if (session('error'))
                <div class="alert-danger">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('edukasi.update', $edukasi->id_edukasi) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Judul Materi -->
                <div class="form-group">
                    <label for="judul_edukasi">Judul Materi <span style="color: #d32f2f;">*</span></label>
                    <input
                        type="text"
                        id="judul_edukasi"
                        name="judul_edukasi"
                        class="form-control @error('judul_edukasi') is-invalid @enderror"
                        placeholder="Masukkan judul materi"
                        value="{{ old('judul_edukasi', $edukasi->judul_edukasi) }}"
                        required
                    >
                    @error('judul_edukasi')
                        <span class="invalid-feedback">⚠️ {{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Isi Konten Materi -->
                <div class="form-group">
                    <label for="isi_materi">Isi Materi Edukasi <span style="color: #d32f2f;">*</span></label>
                    <textarea
                        id="isi_materi"
                        name="isi_materi"
                        rows="9"
                        class="form-control @error('isi_materi') is-invalid @enderror"
                        placeholder="Tuliskan isi materi secara mendalam (minimal 10 karakter)..."
                        required
                    >{{ old('isi_materi', $edukasi->isi_materi) }}</textarea>
                    @error('isi_materi')
                        <span class="invalid-feedback">⚠️ {{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        🔄 Perbarui Materi
                    </button>
                    <a href="{{ route('edukasi.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
