@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Persuratan
        @endslot
        @slot('title')
            Tambah Persuratan
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah</h4>
                </div>
                <div class="card-body">
                    <div class="general-label">
                        <form method="post" action="{{ route('persuratan.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Nama Format</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama" value="{{ $data->nama }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">File</label>
                                <div class="col-sm-10">
                                    @if($data->file != "")
                                        <a href="{{ asset("storage/$data->file") }}" class="btn btn-primary btn-sm mb-2">File Saat Ini</a>
                                    @endif
                                    <input type="file" class="form-control" name="file" id="file" />
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Apakah Dapat Diakses Publik ?</label>
                                <div class="col-sm-10">
                                    <select name="is_public" id="is_public" class="form-control">
                                        <option {{ $data->is_public == 0 ? "selected" : "" }} value="0">Tidak</option>
                                        <option {{ $data->is_public == 1 ? "selected" : "" }} value="1">Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Apakah Publik Dapat Mengisi Form Pada Website ?</label>
                                <div class="col-sm-10">
                                    <select name="is_form" id="is_form" class="form-control">
                                        <option {{ $data->is_form == 0 ? "selected" : "" }} value="0">Tidak</option>
                                        <option {{ $data->is_form == 1 ? "selected" : "" }} value="1">Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Parameter Yang Digunakan</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="Nama" name="is_nama" {{ $data->is_nama == "1" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Nama">
                                          Nama
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="NIM" name="is_nim" {{ $data->is_nim == "1" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="NIM">
                                          Nim
                                        </label>
                                    </div>
                                    @for($i = 1; $i <= 9; $i++)
                                        @php
                                            $params = "param$i";
                                            $param_nama = "param_nama$i";
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="{{ $params }}" id="{{ $params }}" {{ $data->$params == "1" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $params }}">
                                            {{ ucwords($params) }}  

                                            <input type="text" value="{{ $data->$param_nama }}" name="{{ $param_nama }}" id="{{ $param_nama }}" class="form-control">
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
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
