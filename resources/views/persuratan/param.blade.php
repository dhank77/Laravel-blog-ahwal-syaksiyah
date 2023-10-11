@extends('layouts.master')
@section('title')
Buat Surat
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Buat Surat
        @endslot
        @slot('title')
            Tambah Buat Surat
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Buat Surat</h4>
                </div>
                <div class="card-body">
                    <div class="general-label">
                        <form method="post" action="{{ route('persuratan.param_store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataDetail->id }}">
                            <input type="hidden" name="data_id" value="{{ $data->id }}">
                            @if($data->is_nama == 1)
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama" value="{{ $dataDetail->nama }}">
                                </div>
                            </div>
                            @endif
                            @if($data->is_nim == 1)
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">NIM</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nim" id="nim"
                                        placeholder="NIM" value="{{ $dataDetail->nim }}">
                                </div>
                            </div>
                            @endif
                            @for($i = 1; $i <= 9; $i++)
                                        @php
                                            $params = "param$i";
                                            $param_nama = "param_nama$i";
                                        @endphp
                                @if($data->$params == 1)
                                <div class="mb-3 row">
                                    <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">{{ $data->$param_nama }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="{{ $params }}" id="{{ $params }}"
                                            placeholder="{{ $data->$param_nama }}" value="{{ $dataDetail->$params }}">
                                    </div>
                                </div>
                                @endif
                            @endfor
                            <div class="row">
                                <div class="col-sm-10 ms-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
