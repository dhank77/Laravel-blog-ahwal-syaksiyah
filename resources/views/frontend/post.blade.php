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
                                    <i class="material-icons">access_time</i>{{ jam_indo($data->created_at) }} -
                                    {{ tanggal_indo($data->created_at) }}
                                </div>
                                <div class="post-meta user">
                                    <i class="material-icons">perm_identity</i> Oleh <a href="#">Admin Hukum
                                        Keluarga</a>
                                </div>
                            </div>
                            <div class="tags-share-box d-flex justify-content-end">
                                <ul class="share-list mr-2">
                                    <li><span>Bagikan:</span></li>
                                    <li><a href="{{ $share['facebook'] }}" class="facebook"><i
                                                class="fa fa-facebook-f"></i></a></li>
                                    <li><a href="{{ $share['twitter'] }}" class="twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a href="{{ $share['whatsapp'] }}" class="whatsapp"><i
                                                class="fa fa-whatsapp"></i></a></li>
                                    <li><a href="{{ $share['telegram'] }}" class="telegram"><i
                                                class="fa fa-telegram"></i></a></li>
                                    <li><a href="{{ $share['linkedin'] }}" class="linkedin"><i
                                                class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                            <a href="{{ $data->slug }}"><img src="{{ asset("storage/$data->gambar") }}"
                                    alt=""></a>
                            <div class="post-content">
                                {!! $data->isi !!}
                            </div>
                            <div class="tags-share-box d-flex justify-content-end">
                                <ul class="share-list mr-2">
                                    <li><span>Bagikan:</span></li>
                                    <li><a href="{{ $share['facebook'] }}" class="facebook"><i
                                                class="fa fa-facebook-f"></i></a></li>
                                    <li><a href="{{ $share['twitter'] }}" class="twitter"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a href="{{ $share['whatsapp'] }}" class="whatsapp"><i
                                                class="fa fa-whatsapp"></i></a></li>
                                    <li><a href="{{ $share['telegram'] }}" class="telegram"><i
                                                class="fa fa-telegram"></i></a></li>
                                    <li><a href="{{ $share['linkedin'] }}" class="linkedin"><i
                                                class="fa fa-linkedin"></i></a></li>
                                </ul>
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
                                @foreach (get_5artikel($data->slug) as $key => $artikel)
                                    <li><a href="{{ url($artikel->slug) }}">{{ $artikel->judul }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tags-widget widget">
                            <h2>Kategori</h2>
                            <ul class="tags-list">
                                @foreach (get_kategori() as $key => $value)
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

@push('meta')
    <meta property="og:title" content="{{ $data->judul }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->full() }}" />
    <meta property="og:image" content="{{ asset("storage/$data->gambar") }}" />
    <meta property="og:description" content="{{ strip_tags($data->isi) }}" />
@endpush
