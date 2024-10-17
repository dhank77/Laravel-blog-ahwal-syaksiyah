<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Data Survey</title>
</head>
<body>
    @php
        $tgl = date("ymdhis");
        $file_name = "survey_$tgl.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file_name");
    @endphp
    <h4>
        Rekap Laporan Survey <br/>
        Program Studi Hukum Keluarga (Ahwal Syakhshiyah) <br/>
        Universitas Muhammadiyah Makassar
    </h4>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>NIP/NIK/NIM</th>
                @foreach($soalSurvey as $key => $value)
                    <th>{{ strip_tags($value->soal) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $k => $d)
                <tr>
                    <td style="text-align:center;">{{ $k + 1 }}.</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->posisi }}</td>
                    <td>{{ $d->nim }}</td>
                    @foreach ($soalSurvey as $k => $soal)
                        @for($i = 1; $i <= 20; $i++)
                            @php
                                $surveyid = $soal->id;
                                $jawabanid = "idsurvey$i";
                                $jawaban = "survey$i";
                            @endphp
                            @if($surveyid == $d->$jawabanid)
                                <td>{{ $d->$jawaban }}</td>
                            @endif
                        @endfor
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>