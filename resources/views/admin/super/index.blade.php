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
            Data Superadmin
        @endslot
        @slot('title')
            Modul Superadmin
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Superadmin</h4>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('admin.super.add') }}">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th>Nama</th>
                                <th style="width:10%;">Alamat Email</th>
                                <th style="width:1%;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $k => $a)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.super.reset', $a->id) }}" class="btn btn-primary btn-sm swalUmum">Reset</a>
                                        <a href="{{ route('admin.super.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('admin.super.delete', $a->id) }}" class="btn btn-danger btn-sm swalUmum">Hapus</a>
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
