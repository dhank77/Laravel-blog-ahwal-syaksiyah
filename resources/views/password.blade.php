@extends('layouts.master')
@section('title') Profil @endsection
@section('css')

<link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">

@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Profil @endslot
@slot('title') Ubah Password ! @endslot
@endcomponent

<div class="row">
     <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route("updatePassword") }}" method="POST">
                        <div class="card-body">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-capitalize">Password Lama</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="password" name="password_lama" placeholder="Password Lama">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-capitalize">Password Baru</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="password" name="password_baru" placeholder="Password Baru">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-capitalize">Password konfirmasi</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="password" name="password_konfirmasi" placeholder="Password konfirmasi">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <input class="btn btn-light" type="reset" value="Cancel">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
