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
            Daftar Surat
        @endslot
        @slot('title')
            Modul Persuratan
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Surat</h4>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('persuratan.add') }}">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th>Nama</th>
                                <th style="width:10%;">File</th>
                                <th>Surat</th>
                                <th style="width:1%;">Publik?</th>
                                <th style="width:1%;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $k => $a)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $a->nama }}</td>
                                    <td>
                                        <a href="{{ asset("storage/$a->file") }}">Lihat File</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('persuratan.param', $a->id) }}" class="btn btn-primary btn-sm">Buat Surat</a>
                                        <a href="{{ route('persuratan.surat', $a->id) }}" class="btn btn-primary btn-sm">Lihat Surat</a>
                                    </td>
                                    <td>
                                        @if($a->is_public == 1)
                                            <span class="text-primary">YA</span>
                                        @else
                                            <span class="text-danger">TIDAK</span>
                                        @endif
                                    </td>
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