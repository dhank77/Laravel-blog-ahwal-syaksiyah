@extends('frontend.layouts.app')

@section('content')
    <section class="contact-section">
        <div class="container">
            <div class="contact-box">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Form Survey</h1>
                        <p>Survei Tingkat Pemahaman Sivitas Akademika PS Hukum Keluarga (Ahwal Syakhshiyah) Terhadap Visi Keilmuan, Tujuan, dan Strategi Pencapaian Tujuan PS Tahun {{ date("Y")-1 }}/{{ date("Y") }}.</p>
                        <form id="contact-form" method="POST" action="{{ route("survey.store") }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input name="nama" class="form-control" type="text" placeholder="Nama">
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input name="nim" class="form-control" type="text" placeholder="NIP/NIK/NIM">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="posisi" class="form-control">
                                            <option value="">-Pilih Posisi-</option>
                                            <option value="Dosen">Dosen</option>
                                            <option value="Pimpinan PS">Pimpinan PS</option>
                                            <option value="Mahasiswa">Mahasiswa</option>
                                            <option value="Tendik">Tendik</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @foreach($soalSurvey as $key => $soal)
                                <div class="form-group">
                                    @php
                                        $nilai = $key + 1;
                                        $pilihan = "survey$nilai";
                                    @endphp
                                    <input type="hidden" value="{{ $soal->id }}" name="idsurvey{{ $nilai }}">
                                    <label>{!! $soal->soal !!}</label>
                                    @if($soal->pilihan1 != "")
                                        <div style="margin-top: -20px; margin-left:20px;">
                                            <input type="radio" name="{{ $pilihan }}" id="pilihan1{{ $nilai }}" value="{{ $soal->pilihan1 }}"> <label for="pilihan1{{ $nilai }}">{{ $soal->pilihan1 }}</label>
                                        </div>
                                    @endif

                                    @if($soal->pilihan2 != "")
                                        <div style="margin-left:20px;">
                                            <input type="radio" name="{{ $pilihan }}" id="pilihan2{{ $nilai }}" value="{{ $soal->pilihan2 }}"> <label for="pilihan2{{ $nilai }}">{{ $soal->pilihan2 }}</label>
                                        </div>
                                    @endif

                                    @if($soal->pilihan3 != "")
                                        <div style="margin-left:20px;">
                                            <input type="radio" name="{{ $pilihan }}" id="pilihan3{{ $nilai }}" value="{{ $soal->pilihan3 }}"> <label for="pilihan3{{ $nilai }}">{{ $soal->pilihan3 }}</label>
                                        </div>
                                    @endif

                                    @if($soal->pilihan4 != "")
                                        <div style="margin-left:20px;">
                                            <input type="radio" name="{{ $pilihan }}" id="pilihan4{{ $nilai }}" value="{{ $soal->pilihan4 }}"> <label for="pilihan4{{ $nilai }}">{{ $soal->pilihan4 }}</label>
                                        </div>
                                    @endif

                                    @if($soal->pilihan5 != "")
                                        <div style="margin-left:20px;">
                                            <input type="radio" name="{{ $pilihan }}" id="pilihan5{{ $nilai }}" value="{{ $soal->pilihan5 }}"> <label for="pilihan5{{ $nilai }}">{{ $soal->pilihan5 }}</label>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            <div class="mb-3 row">
                                <div class="col-sm-12">
                                    <div>{!! captcha_img() !!}</div>
                                    <input type="number" class="form-control" name="captcha" id="captcha"
                                        placeholder="Validasi Captcha">
                                </div>
                            </div>
                            <button type="submit">Kirim Survey</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End contact section -->

    <!-- contact-info-section
                       ================================================== -->
    <section class="contact-info-section">
        <div class="container">
            <div class="contact-info-box">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="info-post">
                            <div class="icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="info-content">
                                <p>
                                    Tel: 0411-860837/860132 <br>
                                    E-Mail: <a href="#">info@unismuh.ac.id</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="info-post">
                            <div class="icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="info-content">
                                <p>
                                   Jl. Sultan Alauddin No. 259 Makassar 90221 Sulawesi Selatan
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="info-post">
                            <div class="icon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div class="info-content">
                                <p>
                                    Jam Kerja: Setiap Senin s/d Jumat <br>
                                    Pukul 08:00 s/d 16:00 Wita
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End contact-info section -->
@endsection
