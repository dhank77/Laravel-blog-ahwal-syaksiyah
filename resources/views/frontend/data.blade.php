@extends('frontend.layouts.app')

@section('content')
    <section class="page-banner-section">
        <div class="container">
            <h1>Daftar Data</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="#">Daftar Data</a></li>
            </ul>
        </div>
    </section>

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
                                    @if($data->is_nama == 1)
                                        <th>Nama</th>
                                    @endif
                                    @if($data->is_nim == 1)
                                        <th>NIM</th>
                                    @endif
                                    @for($i = 1; $i <= 9; $i++)
                                        @php
                                            $params = "param$i";
                                            $param_nama = "param_nama$i";
                                        @endphp
                                        @if($data->$params == 1)
                                            <th class="text-center">{{ $data->$param_nama }}</th>
                                        @endif
                                    @endfor
                                    <th class="text-center" >Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataDetail as $k => $d)
                                    <tr>
                                        <td class="text-center" width="1%">{{ $k + 1 }}.</td>
                                        @if($data->is_nama == 1)
                                            <th class="text-left">{{ $d->nama }}</th>
                                            @endif
                                        @if($data->is_nim == 1)
                                            <th class="text-left">{{ $d->nim }}</th>
                                        @endif
                                        @for($i = 1; $i <= 9; $i++)
                                            @php
                                                $params = "param$i";
                                                $param_nama = "param_nama$i";
                                            @endphp
                                            @if($data->$params == 1)
                                                <td class="text-center">{{ $d->$params }}</td>
                                            @endif
                                        @endfor
                                        <td class="text-center">
                                            <a href="{{ route('create_pdf', base64_encode($d->id)) }}" class="btn btn-primary btn-sm"> Download</a>
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

