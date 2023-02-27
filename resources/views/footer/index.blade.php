@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Footer
        @endslot
        @slot('title')
            Edit Footer
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
                        <form method="post" action="{{ route('setting.footer.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $komponen->id }}">
                            <div class="mb-3 row">
                                <label for="komponen1"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Foto Footer</label>
                                <div class="col-sm-10">
                                    <img id="preview-image-before-upload" src="{{ $komponen->komponen1 != "" ? asset("storage/$komponen->komponen1") : asset('noimage.png') }}"
                                        alt="preview image" style="max-height: 250px;">
                                    <input type="file" class="form-control" name="komponen1" id="komponen1"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen2" class="col-sm-2 form-label align-self-center mb-lg-0">Deskripsi Singkat</label>
                                <div class="col-sm-10">
                                    <textarea name="komponen2" id="komponen2" cols="30" rows="5">{{ $komponen->komponen2 }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen3" class="col-sm-2 form-label align-self-center mb-lg-0">Alamat Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="komponen3" id="komponen3"
                                        placeholder="komponen3" value="{{ $komponen->komponen3 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen4" class="col-sm-2 form-label align-self-center mb-lg-0">Nomor Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="komponen4" id="komponen4"
                                        placeholder="komponen4" value="{{ $komponen->komponen4 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen5" class="col-sm-2 form-label align-self-center mb-lg-0">Link Terkait</label>
                                <div class="col-sm-10">
                                    <textarea name="komponen5" id="komponen5" cols="30" rows="5">{{ $komponen->komponen5 }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen6" class="col-sm-2 form-label align-self-center mb-lg-0">Facebook</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="komponen6" id="komponen6"
                                        placeholder="komponen6" value="{{ $komponen->komponen6 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen7" class="col-sm-2 form-label align-self-center mb-lg-0">Twitter</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="komponen7" id="komponen7"
                                        placeholder="komponen7" value="{{ $komponen->komponen7 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen8" class="col-sm-2 form-label align-self-center mb-lg-0">Youtube</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="komponen8" id="komponen8"
                                        placeholder="komponen8" value="{{ $komponen->komponen8 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="komponen9" class="col-sm-2 form-label align-self-center mb-lg-0">Instagram</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="komponen9" id="komponen9"
                                        placeholder="komponen9" value="{{ $komponen->komponen9 }}">
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
            $('#komponen2').summernote({
                height: 200,
            });
            $('#komponen5').summernote({
                height: 400,
            });
        });
        $(document).ready(function(e) {
            $('#komponen1').change(function() {
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
