@extends('layouts.master')
@section('title')
    Database Alumni
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Database Alumni
        @endslot
        @slot('title')
            Tambah Database Alumni
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
                        <form method="post" action="{{ route('alumni.store') }}" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id" value="{{ $alumni->id }}">
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 form-label align-self-center mb-lg-0">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input required type="text" class="form-control" name="nama" id="nama" autocomplete="false"
                                        placeholder="Nama" value="{{ $alumni->nama }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nim" class="col-sm-2 form-label align-self-center mb-lg-0">NIM <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input required type="text" class="form-control" name="nim" id="nim" autocomplete="false"
                                        placeholder="NIM" value="{{ $alumni->nim }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tempat_lahir" class="col-sm-2 form-label align-self-center mb-lg-0">Tempat Lahir</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" autocomplete="false"
                                        placeholder="Tempat Lahir" value="{{ $alumni->tempat_lahir }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tanggal_lahir" class="col-sm-2 form-label align-self-center mb-lg-0">Tanggal Lahir</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" autocomplete="false"
                                        placeholder="Tanggal Lahir" value="{{ $alumni->tanggal_lahir }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="angkatan" class="col-sm-2 form-label align-self-center mb-lg-0">Angkatan</label>
                                <div class="col-sm-4">
                                    <input type="number" min="0" class="form-control" name="angkatan" id="angkatan" autocomplete="false"
                                        placeholder="Angkatan" value="{{ $alumni->angkatan }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tahun_lulus" class="col-sm-2 form-label align-self-center mb-lg-0">Tahun Lulus</label>
                                <div class="col-sm-4">
                                    <input type="number" min="0" class="form-control" name="tahun_lulus" id="tahun_lulus" autocomplete="false"
                                        placeholder="Tahun Lulus" value="{{ $alumni->tahun_lulus }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="asal_daerah" class="col-sm-2 form-label align-self-center mb-lg-0">Asal Daerah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="asal_daerah" id="asal_daerah" autocomplete="false"
                                        placeholder="Asal Daerah" value="{{ $alumni->asal_daerah }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 form-label align-self-center mb-lg-0">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" id="alamat" autocomplete="false"
                                        placeholder="Alamat" value="{{ $alumni->alamat }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pekerjaan" class="col-sm-2 form-label align-self-center mb-lg-0">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" autocomplete="false"
                                        placeholder="Pekerjaan" value="{{ $alumni->pekerjaan }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="no_hp" class="col-sm-2 form-label align-self-center mb-lg-0">Nomor HP</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" name="no_hp" id="no_hp" autocomplete="false"
                                        placeholder="Nomor HP" value="{{ $alumni->no_hp }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-sm-2 form-label align-self-center mb-lg-0">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" autocomplete="false"
                                        placeholder="Email" value="{{ $alumni->email }}">
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
            </div>
        </div>
    </div>
@endsection