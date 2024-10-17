@extends('layouts.master')
@section('title')
    Detail Survey
@endsection

@section('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Data Detail Survey
        @endslot
        @slot('title')
            Modul Detail Survey
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-start">
                        Nama {{ $survey->nama }} </br>
                        Posisi {{ $survey->posisi }} </br>
                        NIP/NIK/NIM {{ $survey->nim }} </br>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Respon Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soalSurvey as $k => $soal)
                                @for($i = 1; $i <= 20; $i++)
                                    @php
                                        $surveyid = $soal->id;
                                        $jawabanid = "idsurvey$i";
                                        $jawaban = "survey$i";
                                    @endphp
                                    @if($surveyid == $survey->$jawabanid)
                                        <tr>
                                            <td>{!! $soal->soal !!}</td>
                                            <td>{{ $survey->$jawaban }}</td>
                                        </tr>
                                    @endif
                                @endfor
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/datatables.net/datatables.net.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/datatables.net-buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
