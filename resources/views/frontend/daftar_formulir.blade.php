@extends('frontend.layouts.app')

@section('content')
    <section class="page-banner-section">
        <div class="container">
            <h1>Daftar Formulir</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="#">Daftar Formulir</a></li>
            </ul>
        </div>
    </section>

    <section class="blog-section">
        <div class="container">
            <div class="blog-box">
                <h4>Daftar Formulir : {{ $formulir->nama }}</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="1%">No</th>
                                        @for($i = 1; $i <= 9; $i++)
                                            @php
                                                $params = "param$i";
                                                $param_nama = "param_nama$i";
                                            @endphp
                                            @if($formulir->$params == 1 || $formulir->$params == 3)
                                                <th class="text-center">{{ $formulir->$param_nama }}</th>
                                            @endif
                                        @endfor
                                        @for($i = 1; $i <= 5; $i++)
                                            @php
                                                $files = "file$i";
                                                $file_nama = "file_nama$i";
                                            @endphp
                                            @if($formulir->$files == 1)
                                                <th class="text-center">{{ $formulir->$file_nama }}</th>
                                            @endif
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $k => $d)
                                        <tr>
                                            <td class="text-center" width="1%">{{ $k + 1 }}.</td>
                                            @for($i = 1; $i <= 9; $i++)
                                                @php
                                                    $params = "param$i";
                                                    $param_nama = "param_nama$i";
                                                @endphp
                                                @if($formulir->$params == 1 || $formulir->$params == 3)
                                                    <td class="text-center">{{ $d->$params }}</td>
                                                @endif
                                            @endfor
                                            @for($i = 1; $i <= 5; $i++)
                                                @php
                                                    $files = "file$i";
                                                    $file_nama = "file_nama$i";
                                                @endphp
                                                @if($formulir->$files == 1)
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-primary" href="{{ asset("storage/{$d->$files}") }}">Download</a>
                                                    </td>
                                                @endif
                                            @endfor
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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

