@extends('layouts.master')
@section('title')
    Menu Website
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Menu Utama
        @endslot
        @slot('title')
            Menu Website
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Tambah Menu</h4>
                </div>
                <div class="card-body">
                    <div class="general-label">
                        <form method="post" action="{{ route('artikel.kategori.store') }}">
                            @csrf
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Menu">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" checked name="inlineRadioOptions"
                                        id="link" value="link">
                                    <label class="form-check-label" for="link">Link</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="halaman" value="halaman">
                                    <label class="form-check-label" for="halaman">Halaman</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="kategori" value="kategori">
                                    <label class="form-check-label" for="kategori">Kategori</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="link" id="link"
                                        placeholder="Link">
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
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Menu Website</h4>
                </div>
                <div class="card-body">


                </div>
            </div>
        </div>
    </div>
@endsection
