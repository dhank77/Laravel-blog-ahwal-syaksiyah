@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul File Download
        @endslot
        @slot('title')
            Tambah File Download
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
                        <form method="post" action="{{ route('download.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $download->id }}">
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Nama Berkas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama" value="{{ $download->nama }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">File</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="file" id="file" />
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
    <link href="{{ asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet">
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#isi').summernote({
                height: 400,
            });
        });
        $(document).ready(function(e) {
            $('#gambar').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

        });
    </script>
    <script src="{{ asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
@endsection
