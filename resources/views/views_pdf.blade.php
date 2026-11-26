
<!DOCTYPE html>
<html>
<head>
    <title>Laporan EcoLearn</title>
</head>
<body>

    <h2 style="text-align: center;">Laporan EcoLearn</h2>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
