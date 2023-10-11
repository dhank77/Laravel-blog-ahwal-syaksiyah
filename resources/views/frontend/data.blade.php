@extends('frontend.layouts.app')

@section('content')
    <!-- page-banner-section
       ================================================== -->
    <section class="page-banner-section">
        <div class="container">
            <h1>Daftar Data</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="#">Daftar Data</a></li>
            </ul>
        </div>
    </section>
    <!-- End page-banner-section -->

    <section class="blog-section">
        <div class="container">
            <div class="blog-box">
                <h4>Daftar Data : {{ $data->nama }}</h4>
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered table-hover" width="100%">
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
                                            <a href="{{ asset("storage/$d->file") }}" class="btn btn-primary btn-sm"> Lihat Daftar Data</a>
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
    </script>
@endpush
