@extends('layouts.master')
@section('title')
    Formulir
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
            Daftar Formulir
        @endslot
        @slot('title')
            Modul Formulir
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Formulir</h4>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('formulir.add') }}">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table dt-responsive w-100">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th>Nama</th>
                                <th>Link</th>
                                <th style="width:10%;">Jumlah Pendaftar</th>
                                <th style="width:1%;">Opsi</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/datatables.net/datatables.net.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $(function() {
            let table = $('#table').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: '{{ route("formulir.json") }}',
                "lengthMenu": [
                    [10, 25, 50],
                    [10, 25, 50]
                ],
                columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                }, {
                    data: "nama"
                }, {
                    data: "link"
                }, {
                    data: "jumlah"
                }, {
                    data: "action"
                }],
            });
        });
    </script>
@endsection