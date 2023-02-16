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
                        <form method="post" action="{{ route('artikel.artikel.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $artikel->id }}">
                            <div class="mb-3 row">
                                <label for="kategori" class="col-sm-2 form-label align-self-center mb-lg-0">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" data-trigger class="form-control" id="status"
                                        placeholder="Cari Status">
                                        <option {{ $artikel->status == "1" ? "selected" : "" }} value="1">Publish</option>
                                        <option {{ $artikel->status == "0" ? "selected" : "" }} value="0">Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kategori" class="col-sm-2 form-label align-self-center mb-lg-0">Kategori</label>
                                <div class="col-sm-10">
                                    <select name="kategori_id" data-trigger class="form-control" id="kategori"
                                        placeholder="Cari Kategori">
                                        <option value="">Pilih</option>
                                        @foreach ($kategori as $k)
                                            <option {{ $k->id == $artikel->kategori_id ? 'selected' : '' }}
                                                value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="judul" id="judul"
                                        placeholder="Judul" value="{{ $artikel->judul }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="gambar"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Thumbnail</label>
                                <div class="col-sm-10">
                                    <img id="preview-image-before-upload" src="{{ $artikel->gambar != "" ? asset("storage/$artikel->gambar") : asset('noimage.png') }}"
                                        alt="preview image" style="max-height: 250px;">
                                    <input type="file" class="form-control" name="gambar" id="gambar"
                                        accept="image/*">
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
    <link href="{{ asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet">
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
    <script src="{{ asset('/assets/js/app.min.js') }}"></script>
@endsection
