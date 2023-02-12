@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Artikel
        @endslot
        @slot('title')
            Tambah Artikel
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
                        <form method="post" action="{{ route('artikel.artikel.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $artikel->id }}">
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="judul" id="judul"
                                        placeholder="Judul" value="{{ $artikel->judul }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="isi" class="col-sm-2 form-label align-self-center mb-lg-0">Isi
                                    Artikel</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" name="isi" id="isi" placeholder="isi">{{ $artikel->isi }}</textarea>
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
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
    </div>
@endsection
@section('css')
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection
@section('script')
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    
    <script>
        $(document).ready(function() {

            $('#isi').summernote({
                height: 400,
            });
        });
    </script>
@endsection
