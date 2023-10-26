@extends('layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Admin Publisher
        @endslot
        @slot('title')
            Tambah Admin Publisher
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
                        <form method="post" action="{{ route('admin.publisher.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="mb-3 row">
                                <label for="kategori" class="col-sm-2 form-label align-self-center mb-lg-0">Kategori</label>
                                <div class="col-sm-10">
                                    @php
                                        $arr = explode(",", $user->kategori_id);
                                    @endphp
                                    @foreach ($kategori as $k)
                                        <div>
                                            <input name="kategori[]" id="k{{ $k->id }}" {{ in_array($k->id, $arr) ? "checked" : "" }} type="checkbox" value="{{ $k->id }}" /> <label for="k{{ $k->id }}">&nbsp;&nbsp;&nbsp;{{ $k->nama }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 form-label align-self-center mb-lg-0">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Nama Lengkap" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 form-label align-self-center mb-lg-0">Alamat Email</label>
                                <div class="col-sm-10">
                                    <input type="email" {{ $user->email != "" ? "readonly" : "" }} class="form-control" name="email" id="email"
                                        placeholder="Alamat Email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 form-label align-self-center mb-lg-0">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control" value="PASSWORD ADALAH ALAMAT EMAIL">
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
