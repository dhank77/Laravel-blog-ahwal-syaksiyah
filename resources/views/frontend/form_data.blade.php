@extends('frontend.layouts.app')

@section('content')
    <!-- page-banner-section
       ================================================== -->
    <section class="page-banner-section">
        <div class="container">
            <h1>Form Data</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="#">Form Data</a></li>
            </ul>
        </div>
    </section>
    <!-- End page-banner-section -->

    <section class="blog-section">
        <div class="container">
            <div class="blog-box">
                <h4>Form Data : {{ $data->nama }}</h4>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('form_data_store', base64_encode($data->id)) }}">
                            @csrf
                            <input type="hidden" name="data_id" value="{{ $data->id }}">
                            @if($data->is_nama == 1)
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama">
                                </div>
                            </div>
                            @endif
                            @if($data->is_nim == 1)
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">NIM</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nim" id="nim"
                                        placeholder="NIM">
                                </div>
                            </div>
                            @endif
                            @for($i = 1; $i <= 9; $i++)
                                @php
                                    $params = "param$i";
                                    $param_nama = "param_nama$i";
                                @endphp
                                @if($data->$params == 1)
                                    <div class="mb-3 row">
                                        <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">{{ $data->$param_nama }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="{{ $params }}" id="{{ $params }}"
                                                placeholder="{{ $data->$param_nama }}" />
                                        </div>
                                    </div>
                                @endif
                            @endfor
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Validasi Captcha</label>
                                <div class="col-sm-10">
                                    <div>{!! captcha_img() !!}</div>
                                    <input type="number" class="form-control" name="captcha" id="captcha"
                                        placeholder="Captcha">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10 ms-auto">
                                    <button type="submit" class="btn btn-primary">Simpan & Download</button>
                                    <button onclick="history.back()"  type="button" class="btn btn-danger">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
        </div>
    </section>
@endsection
