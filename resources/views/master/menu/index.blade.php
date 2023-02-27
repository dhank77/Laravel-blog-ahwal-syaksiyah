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
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Tambah Menu</h4>
                </div>
                <div class="card-body">
                    <div class="general-label">
                        <form method="post" action="{{ route('utama.menu.store') }}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Menu">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" checked name="pilihan" id="linking"
                                        value="link">
                                    <label class="form-check-label" for="linking">Link</label>
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

                                    <select name="kategori" class="form-control" id="show_kategori" style="display:none;"
                                        placeholder="Cari Kategori">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $k)
                                            <option value="/kategori/{{ $k->slug }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>

                                    <select name="halaman" class="form-control" id="show_halaman" style="display:none;"
                                        placeholder="Cari Halaman">
                                        <option value="">Pilih Halaman</option>
                                        @foreach ($halaman as $h)
                                            <option value="/{{ $h->slug }}">{{ $h->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="parent_id">Kategori Menu</label>
                                <div class="col-sm-12">
                                    <select name="parent_id" class="form-control" id="parent_id"
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
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">Daftar Menu Website</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @foreach ($menu_utama as $key => $m)
                            <h5 class="text-truncate font-size-14 mb-2 d-flex justify-content-between">
                                <a href="javascript: void(0);"
                                    onclick="editMenu('{{ $m->id }}', '{{ $m->nama }}', '{{ $m->link }}', '{{ $m->parent_id }}')"
                                    class="text-primary">{{ $key + 1 }}. {{ $m->nama }}</a>
                                <div>
                                    @if ($key != 0)
                                        <a href="{{ route('utama.menu.up', $m->id) }}" class="btn btn-sm btn-success"><i
                                                class="fas fa-arrow-alt-circle-up"></i></a>
                                    @endif
                                    @if ($key != count($menu_utama) - 1)
                                        <a href="{{ route('utama.menu.down', $m->id) }}" class="btn btn-sm btn-dark"><i
                                                class="fas fa-arrow-circle-down"></i></a>
                                    @endif
                                    @if (!in_array($m->nama, ['Berita', 'Pengumuman', 'Staff Pengajar', 'Komplain Pelanggan']))
                                        <a href="#"
                                            onclick="editMenu('{{ $m->id }}', '{{ $m->nama }}', '{{ $m->link }}', '{{ $m->parent_id }}')"
                                            class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                        <a href="{{ route('utama.menu.delete', $m->id) }}"
                                            class="btn btn-sm btn-danger swalDelete"><i class="fas fa-trash"></i></a>
                                    @endif
                                </div>
                            </h5>
                            <div style="margin-left:50px;">
                                @php
                                    $submenu = get_child_menu($m->id);
                                @endphp
                                @foreach ($submenu as $key => $sub)
                                    <h5 class="text-truncate font-size-14 mb-2 d-flex justify-content-between">
                                        <a onclick="editMenu('{{ $sub->id }}', '{{ $sub->nama }}', '{{ $sub->link }}', '{{ $sub->parent_id }}')"
                                            href="javascript: void(0);" class="text-dark">{{ $sub->nama }}</a>
                                        <div>
                                            @if ($key != 0)
                                                <a href="" class="btn btn-sm btn-success"><i
                                                        class="fas fa-arrow-alt-circle-up"></i></a>
                                            @endif
                                            @if ($key != count($menu_utama) - 1)
                                                <a href="" class="btn btn-sm btn-dark"><i
                                                        class="fas fa-arrow-circle-down"></i></a>
                                            @endif
                                            <a href="#"
                                                onclick="editMenu('{{ $sub->id }}', '{{ $sub->nama }}', '{{ $sub->link }}', '{{ $sub->parent_id }}')"
                                                class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                            <a href="{{ route('utama.menu.delete', $sub->id) }}"
                                                class="btn btn-sm btn-danger swalDelete"><i class="fas fa-trash"></i></a>
                                        </div>
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
@endsection

@section('script')
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

        function editMenu(id, nama, link, parent_id) {
            $("#id").val(id);
            $("#nama").val(nama);
            if (parent_id == "") {
                $("#parent_id").val("")
            } else {
                $("#parent_id").val(parent_id)
            }
            var split = link.split("/");
            if (split[1] == 'kategori') {
                $("#halaman").attr('checked', false);
                $("#linking").attr('checked', false);
                $("#kategori").attr('checked', 'checked');
                $("#show_kategori").show();
                $("#show_link").hide();
                $("#show_halaman").hide();
                $("#show_kategori").val(link);
            } else if (split[1] == 'halaman') {
                $("#kategori").attr('checked', false);
                $("#linking").attr('checked', false);
                $("#halaman").attr('checked', 'checked');
                $("#show_halaman").show();
                $("#show_kategori").hide();
                $("#show_link").hide();
                console.log(link)
                $("#show_halaman").val(link).change();
            } else {
                $("#kategori").attr('checked', false);
                $("#halaman").attr('checked', false);
                $("#linking").attr('checked', 'checked');
                $("#show_link").show();
                $("#show_halaman").hide();
                $("#show_kategori").hide();
                $("#show_link").val(link);
            }
        }
    </script>
@endsection
