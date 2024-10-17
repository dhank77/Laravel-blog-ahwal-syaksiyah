@extends('layouts.master')
@section('title')
    Tambah Soal Survey
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Soal Survey
        @endslot
        @slot('title')
            Tambah Soal Survey
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
                        <form method="post" action="{{ route('setting.soalSurvey.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $soalSurvey->id }}">
                            <div class="mb-3 row">
                                <label for="soal" class="col-sm-2 form-label align-self-center mb-lg-0">Soal Survey</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" name="soal" id="soal" placeholder="soal">{{ $soalSurvey->soal }}</textarea>
                                </div>
                            </div>
                            @for($i = 1; $i <= 5; $i++)
                                @php
                                    $pilihan = "pilihan$i";
                                @endphp
                                 <div class="mb-3 row">
                                    <label for="{{ $pilihan }}" class="col-sm-2 form-label align-self-center mb-lg-0">Pilihan {{ $i }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="{{ $pilihan }}" id="{{ $pilihan }}"
                                            placeholder="Pilihan {{ $i }}" value="{{ $soalSurvey->$pilihan }}">
                                    </div>
                                </div>
                            @endfor
                            <div class="mb-3 row">
                                <label for="is_active" class="col-sm-2 form-label align-self-center mb-lg-0">Status</label>
                                <div class="col-sm-10">
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option {{ $soalSurvey->is_active == 1 ? "selected" : "" }} value="1">Aktif</option>
                                        <option {{ $soalSurvey->is_active == 0 ? "selected" : "" }} value="0">Tidak Aktif</option>
                                    </select>
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
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet">
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#soal').summernote({
                height: 400,
            });
        });
    </script>
    <script src="{{ asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
