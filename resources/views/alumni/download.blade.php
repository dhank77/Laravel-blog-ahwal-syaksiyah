<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Database Alumni</title>
</head>
<body>
    @php
        $tgl = date("ymdhis");
        $file_name = "database_alumni_$tgl.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file_name");
    @endphp
    <h4>
        Rekap Database Alumni<br/>
        Program Studi Hukum Keluarga (Ahwal Syakhshiyah) <br/>
        Universitas Muhammadiyah Makassar
    </h4>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nim</th>
                <th>Angkatan</th>
                <th>Tahun Lulus</th>
                <th>Asal Daerah</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>No Hp</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $k => $d)
                <tr>
                    <td style="text-align:center;">{{ $k + 1 }}.</td>
                    <td>{{ $d->nama }}</td>
                    <td>'{{ $d->nim }}</td>
                    <td>{{ $d->angkatan }}</td>
                    <td>{{ $d->tahun_lulus }}</td>
                    <td>{{ $d->asal_daerah }}</td>
                    <td>{{ $d->alamat }}</td>
                    <td>{{ $d->pekerjaan }}</td>
                    <td>{{ $d->no_hp }}</td>
                    <td>{{ $d->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>