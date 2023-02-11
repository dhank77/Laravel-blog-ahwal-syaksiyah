@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Artikel
        @endslot
        @slot('li_2')
            Kategori
        @endslot
        @slot('li_3')
            Tambah Kategori
        @endslot
        @slot('title')
            Tambah Kategori
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah</h4>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="general-label">
                        <form method="post" action="{{ route('artikel.kategori.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $kategori->id }}">
                            <div class="mb-3 row">
                                <label for="nama"
                                    class="col-sm-2 form-label align-self-center mb-lg-0">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Kategori" value="{{ $kategori->nama }}">
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
@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
