@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Formulir
        @endslot
        @slot('title')
            Tambah Formulir
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
                        <form method="post" action="{{ route('formulir.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $formulir->id }}">
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Nama Format</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama" value="{{ $formulir->nama }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Status</label>
                                <div class="col-sm-10">
                                    <select name="is_aktif" id="is_aktif" class="form-control">
                                        <option {{ $formulir->is_aktif == 1 ? "selected" : "" }} value="1">Aktif</option>
                                        <option {{ $formulir->is_aktif == 0 ? "selected" : "" }} value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Parameter Yang Digunakan</label>
                                <div class="col-sm-10">
                                    @for($i = 1; $i <= 9; $i++)
                                        @php
                                            $params = "param$i";
                                            $label = "Form $i";
                                            $param_nama = "param_nama$i";
                                        @endphp
                                        <div class="form-check form-check-inline">
                                            <input {{ $formulir->$params == 1 ? "checked" : "" }} class="form-check-input" type="radio" name="{{ $params }}" id="{{ $params }}1" value="1">
                                            <label class="form-check-label text-danger" for="{{ $params }}1"><b>Wajib Terisi</b></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input {{ $formulir->$params == 3 ? "checked" : "" }} class="form-check-input" type="radio" name="{{ $params }}" id="{{ $params }}3" value="3">
                                            <label class="form-check-label text-success" for="{{ $params }}3"><b>Wajib Terisi & Unik (Tidak Boleh Duplikat)</b></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input {{ $formulir->$params == 2 ? "checked" : "" }} class="form-check-input" type="radio" name="{{ $params }}" id="{{ $params }}2" value="2">
                                            <label class="form-check-label text-primary" for="{{ $params }}2"><b>Boleh Kosong</b></label>
                                        </div>
                                        <div class="mb-2 col-lg-4" style="margin-left:18px">
                                            <input type="text" value="{{ $formulir->$param_nama }}" placeholder="Nama {{ $label }}" name="{{ $param_nama }}" id="{{ $param_nama }}" class="form-control">
                                              </label>
                                        </div>

                                    @endfor
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Parameter Upload</label>
                                <div class="col-sm-10">
                                    @for($i = 1; $i <= 5; $i++)
                                        @php
                                            $files = "file$i";
                                            $file_nama = "file_nama$i";
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" name="{{ $files }}" id="{{ $files }}" {{ $formulir->$files == "1" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="{{ $files }}">
                                            {{ ucwords($files) }}  

                                            <input type="text" value="{{ $formulir->$file_nama }}" name="{{ $file_nama }}" id="{{ $file_nama }}" class="form-control">
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 ms-auto">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-danger">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
