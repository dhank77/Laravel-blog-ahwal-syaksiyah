@extends('layouts.master')
@section('title')
    Database Alumni
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
            Data Database Alumni
        @endslot
        @slot('title')
            Modul Database Alumni
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Database Alumni</h4>
                    <div class="float-end">
                        <a class="btn btn-success" href="{{ route('alumni.download') }}">Download Xls</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Import Data
                          </button>
                          <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                            <div class="modal-dialog">
                                <form action="{{ route('alumni.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Import Database Alumni</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <label for="file"
                                                    class="col-sm-2 form-label align-self-center mb-lg-0">File</label>
                                                <div class="col-sm-10">
                                                    <a href="{{ asset("import/alumni.xlsx") }}" class="text-primary"><b>Dowmload Format</b></a>
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
                        <a class="btn btn-success" href="{{ route('alumni.add') }}">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th style="width:10%;">Nama</th>
                                <th style="width:10%;">Nim</th>
                                <th style="width:10%;">TTL</th>
                                <th style="width:10%;">Angkatan</th>
                                <th style="width:10%;">Tahun Lulus</th>
                                <th style="width:10%;">Asal Daerah</th>
                                <th style="width:10%;">Alamat</th>
                                <th style="width:10%;">Pekerjaan</th>
                                <th style="width:10%;">Kontak</th>
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
    <script src="{{ asset('assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script>
        $(function() {
            let table = $('#table').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: '{{ route("alumni.json") }}',
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
                    data: "nim"
                }, {
                    data: "ttl"
                }, {
                    data: "angkatan"
                }, {
                    data: "tahun_lulus"
                }, {
                    data: "asal_daerah"
                }, {
                    data: "alamat"
                }, {
                    data: "pekerjaan"
                }, {
                    data: "kontak"
                }, {
                    data: "action"
                }],
            });
        });
    </script>
@endsection
