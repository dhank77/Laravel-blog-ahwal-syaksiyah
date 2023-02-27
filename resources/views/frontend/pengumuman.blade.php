@extends('frontend.layouts.app')

@section('content')
    <!-- page-banner-section
       ================================================== -->
    <section class="page-banner-section">
        <div class="container">
            <h1>Seluruh Pengumuman</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="#">Seluruh Pengumuman</a></li>
            </ul>
        </div>
    </section>
    <!-- End page-banner-section -->

    <section class="blog-section">
        <div class="container">
            <div class="blog-box">
                <div class="row">
					@foreach($pengumuman as $key => $value)
						<div class="col-lg-4 col-md-6">
							<div class="blog-post">
								<a href="{{ url($value->slug) }}"><img src="{{ asset("storage/$value->gambar") }}" style="width:385px; height:200px;" alt=""></a>
								<div class="post-content" style="height:170px;">
									<h2><a href="{{ url($value->slug) }}">{{ str_limit($value->judul, 70) }}</a></h2>
									<div class="post-meta date">
										<i class="material-icons">access_time</i> {{ tanggal_indo($value->created_at) }}
									</div>
								</div>
							</div>
						</div>
					@endforeach
                </div>

				{{ $pengumuman->links() }}

            </div>

        </div>
    </section>
@endsection
