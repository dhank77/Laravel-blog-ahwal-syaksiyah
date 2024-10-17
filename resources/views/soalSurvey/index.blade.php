@extends('layouts.master')
@section('title')
    Soal Survey
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
            Data Soal Survey
        @endslot
        @slot('title')
            Modul Soal Survey
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Soal Survey</h4>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('setting.soalSurvey.add') }}">+ Tambah</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th style="width:1%;">No</th>
                                <th style="width:10%;">Soal</th>
                                @for($i = 1; $i <= 5; $i++)
                                    <th style="width:10%;">Pilihan {{ $i }}</th>
                                @endfor
                                <th style="width:10%;">Status</th>
                                <th style="width:1%;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soalSurvey as $k => $a)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{!! $a->soal !!}</td>
                                    @for($i = 1; $i <= 5; $i++)
                                        @php
                                            $pilihan = "pilihan$i";
                                        @endphp
                                        <td>{{ $a->$pilihan }}</td>
                                    @endfor
                                    <td>
                                        <div class="badge bg-{{ $a->is_active == 1 ? "success" : "danger" }}">
                                            {{ $a->is_active == 1 ? "Aktif" : "Tidak Aktif" }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('setting.soalSurvey.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('setting.soalSurvey.delete', $a->id) }}" class="btn btn-danger btn-sm swalUmum">Hapus</a>
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
