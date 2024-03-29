@extends('layouts.master')
@section('title')
    Kategori
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
            Data Pengajar
        @endslot
        @slot('title')
            Modul Pengajar
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Pengajar</h4>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('pengajar.add') }}">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th style="width:10%;">Gambar</th>
                                <th>Nama Lengkap</th>
                                <th style="width:20%;">Jabatan</th>
                                <th style="width:20%;">Keahlian</th>
                                <th style="width:20%;">Link</th>
                                <th style="width:1%;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajar as $k => $a)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>
                                        <img src="{{ asset("storage/$a->gambar") }}" style="width:100px; height:100px;" />
                                    </td>
                                    <td>{{ $a->nama }}</td>
                                    <td>{{ $a->jabatan }}</td>
                                    <td>{{ $a->keahlian }}</td>
                                    <td>
                                        @if($a->pddikti != "")
                                            <a href="{{ $a->pddikti }}" class="text-primary" target="_blank"><span class="text-success">✓</span> PDDikti</a> <br/>
                                        @else
                                            <span class="text-danger">X</span> <span>PDDikti</span> <br/>
                                        @endif
                                        @if($a->sinta != "")
                                            <a href="{{ $a->sinta }}" class="text-primary" target="_blank"><span class="text-success">✓</span> Sinta</a> <br/>
                                        @else
                                            <span class="text-danger">X</span> <span>Sinta</span> <br/>
                                        @endif
                                        @if($a->scholar != "")
                                            <a href="{{ $a->scholar }}" class="text-primary" target="_blank"><span class="text-success">✓</span> Scholar</a>
                                        @else
                                            <span class="text-danger">X</span> <span>Scholar</span> <br/>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pengajar.berkas', $a->id) }}" class="btn btn-success btn-sm">Berkas</a>
                                        <a href="{{ route('pengajar.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('pengajar.delete', $a->id) }}" class="btn btn-danger btn-sm swalUmum">Hapus</a>
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
