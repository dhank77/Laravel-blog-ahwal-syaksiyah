@extends('frontend.layouts.app')

@section('content')
    <!-- page-banner-section
       ================================================== -->
    <section class="page-banner-section">
        <div class="container">
            <h1>Cek Pengisian Formulir</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="#">Cek Pengisian Formulir</a></li>
            </ul>
        </div>
    </section>
    <!-- End page-banner-section -->

    <section class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-box">
                        <h4>Cek Data Formulir : {{ $formulir->nama }}</h4>
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('cek_form_store', base64_encode($formulir->id)) }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="formulir_id" value="{{ $formulir->id }}">
                                    <div class="mb-3 row">
                                        <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">
                                            Masukkan Nama/Nim
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="cek" id="cek" placeholder="Cek Data" />
                                        </div>
                                    </div>
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
                                            <button type="submit" class="btn btn-primary">Cek Data</button>
                                            <button onclick="history.back()"  type="button" class="btn btn-danger">Kembali</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
