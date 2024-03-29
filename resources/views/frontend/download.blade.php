@extends('frontend.layouts.app')

@section('content')
    <!-- page-banner-section
       ================================================== -->
    <section class="page-banner-section">
        <div class="container">
            <h1>Download File</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="#">Download File</a></li>
            </ul>
        </div>
    </section>
    <!-- End page-banner-section -->

    <section class="blog-section">
        <div class="container">
            <div class="blog-box">
                <h4>Download Data</h4>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-striped table-bordered  table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="1%">No</th>
                                    <th width="70%">Nama Data</th>
                                    <th class="text-center" >Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $k => $d)
                                    <tr>
                                        <td class="text-center" width="1%">{{ $k + 1 }}</td>
                                        <td class="text-left">{{ $d->nama }}</td>
                                        <td class="text-center">
                                            @if($d->is_form == 1)
                                                <a href="{{ route('form_data', $d->slug) }}" class="btn btn-primary btn-sm"> <b>Isi Form</b></a>
                                            @else
                                                <a href="{{ route('daftar_data', $d->slug) }}" class="btn btn-success btn-sm"> <b>Lihat Data</b></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="blog-box">
                <h4>Download Format</h4>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="datatable2" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="1%">No</th>
                                    <th width="70%">Nama File</th>
                                    <th class="text-center" >Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($download as $k => $j)
                                    <tr>
                                        <td class="text-center" width="1%">{{ $k + 1 }}</td>
                                        <td class="text-left" width="70%">{{ $j->nama }}</td>
                                        <td class="text-center">
                                            <a href="{{ asset("storage/$j->file") }}" class="btn btn-primary btn-sm"> Download</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $('#datatable').DataTable()
        $('#datatable2').DataTable()
    </script>
@endpush
