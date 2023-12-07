@extends('frontend.layouts.app')

@section('content')
    <!-- page-banner-section
       ================================================== -->
    <section class="page-banner-section">
        <div class="container">
            <h1>Daftar Alumni</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="#">Daftar Alumni</a></li>
            </ul>
        </div>
    </section>
    <!-- End page-banner-section -->

    <section class="blog-section">
        <div class="container">
            <div class="blog-box">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-striped table-bordered  table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="1%">No</th>
                                    <th width="20%">Nama</th>
                                    <th width="10%">NIM</th>
                                    <th width="10%">Angkatan</th>
                                    <th width="10%">Tahun Lulus</th>
                                    <th width="10%">Asal Daerah</th>
                                </tr>
                            </thead>
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
        $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: '{{ route("json_daftar_alumni") }}',
                "lengthMenu": [
                    [10, 25, 50],
                    [10, 25, 50]
                ],
                columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                }, {
                    data: "nama"
                }, {
                    data: "nim"
                }, {
                    data: "angkatan"
                }, {
                    data: "tahun_lulus"
                }, {
                    data: "asal_daerah"
                }],
        })
    </script>
@endpush
