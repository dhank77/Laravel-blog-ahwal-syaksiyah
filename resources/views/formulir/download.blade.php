<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download Data {{ $formulir->nama }}</title>
</head>
<body>
    @php
        $tgl = date("ymdhis");
        $nama = $formulir->nama;
        $slug = $formulir->slug;
        $file_name = "$slug-$tgl.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file_name");
    @endphp
    <h4>
        Rekap Laporan {{ ucwords($nama) }} <br/>
        Program Studi Hukum Keluarga (Ahwal Syakhshiyah) <br/>
        Universitas Muhammadiyah Makassar
    </h4>
    <table border="1">
        <thead>
            <tr>
                <th style="width:1%;">No</th>
                @for($i = 1; $i <= 9; $i++)
                        @php
                            $params = "param$i";
                            $param_nama = "param_nama$i";
                        @endphp
                    @if($formulir->$params != "")
                        <th style="width:1%;">{{ $formulir->$param_nama }}</th>
                    @endif
                @endfor
                @for($i = 1; $i <= 5; $i++)
                        @php
                            $files = "file$i";
                            $file_nama = "file_nama$i";
                        @endphp
                    @if($formulir->$files != "")
                        <th style="width:1%;">{{ $formulir->$file_nama }}</th>
                    @endif
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($formulirDetail as $k => $a)
                <tr>
                    <td>{{ $k + 1 }}</td>
                    @for($i = 1; $i <= 9; $i++)
                        @php
                            $params = "param$i";
                            $param_nama = "param_nama$i";
                        @endphp
                        @if($formulir->$params != "")
                            <td>
                                @if(is_numeric($a->$params))'@endif{{ $a->$params }}
                            </td>
                        @endif
                    @endfor
                    @for($i = 1; $i <= 5; $i++)
                        @php
                            $files = "file$i";
                            $file_nama = "file_nama$i";
                        @endphp
                        @if($formulir->$files == 1)
                            @php 
                                $fileDownload = $a->$files;
                            @endphp
                            <td>
                                <a href="{{ asset("storage/$fileDownload") }}">Download</a>
                            </td>
                        @endif
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>