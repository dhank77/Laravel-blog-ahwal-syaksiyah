@extends('layouts.master')
@section('title')
    Berkas
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
            Data Berkas
        @endslot
        @slot('title')
            Modul Berkas
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Berkas</h4>
                    <div class="float-end">
                        <a class="btn btn-danger" href="{{ route('lokasiFile.index') }}">Lokasi File</a>
                        <a class="btn btn-primary" href="{{ route('berkas.add') }}">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th>Nama</th>
                                <th style="width:10%;">Lokasi</th>
                                <th style="width:10%;">Download</th>
                                <th style="width:10%;">Tipe</th>
                                <th style="width:10%;">Size</th>
                                <th style="width:1%;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
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
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script>
    $(function() {
        let table = $('#table').dataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: '{{ route("berkas.json") }}',
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
                data: "lokasi_file"
            }, {
                data: "download"
            }, {
                data: "tipe"
            }, {
                data: "size"
            }, {
                data: "action"
            }],
        });
    });
</script>
@endsection
