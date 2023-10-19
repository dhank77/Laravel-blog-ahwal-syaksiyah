<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Data Komplain</title>
</head>
<body>
    @php
        $tgl = date("ymdhis");
        $file_name = "komplain_$tgl.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file_name");
    @endphp
    <h4>
        Rekap Laporan Komplain Pelanggan <br/>
        Program Studi Hukum Keluarga (Ahwal Syakhshiyah) <br/>
        Universitas Muhammadiyah Makassar
    </h4>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Nama</th>
                <th>No Hp/WA</th>
                <th>Isi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $k => $d)
                <tr>
                    <td style="text-align:center;">{{ $k + 1 }}.</td>
                    <td>{{ $d->email }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->no_hp }}</td>
                    <td>{{ $d->isi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>