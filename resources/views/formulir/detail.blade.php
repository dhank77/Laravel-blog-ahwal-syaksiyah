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
                        @php
                            $slugEnc = base64_encode($formulir->id . "~" . "ahwal-unismuh" . "~". $formulir->slug);
                            $urlPublik = url("daftar-form/$slugEnc");
                            $urlCek = url("cek-form/$formulir->slug");
                        @endphp
                        Jumlah Pendaftar : <span class="text-success">{{ jumlahPendaftarFormulir($formulir->id) }} Peserta</span> 
                        <hr>
                        Link Publik Untuk Mengecek Pendaftar <br>
                        Daftar Semua : <a href="{{ $urlPublik }}" class="text-danger">Link Disini</a> <br/>
                        Cek Per Data : <a href="{{ $urlCek }}" class="text-danger">Link Disini</a> <br/>
                    </h4>
                    <div class="float-end">
                        <a href="{{ route('formulir.download_file', $formulir->id) }}" class="btn btn-primary mr-4">Download Semua berkas (Zip File)</a>
                        <a class="btn btn-success" href="{{ route('formulir.download_xls', $formulir->id) }}">Download Xls</a>
                        <a class="btn btn-info" href="{{ route('formulir.detail_add', $formulir->id) }}">Tambah</a>
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
                                <th>Opsi</th>
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
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route("formulir.detail_edit", [$fD->formulir_id, $fD->id]) }}">Edit</a>
                                        <a class="btn btn-sm btn-danger swalUmum" onclick="deleted(event)" href="{{ route("formulir.detail_delete", [$fD->formulir_id, $fD->id]) }}">Hapus</a>
                                    </td>
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
