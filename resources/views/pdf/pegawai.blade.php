<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Pegawai</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; font-weight: bold; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Daftar Pegawai Bapelkum</h2>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Pangkat/Gol</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pegawai as $index => $p)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $p->nip }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->pangkat }} ({{ $p->golongan }})</td>
                <td>{{ $p->jabatan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>