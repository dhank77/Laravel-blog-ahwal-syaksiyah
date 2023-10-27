@extends('frontend.layouts.app')

@section('content')
    <!-- page-banner-section
       ================================================== -->
    <section class="page-banner-section">
        <div class="container">
            <h1>Pengisian Formulir</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="#">Pengisian Formulir</a></li>
            </ul>
        </div>
    </section>
    <!-- End page-banner-section -->

    <section class="blog-section">
        <div class="container">
            <div class="blog-box">
                <h4>Formulir : {{ $formulir->nama }}</h4>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('isi_form_store', base64_encode($formulir->id)) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="formulir_id" value="{{ $formulir->id }}">
                            @for($i = 1; $i <= 9; $i++)
                                @php
                                    $params = "param$i";
                                    $param_nama = "param_nama$i";
                                @endphp
                                @if($formulir->$params != "")
                                    <div class="mb-3 row">
                                        <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">{{ $formulir->$param_nama }}
                                            @if($formulir->$params == 1)
                                            <span class="text-danger"><b>*</b></span>
                                            @endif
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" {{ $formulir->$params == 1 ? "required" : "" }} class="form-control" name="{{ $params }}" id="{{ $params }}" value="{{ old($params) }}"
                                                placeholder="{{ $formulir->$param_nama }}" />
                                        </div>
                                    </div>
                                @endif
                            @endfor
                            @for($i = 1; $i <= 5; $i++)
                                @php
                                    $files = "file$i";
                                    $file_nama = "file_nama$i";
                                @endphp
                                @if($formulir->$files == 1)
                                    <div class="mb-3 row">
                                        <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Upload {{ $formulir->$file_nama }}</label>
                                        <div class="col-sm-10">
                                            <input required type="file" class="form-control" name="{{ $files }}" id="{{ $files }}"
                                                placeholder="{{ $formulir->$file_nama }}" />
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
                            Keterangan : <span class="text-danger">* Wajib Diisi</span>
                            <div class="row mt-4">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10 ms-auto">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
