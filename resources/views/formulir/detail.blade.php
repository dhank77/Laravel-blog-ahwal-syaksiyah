@extends('layouts.master')
@section('title')
    Detail Formulir
@endsection

@section('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Data Detail Formulir
        @endslot
        @slot('title')
            Modul Detail Formulir
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Formulir : {{ $formulir->nama }} <br/>
                        Link : <a href="{{ url("form/$formulir->slug") }}">{{ url("form/$formulir->slug") }}</a> <br/>
                        Jumlah Pendaftar : {{ jumlahPendaftarFormulir($formulir->id) }} Peserta
                    </h4>
                    <div class="float-end">
                        <a href="{{ route('formulir.download_file', $formulir->id) }}" class="btn btn-primary mr-4">Download Semua berkas (Zip File)</a>
                        <a class="btn btn-success" href="{{ route('formulir.download_xls', $formulir->id) }}">Download Xls</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table dt-responsive  nowrap w-100">
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
                            @foreach ($formulirDetail as $k => $fD)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    @for($i = 1; $i <= 9; $i++)
                                        @php
                                            $params = "param$i";
                                            $param_nama = "param_nama$i";
                                        @endphp
                                        @if($formulir->$params != "")
                                            <td>{{ $fD->$params }}</td>
                                        @endif
                                    @endfor
                                    @for($i = 1; $i <= 5; $i++)
                                        @php
                                            $files = "file$i";
                                            $file_nama = "file_nama$i";
                                        @endphp
                                        @if($formulir->$files == 1)
                                            @php 
                                                $fileDownload = $fD->$files;
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

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/datatables.net/datatables.net.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/datatables.net-buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
