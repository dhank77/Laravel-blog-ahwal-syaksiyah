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
                                <th>Nama</th>
                                <th style="width:10%;">Nim</th>
                                <th style="width:1%;">Param1</th>
                                <th style="width:1%;">Param2</th>
                                <th style="width:1%;">Param3</th>
                                <th style="width:1%;">Param4</th>
                                <th style="width:1%;">Param5</th>
                                <th style="width:1%;">Param6</th>
                                <th style="width:1%;">Param7</th>
                                <th style="width:1%;">Param8</th>
                                <th style="width:1%;">Param9</th>
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
                                    <td>{{ $a->nama }}</td>
                                    <td>{{ $a->nim }}</td>
                                    <td>{{ $a->param1 }}</td>
                                    <td>{{ $a->param2 }}</td>
                                    <td>{{ $a->param3 }}</td>
                                    <td>{{ $a->param4 }}</td>
                                    <td>{{ $a->param5 }}</td>
                                    <td>{{ $a->param6 }}</td>
                                    <td>{{ $a->param7 }}</td>
                                    <td>{{ $a->param8 }}</td>
                                    <td>{{ $a->param9 }}</td>
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
