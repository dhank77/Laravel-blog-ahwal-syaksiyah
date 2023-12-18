@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Formulir Detail
        @endslot
        @slot('title')
            Tambah Formulir Detail
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Formulir</h4>
                </div>
                <div class="card-body">
                    <div class="general-label">
                        <form method="post" action="{{ route('formulir.detail_store', $formulir->id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $formulirDetail->id }}">
                            @for($i = 1; $i <= 9; $i++)
                                @php
                                    $params = "param$i";
                                    $param_nama = "param_nama$i";
                                @endphp
                                @if($formulir->$params != "")
                                    <div class="mb-3 row">
                                        <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">{{ $formulir->$param_nama }}
                                            @if($formulir->$params == 1 || $formulir->$params == 3)
                                                <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" {{ ($formulir->$params == 1 || $formulir->$params == 3) ? "required" : "" }} class="form-control" name="{{ $params }}" id="{{ $params }}" value="{{ $formulirDetail->$params ?? old($params) }}" 
                                                placeholder="{{ $formulir->$param_nama }}" />
                                        </div>
                                    </div>
                                @endif
                            @endfor
                            @for($i = 1; $i <= 5; $i++)
                                @php
                                    $files = "file$i";
                                    $file_nama = "file_nama$i";
                                @endphp
                                @if($formulir->$files == 1)
                                    <div class="mb-3 row">
                                        <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Upload {{ $formulir->$file_nama }} <span class="text-danger"><b>*</b></span></label>
                                        <div class="col-sm-10">
                                            @if($formulirDetail->$files != "")
                                                <a href="{{ asset("storage/{$formulirDetail->$files}") }}" class="btn btn-primary btn-sm mb-2">File Saat Ini</a>
                                            @endif
                                            <input @if($formulirDetail->$files == "") required @endif type="file" class="form-control" name="{{ $files }}" id="{{ $files }}"
                                                placeholder="{{ $formulir->$file_nama }}" />
                                        </div>
                                    </div>
                                @endif
                            @endfor
                            <div class="row">
                                <div class="col-sm-10 ms-auto">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
