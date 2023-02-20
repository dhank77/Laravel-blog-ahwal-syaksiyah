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
                        <form method="post" action="{{ route('utama.menu.store') }}">
                            @csrf
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Menu">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" checked name="pilihan" id="link"
                                        value="link">
                                    <label class="form-check-label" for="link">Link</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pilihan" id="halaman"
                                        value="halaman">
                                    <label class="form-check-label" for="halaman">Halaman</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pilihan" id="kategori"
                                        value="kategori">
                                    <label class="form-check-label" for="kategori">Kategori</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="link" id="show_link"
                                        placeholder="Link">

                                    <select name="kategori" data-trigger class="form-control" id="show_kategori"
                                        style="display:none;" placeholder="Cari Kategori">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->slug }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>

                                    <select name="halaman" data-trigger class="form-control" id="show_halaman"
                                        style="display:none;" placeholder="Cari Halaman">
                                        <option value="">Pilih Halaman</option>
                                        @foreach ($halaman as $h)
                                            <option value="{{ $h->slug }}">{{ $h->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="parent_id">Kategori Menu</label>
                                <div class="col-sm-12">
                                    <select name="parent_id" data-trigger class="form-control" id="parent_id"
                                        placeholder="Cari Kategori">
                                        <option value="">Menu Utama</option>
                                        @foreach ($menu_utama as $m)
                                            <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                        @endforeach
                                    </select>
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
                    <div class="table-responsive">
                        @foreach ($menu_utama as $key => $m)
                            <h5 class="text-truncate font-size-14 mb-2">
                                <a href="javascript: void(0);" class="text-dark">{{ $m->nama }}</a>
                            </h5>
                            <div style="margin-left:50px;">
                                @foreach(get_child_menu($m->id) as $key => $sub)
                                    <h5 class="text-truncate font-size-14 mb-2">
                                        <a href="javascript: void(0);" class="text-dark">{{ $sub->nama }}</a>
                                    </h5>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
    <script>
        $(".form-check-input").click(function() {
            var input = $('input[name=pilihan]:checked').val();
            if (input == 'halaman') {
                $("#show_halaman").show();
                $("#show_kategori").hide();
                $("#show_link").hide();
            } else if (input == 'link') {
                $("#show_link").show();
                $("#show_halaman").hide();
                $("#show_kategori").hide();
            } else if (input == 'kategori') {
                $("#show_kategori").show();
                $("#show_link").hide();
                $("#show_halaman").hide();
            }
        })
    </script>
@endsection
