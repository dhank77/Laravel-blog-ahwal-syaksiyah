@extends('frontend.layouts.app')

@section('content')
    <section id="home-section">
        <div id="rev_slider_202_1_wrapper" class="rev_slider_wrapper" data-alias="concept1"
            style="background-color:#000000;padding:0px;">
            <!-- START REVOLUTION SLIDER 5.1.1RC fullscreen mode -->
            <div id="rev_slider_202_1" class="rev_slider" data-version="5.1.1RC">
                <ul>
                    @foreach($banner as $key => $b)
                        <li data-index="rs-67{{ $key }}" data-transition="fade" data-slotamount="default" data-easein="default"
                            data-easeout="default" data-masterspeed="default"
                            data-thumb="{{ asset("storage/$b->gambar") }}" data-rotate="0" data-saveperformance="off"
                            data-title="ideas" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="{{ asset("storage/$b->gambar") }}" alt="" data-bgposition="center center"
                                data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>

                            @if($b->judul != "" && $b->deskripsi != "")
                                <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme" id="slide-67{{ $key }}-layer-1"
                                    data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['130','130','130','130']"
                                    data-width="['530','530','430','420']" data-height="330" data-whitespace="nowrap"
                                    data-transform_idle="o:1;"
                                    data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;"
                                    data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                    data-start="500" data-responsive_offset="on"
                                    style="z-index: 5;background-color:rgba(255, 255, 255, 1.00);border-color:rgba(0, 0, 0, 0);">
                                </div>
                                <div class="tp-caption Woo-TitleLarge tp-resizeme" id="slide-67{{ $key }}-layer-2"
                                    data-x="['left','left','left','left']" data-hoffset="['40','40','40','35']"
                                    data-y="['top','top','top','top']" data-voffset="['170','170','170','170']" data-width="450"
                                    data-height="none" data-whitespace="normal" data-transform_idle="o:1;"
                                    data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;"
                                    data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                    data-start="700" data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 6; min-width: 370px; max-width: 450px; white-space: normal;text-align:left;">
                                    {{ $b->judul }}
                                </div>
                                <div class="tp-caption tp-shape tp-shapewrapper tp-line-shape tp-resizeme" id="slide-67{{ $key }}-layer-3"
                                    data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']"
                                    data-y="['top','top','top','top']" data-voffset="['165','165','165','165']"
                                    data-width="['3','3','3','3']" data-height="100" data-whitespace="nowrap"
                                    data-transform_idle="o:1;"
                                    data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;"
                                    data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                    data-start="700" data-responsive_offset="on" style="z-index: 6;">
                                </div>
                                <div class="tp-caption Woo-Rating tp-resizeme" id="slide-67{{ $key }}-layer-4"
                                    data-x="['left','left','left','left']" data-hoffset="['40','40','40','35']"
                                    data-y="['top','top','top','top']" data-voffset="['286','286','286','286']" data-width="450"
                                    data-height="none" data-whitespace="normal" data-transform_idle="o:1;"
                                    data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;"
                                    data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                    data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on"
                                    style="z-index: 8; min-width: 370px; max-width: 450px; white-space: normal; text-align:left;">
                                    {{ $b->deskripsi }}
                                </div>
                                <a class="tp-caption Woo-ProductInfo rev-btn tp-resizeme"
                                    href="{{ $b->link }}" target="_self"
                                    id="slide-674-layer-6" data-x="['left','left','left','left']"
                                    data-hoffset="['40','40','40','35']" data-y="['top','top','top','top']"
                                    data-voffset="['370','370','370','370']" data-width="none" data-height="none"
                                    data-whitespace="nowrap" data-transform_idle="o:1;"
                                    data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:200;e:Power1.easeInOut;"
                                    data-style_hover="c:rgba(0, 0, 0, 1.00);bg:rgba(221, 221, 221, 1.00);cursor:pointer;"
                                    data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;"
                                    data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                    data-start="1100" data-splitin="none" data-splitout="none" data-actions=''
                                    data-responsive_offset="on">
                                    Selengkapnya
                                </a>
                            @endif

                        </li>
                    @endforeach
                   
                </ul>
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div>
        <!-- END REVOLUTION SLIDER -->
    </section>
    <!-- End home section -->

    <!-- feature-section
               ================================================== -->
    <section class="feature-section">
        <div class="container">
            <div class="feature-box">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-post">
                            <div class="icon-holder">
                                <i class="fa fa-umbrella"></i>
                            </div>
                            <div class="feature-content">
                                <h2>
                                    Online Learn Courses Management
                                </h2>
                                <p>Analyzing negative materials about your brand and addressing them with sentiment
                                    analysis and press.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-post">
                            <div class="icon-holder color2">
                                <i class="fa fa-id-card-o"></i>
                            </div>
                            <div class="feature-content">
                                <h2>
                                    Learn from the masters of the field online
                                </h2>
                                <p>Analyzing negative materials about your brand and addressing them with sentiment
                                    analysis and press.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-post">
                            <div class="icon-holder color3">
                                <i class="fa fa-handshake-o"></i>
                            </div>
                            <div class="feature-content">
                                <h2>
                                    An Introduction-Skills For Learners
                                </h2>
                                <p>Analyzing negative materials about your brand and addressing them with sentiment
                                    analysis and press.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End feature section -->

    <!-- collection-section
               ================================================== -->
    <section class="collection-section">
        <div class="container">
            <div class="title-section">
                <div class="left-part">
                    <span>Categories</span>
                    <h1>Trending Collection</h1>
                </div>
                <div class="right-part">
                    <a class="button-one" href="#">View All Courses</a>
                </div>
            </div>
            <div class="collection-box">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="collection-post">
                            <div class="inner-collection">
                                <img src="upload/collection/web-development.jpg" alt="">
                                <a href="#" class="hover-post">
                                    <span class="title">Web Development</span>
                                    <span class="numb-courses">3 Courses</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="collection-post">
                            <div class="inner-collection">
                                <img src="upload/collection/web-design.jpg" alt="">
                                <a href="#" class="hover-post">
                                    <span class="title">Web Design</span>
                                    <span class="numb-courses">2 Courses</span>
                                </a>
                            </div>
                        </div>
                        <div class="collection-post">
                            <div class="inner-collection">
                                <img src="upload/collection/technology.jpg" alt="">
                                <a href="#" class="hover-post">
                                    <span class="title">Technology</span>
                                    <span class="numb-courses">3 Courses</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="collection-post">
                            <div class="inner-collection">
                                <img src="upload/collection/photography.jpg" alt="">
                                <a href="#" class="hover-post">
                                    <span class="title">Photography</span>
                                    <span class="numb-courses">3 Courses</span>
                                </a>
                            </div>
                        </div>
                        <div class="collection-post">
                            <div class="inner-collection">
                                <img src="upload/collection/design.jpg" alt="">
                                <a href="#" class="hover-post">
                                    <span class="title">Design</span>
                                    <span class="numb-courses">3 Courses</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End collection section -->

    <!-- countdown-section
               ================================================== -->
    <section class="countdown-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>Sambutan Ketua Prodi</h1>
                    <img src="{{ asset('uploads/pengajar/230226054401.jpg') }}" class="rounded" style="width:500px; height:400px;" alt="">
                    <h4>Hasan bin Juhanis, Lc., MS</h4>
                </div>
                <div class="col-lg-6 text-left">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde amet rerum, pariatur, qui totam autem
                    consectetur quos voluptates, dolore quasi ut? Quisquam alias praesentium reprehenderit quo vero nemo
                    illo voluptas doloribus quod iure voluptatibus velit numquam blanditiis tenetur natus incidunt quaerat
                    harum, tempora culpa autem voluptatum aperiam voluptatem! Asperiores ad exercitationem, quo inventore
                    facere dignissimos labore ea sunt sapiente aliquid iusto at tempora qui repellat, vitae officiis odio
                    explicabo a incidunt ducimus laborum laboriosam autem maiores aliquam. Rem dolorum optio necessitatibus
                    ipsam voluptatum vitae minus culpa tenetur expedita, totam officia illo a nesciunt eum doloribus.
                    Voluptatum impedit error reiciendis ducimus.

                </div>
            </div>
        </div>
    </section>
    <!-- End countdown section -->


    <!-- news-section
               ================================================== -->
    <section class="news-section">
        <div class="container">
            <div class="title-section">
                <div class="left-part">
                    <span>Artikel</span>
                    <h1>Berita Terbaru</h1>
                </div>
                <div class="right-part">
                    <a class="button-one" href="/berita">Semua Berita</a>
                </div>
            </div>
            <div class="news-box">
                <div class="row">
                    @foreach (get_5artikel('/') as $key => $artikel)
                        <div class="col-lg-3 col-md-6">
                            <div class="blog-post">
                                <a href="{{ url($artikel->slug) }}"><img src="{{ asset("storage/$artikel->gambar") }}"
                                        alt=""></a>
                                <div class="post-content">
                                    <h2><a href="{{ url($artikel->slug) }}">{{ $artikel->judul }}</a></h2>
                                    <div class="post-meta date">
                                        <i class="material-icons">access_time</i> {{ tanggal_indo($artikel->created_at) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <!-- End news section -->

    <!-- testimonial-section
               ================================================== -->
    <section class="testimonial-section">
        <div class="container">
            <div class="testimonial-box owl-wrapper">

                <div class="owl-carousel" data-num="1">

                    <div class="item">
                        <div class="testimonial-post">
                            <p> “Design-driven, customized and reliable solution for your token development and
                                management system to automate sales processes.”</p>
                            <div class="profile-test">
                                <div class="avatar-holder">
                                    <img src="upload/testimonials/testimonial-avatar-1.jpg" alt="">
                                </div>
                                <div class="profile-data">
                                    <h2>Nicole Alatorre</h2>
                                    <p>Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial-post">
                            <p> “Design-driven, customized and reliable solution for your token development and
                                management system to automate sales processes.”</p>
                            <div class="profile-test">
                                <div class="avatar-holder">
                                    <img src="upload/testimonials/testimonial-avatar-2.jpg" alt="">
                                </div>
                                <div class="profile-data">
                                    <h2>Nicole Alatorre</h2>
                                    <p>Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial-post">
                            <p> “Design-driven, customized and reliable solution for your token development and
                                management system to automate sales processes.”</p>
                            <div class="profile-test">
                                <div class="avatar-holder">
                                    <img src="upload/testimonials/testimonial-avatar-3.jpg" alt="">
                                </div>
                                <div class="profile-data">
                                    <h2>Nicole Alatorre</h2>
                                    <p>Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial-post">
                            <p> “Design-driven, customized and reliable solution for your token development and
                                management system to automate sales processes.”</p>
                            <div class="profile-test">
                                <div class="avatar-holder">
                                    <img src="upload/testimonials/testimonial-avatar-4.jpg" alt="">
                                </div>
                                <div class="profile-data">
                                    <h2>Nicole Alatorre</h2>
                                    <p>Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End testimonial section -->
@endsection
