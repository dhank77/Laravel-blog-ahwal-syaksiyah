@extends('frontend.layouts.app')

@section('content')
    <!-- page-banner-section
       ================================================== -->
    <section class="page-banner-section">
        <div class="container">
            <h1>{{ $data->judul }}</h1>
            <ul class="page-depth">
                <li><a href="/">Home</a></li>
                <li><a href="/">{{ ucfirst($model) }}</a></li>
                <li><a href="{{ $data->slug }}">{{ $data->judul }}</a></li>
            </ul>
        </div>
    </section>
    <!-- End page-banner-section -->

    <!-- blog-section
       ================================================== -->
    <section class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">

                    <div class="blog-box">
                        <div class="blog-post single-post">
                            <div class="post-content">
                                <h1>{{ $data->judul }}</h1>
                                <div class="post-meta date">
                                    <i class="material-icons">access_time</i>{{ jam_indo($data->created_at) }} - {{ tanggal_indo($data->created_at) }}
                                </div>
                                <div class="post-meta user">
                                    <i class="material-icons">perm_identity</i> Oleh <a href="#">Admin Hukum Keluarga</a>
                                </div>
                            </div>
                            <a href="{{ $data->slug }}"><img src="{{ asset("storage/$data->gambar") }}" alt=""></a>
							<div class="post-content">
								{!! $data->isi !!}
							</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-5">
                    <div class="sidebar">
                        <div class="search-widget widget">
                            <form class="search-form">
                                <input type="search" class="search-field" placeholder="Enter keyword...">
                                <button type="submit" class="search-submit">
                                    <i class="material-icons">search</i>
                                </button>
                            </form>
                        </div>
                        <div class="category-widget widget">
                            <h2>Artikel Lainnya</h2>
                            <ul class="category-list">
                                <li><a href="#">Academics</a></li>
                                <li><a href="#">Advertisement</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Campus Life</a></li>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Government</a></li>
                                <li><a href="#">Schools</a></li>
                                <li><a href="#">Uncategorized</a></li>
                            </ul>
                        </div>

                        <div class="tags-widget widget">
                            <h2>Kategori</h2>
                            <ul class="tags-list">
								@foreach(get_kategori() as $key => $value)
                                	<li><a href="/kategori/{{ $value->slug }}">{{ $value->nama }}</a></li>
								@endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
