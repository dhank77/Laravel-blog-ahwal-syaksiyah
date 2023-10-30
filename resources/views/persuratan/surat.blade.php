@extends('layouts.master')
@section('title')
    Persuratan
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
            Data Persuratan
        @endslot
        @slot('title')
            Modul Persuratan
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Surat : {{ $data->nama }} <br/>
                    Data ID : {{ $data->id }}
                    </h4>
                    <div class="float-end">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                            Import Surat
                          </button>
                          <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                            <div class="modal-dialog">
                                <form action="{{ route('persuratan.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Import Surat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Keterangan</h6>
                                            <p style="margin-left:15px">
                                            Data ID : {{ $data->id }} <br/>
                                            @if($data->is_nama == 1)
                                                <span class="text-danger">Nama : Wajib diisi</span> <br/>
                                            @endif
                                            @if($data->is_nim == 1)
                                                <span class="text-danger">Nim : Wajib diisi</span> <br/>
                                            @endif
                                            @for($i = 1; $i <= 9; $i++)
                                                    @php
                                                        $params = "param$i";
                                                        $param_nama = "param_nama$i";
                                                    @endphp
                                                @if($data->$params == 1)
                                                    {{ $params }} : {{ $data->$param_nama }} <br/>
                                                @endif
                                            @endfor
                                            </p>
                                            <hr>
                                            <input type="hidden" name="data_id" id="data_id" value="{{ $data->id }}">
                                            <div class="mb-3 row">
                                                <label for="gambar"
                                                    class="col-sm-2 form-label align-self-center mb-lg-0">File</label>
                                                <div class="col-sm-10">
                                                    <a href="{{ asset("import/surat.xlsx") }}" class="text-primary"><b>Dowmload Format</b></a>
                                                    <input type="file" class="form-control" name="file" id="file" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Import</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <a class="btn btn-primary" href="{{ route('persuratan.param', $data->id) }}">+ Buat Surat</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th>Download</th>
                                <th>Link</th>
                                @if($data->is_nama == 1)
                                    <th>Nama</th>
                                @endif
                                @if($data->is_nim == 1)
                                    <th style="width:10%;">Nim</th>
                                @endif
                                @for($i = 1; $i <= 9; $i++)
                                        @php
                                            $params = "param$i";
                                            $param_nama = "param_nama$i";
                                        @endphp
                                    @if($data->$params == 1)
                                        <th style="width:1%;">{{ $data->$param_nama }}</th>
                                    @endif
                                @endfor
                                <th style="width:1%;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataDetail as $k => $a)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>
                                        <a href="{{ route('persuratan.download', $a->id) }}" class="btn btn-warning btn-sm">Download</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('filesurat', [$data->slug, base64_encode($a->id)]) }}">{{ route('filesurat', [$data->slug, base64_encode($a->id)]) }}</a>
                                    </td>
                                    @if($data->is_nama == 1)
                                        <td>{{ $a->nama }}</td>
                                    @endif
                                    @if($data->is_nim == 1)
                                        <td>{{ $a->nim }}</td>
                                    @endif
                                    @for($i = 1; $i <= 9; $i++)
                                            @php
                                                $params = "param$i";
                                                $param_nama = "param_nama$i";
                                            @endphp
                                        @if($data->$params == 1)
                                            <td>{{ $a->$params }}</td>
                                        @endif
                                    @endfor
                                    <td>
                                        <a href="{{ route('persuratan.param_edit', [$data->id, $a->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('persuratan.param_delete', $a->id) }}" class="btn btn-danger btn-sm swalUmum" onclick="deleted(event)">Hapus</a>
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
