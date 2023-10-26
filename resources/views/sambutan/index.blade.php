@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Sambutan
        @endslot
        @slot('title')
            Edit Sambutan
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
                        <form method="post" action="{{ route('setting.sambutan.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $komponen->id }}">
                            <div class="mb-3 row">
                                <label for="komponen3"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Foto Sambutan</label>
                                <div class="col-sm-10">
                                    <img id="preview-image-before-upload" src="{{ $komponen->komponen3 != "" ? asset("storage/$komponen->komponen3") : asset('noimage.png') }}"
                                        alt="preview image" style="max-height: 250px;">
                                    <input type="file" class="form-control" name="komponen3" id="komponen3"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen1" class="col-sm-2 form-label align-self-center mb-lg-0">Nama Komponen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="komponen1" id="komponen1"
                                        placeholder="komponen1" value="{{ $komponen->komponen1 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen2" class="col-sm-2 form-label align-self-center mb-lg-0">Nama Ketua Prodi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="komponen2" id="komponen2"
                                        placeholder="komponen2" value="{{ $komponen->komponen2 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="deskripsi" class="col-sm-2 form-label align-self-center mb-lg-0">Isi Sambutan</label>
                                <div class="col-sm-10">
                                    <textarea name="komponen4" id="komponen4" cols="30" rows="5">{{ $komponen->komponen4 }}</textarea>
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
            $('#komponen4').summernote({
                height: 400,
            });
        });
        $(document).ready(function(e) {
            $('#komponen3').change(function() {
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
