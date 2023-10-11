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
                    <h4 class="card-title float-start">Daftar Surat : {{ $data->nama }}</h4>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('persuratan.param', $data->id) }}">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th>Download</th>
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
                                        <a href="{{ route('persuratan.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('persuratan.delete', $a->id) }}" class="btn btn-danger btn-sm swalUmum">Hapus</a>
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
