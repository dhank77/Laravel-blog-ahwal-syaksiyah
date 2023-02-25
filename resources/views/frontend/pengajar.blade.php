@extends('frontend.layouts.app')

@section('content')
    <!-- page-banner-section 
			================================================== -->
		<section class="page-banner-section">
			<div class="container">
				<h1>Staff Pengajar</h1>
				<ul class="page-depth">
					<li><a href="/">Home</a></li>
					<li><a href="#">Staff Pengajar</a></li>
				</ul>
			</div>
		</section>
		<!-- End page-banner-section -->

		<!-- teachers-section 
			================================================== -->
		<section class="teachers-section">
			<div class="container">
				<div class="teachers-box">
					<div class="row">
                        @foreach($pengajar as $key => $value)
                            <div class="col-lg-4 col-md-4">
                                <div class="teacher-post">
                                    <a href="#">
                                        <img src="{{ asset("storage/$value->gambar") }}" alt="foto-{{ $value->nama }}">
                                        <div class="hover-post">
                                            <h4 class="mb-2">{{ $value->nama }}</h4>
                                            <span>Jabatan : {{ $value->jabatan }}</span> <br/>
                                            <span>Keahlian : {{ $value->keahlian }}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
					</div>
				</div>	
			</div>
		</section>
		<!-- End teachers section -->
@endsection
