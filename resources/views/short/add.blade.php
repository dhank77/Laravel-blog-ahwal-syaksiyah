@extends('layouts.master')
@section('title')
    Short Link
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Short Link
        @endslot
        @slot('title')
            Tambah Short Link
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
                        <form method="post" action="{{ route('short.store') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{ $short->id }}">
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 form-label align-self-center mb-lg-0">Nama Link</label>
                                <div class="col-sm-10">
                                    <input required type="text" onkeyup="generateSlug()" class="form-control" name="nama" id="nama" autocomplete="false"
                                        placeholder="Nama" value="{{ $short->nama }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 form-label align-self-center mb-lg-0">Short Link</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">{{ url('link') }}/</span>
                                        <input required type="text" class="form-control" name="slug" id="slug" placeholder="Short Link" oninput="replaceSpaces()" value="{{ $short->slug }}">
                                    </div>
                                    <button type="button" onclick="copyText()" class="btn btn-sm btn-danger">Copy</button>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="url_tujuan" class="col-sm-2 form-label align-self-center mb-lg-0">Url Tujuan</label>
                                <div class="col-sm-10">
                                    <input type="text" required class="form-control" name="url_tujuan" id="url_tujuan"
                                        placeholder="Url Tujuan" value="{{ $short->url_tujuan }}">
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

@section('css')
@endsection
@section('script')
    <script>
        function copyText() {
            var link = '{{ url("link") }}' + "/";
            var teks = document.getElementById("slug").value;
            var send = link + teks;

            var textarea = document.createElement("textarea");
            textarea.value = send;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
            alert("Teks telah disalin ke clipboard: " + send);
        }

        function generateSlug() {
            var inputElemen = document.getElementById("nama");
            var teks = inputElemen.value;
            var slug = teks.toLowerCase().replace(/\s+/g, '-');
            $("#slug").val(slug)
        }

        function replaceSpaces() {
            var inputElemen = document.getElementById("slug");
            var teks = inputElemen.value;
            var slug = teks
                .toLowerCase()
                .replace(/[^a-z0-9\s]/g, '-')
                .replace(/\s+/g, '-');
            inputElemen.value = slug;
            $("#slug").val(slug)
        }
    </script>
@endsection