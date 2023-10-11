@extends('layouts.master')
@section('title')
Buat Surat
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Modul Buat Surat
        @endslot
        @slot('title')
            Tambah Buat Surat
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Buat Surat</h4>
                </div>
                <div class="card-body">
                    <div class="general-label">
                        <form method="post" action="{{ route('persuratan.param_store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $dataDetail->id }}">
                            <input type="hidden" name="data_id" value="{{ $data->id }}">
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama" value="{{ $dataDetail->nama }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">NIM</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nim" id="nim"
                                        placeholder="NIM" value="{{ $dataDetail->nim }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Param1</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="param1" id="param1"
                                        placeholder="Param1" value="{{ $dataDetail->param1 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Param2</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="param2" id="param2"
                                        placeholder="Param2" value="{{ $dataDetail->param2 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Param3</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="param3" id="param3"
                                        placeholder="Param3" value="{{ $dataDetail->param3 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Param4</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="param4" id="param4"
                                        placeholder="Param4" value="{{ $dataDetail->param4 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Param5</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="param5" id="param5"
                                        placeholder="Param5" value="{{ $dataDetail->param5 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Param6</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="param6" id="param6"
                                        placeholder="Param6" value="{{ $dataDetail->param6 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Param7</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="param7" id="param7"
                                        placeholder="Param7" value="{{ $dataDetail->param7 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Param8</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="param8" id="param8"
                                        placeholder="Param8" value="{{ $dataDetail->param8 }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="judul" class="col-sm-2 form-label align-self-center mb-lg-0">Param9</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="param9" id="param9"
                                        placeholder="Param9" value="{{ $dataDetail->param9 }}">
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
    </div>
@endsection
