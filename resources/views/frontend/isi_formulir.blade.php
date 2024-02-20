@extends('frontend.layouts.app')

@section('content')
    <section class="blog-section">
        <div class="container">
            <div class="blog-box">
                <div class="d-flex justify-content-between">

                    @php
                        $jml_pendaftar = jumlahPendaftarFormulir($formulir->id);
                    @endphp

                    <h4>Formulir : {{ $formulir->nama }}</h4>
                    @if($formulir->is_tampil == 1 && $formulir->maks_pendaftar > 0)
                        <h4>Pendaftar : <b class="text-success">{{ $jml_pendaftar }}</b><b>/</b><b class="text-danger">{{ $formulir->maks_pendaftar }}</b></h4>
                    @endif
                </div>
                @if($formulir->batas_pendaftaran == "" || strtotime('now') <= strtotime($formulir->batas_pendaftaran))
                    @if($formulir->maks_pendaftar > 0 && $jml_pendaftar >= $formulir->maks_pendaftar)
                        <h4 class="text-danger">Pendaftaran telah penuh</h4>
                    @else
                        @if($formulir->batas_pendaftaran != "")
                            <div style="font-size: 24px; font-weight:bold;" id="count_down" class="text-center text-primary"></div>
                            <div style="font-size: 24px; font-weight:bold;" class="text-center text-primary">Tanggal berakhir pendaftaran : {{ tanggal_indo($formulir->batas_pendaftaran) }}</div>
                        @endif
                        <div class="card" id="form-card">
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
                                                    @if($formulir->$params == 1 || $formulir->$params == 3)
                                                    <span class="text-danger"><b>*</b></span>
                                                    @endif
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" {{ ($formulir->$params == 1 || $formulir->$params == 3) ? "required" : "" }} class="form-control" name="{{ $params }}" id="{{ $params }}" value="{{ old($params) }}"
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
                                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Upload {{ $formulir->$file_nama }} <span class="text-danger"><b>*</b></span></label>
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
                    @endif
                @else
                    <h4 class="text-danger">Pendaftaran telah ditutup</h4>
                @endif
            </div>
           
        </div>
    </section>
@endsection

@if($formulir->batas_pendaftaran != "")
<script>
var countDownDate = new Date("{{ date('M d, Y', strtotime($formulir->batas_pendaftaran)) }} 23:59:59").getTime();
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  document.getElementById("count_down").innerHTML =  " " + days + "Hari " + hours + "Jam "
  + minutes + "Menit " + seconds + "Detik ";
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("count_down").innerHTML = "EXPIRED";
    document.getElementById("form-card").innerHTML = "TELAH DITUTUP!";
  }
}, 1000);
</script>
@endif