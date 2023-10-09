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
            Data Artikel
        @endslot
        @slot('title')
            Kategori
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Kategori</h4>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('artikel.kategori.add') }}">+ Tambah</a>
                    </div>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->slug }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('artikel.kategori.edit', $value->slug) }}">Edit</a>
                                        <a class="btn btn-danger btn-sm swalUmum" href="{{ route('artikel.kategori.delete', $value->slug) }}">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
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
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
@endsection
