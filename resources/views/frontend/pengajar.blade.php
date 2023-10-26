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
									
                                    <div class="card">
										<div class="card-footer">
											<a href="#">
												<img src="{{ asset("storage/$value->gambar") }}" alt="foto-{{ $value->nama }}" class="rounded" style="height:400px;">
												<div class="hover-post">
													<h4 class="mb-2">{{ $value->nama }}</h4>
													<span>Jabatan : {{ $value->jabatan }}</span> <br/>
													<span>Keahlian : {{ $value->keahlian }}</span>
												</div>
											</a>
										</div>
										<div class="card-body p-0">
											<div class="d-flex justify-content-center">
												<a target="_blank" href="{{ $value->pddikti }}" class="text-center mr-2 p-2 rounded">
													<img style="width:50px; height:50px;" src="/pddikti.png" alt="pddikti">
													<p>PDDikti</p>
												</a>
												<a target="_blank" href="{{ $value->sinta }}" class="text-center mr-2 p-2">
													<img style="width:50px; height:50px;" src="/sinta.png" alt="sinta">
													<p>Sinta</p>
												</a>
												<a target="_blank" href="{{ $value->scholar }}" class="text-center p-2">
													<img style="width:50px; height:50px;" src="/scholar.png" alt="scholar">
													<p>Scholar</p>
												</a>
											</div>
										</div>
									</div>
                                </div>
                            </div>
                        @endforeach
					</div>
				</div>	
			</div>
		</section>
		<!-- End teachers section -->
@endsection
