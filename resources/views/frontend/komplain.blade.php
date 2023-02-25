@extends('frontend.layouts.app')

@section('content')
    <section class="contact-section">
        <div class="container">
            <div class="contact-box">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Form Komplain</h1>
                        <p>Silahkan mengisi form Saran dan kritik dibawah dengan baik dan benar.</p>
                        <form id="contact-form" method="POST" action="{{ route("komplain.store") }}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input name="email" class="form-control" type="text" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input name="nama" class="form-control" type="text" placeholder="Nama">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input name="no_hp" class="form-control" type="number"
                                            placeholder="No.Wahtasapp Aktif">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select name="posisi" class="form-control">
                                            <option value="">-Pilih Posisi-</option>
                                            <option value="Dosen">Dosen</option>
                                            <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                            <option value="Mahasiswa">Mahasiswa</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        <p class="help-block">Silahkan Pilih posisi Anda di Unismuh</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="isi" class="form-control required" rows="5" placeholder="Kompalain Pelanggan"></textarea>
                                <p class="help-block">Masukan dan saran demi peningkatan mutu Universitas Muhammadiyah
                                    Makassar</p>
                            </div>
                            <button type="submit">Kirim Komplain</button>
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
