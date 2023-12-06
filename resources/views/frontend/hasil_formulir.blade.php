@extends('frontend.layouts.app')

@section('content')
    <section class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-box">
                        <h4>Pencarian Formulir : {{ $formulir->nama }}</h4>
                        @if(!$cari)
                            <br>
                            <h5 class="text-danger">Hasil tidak ditemukan!</h5>
                            @else
                            <h5 class="text-success">Hasil ditemukan!</h5>
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <table border="1" width="100%">
                                            <thead>
                                                @for($i = 1; $i <= 9; $i++)
                                                    @php
                                                        $params = "param$i";
                                                        $param_nama = "param_nama$i";
                                                    @endphp
                                                    @if($formulir->$params != "")
                                                        <tr>
                                                            <td style="padding: 10px;">{{ $formulir->$param_nama }} </td>
                                                            <td style="padding: 10px;">{{ $cari->$params }}</td>
                                                        </tr>
                                                    @endif
                                                @endfor
                                                @for($i = 1; $i <= 5; $i++)
                                                    @php
                                                        $files = "file$i";
                                                        $file_nama = "file_nama$i";
                                                    @endphp
                                                    @if($formulir->$files == 1)
                                                    <tr>
                                                        <td style="padding: 10px;">{{ $formulir->$file_nama }} </td>
                                                        <td>
                                                            <a style="margin-left:10px;" class="btn btn-sm btn-primary" href="{{ asset("storage/{$cari->$files}") }}">Download File</a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endfor
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
