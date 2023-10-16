<!doctype html>


<html lang="en" class="no-js">

<head>
    <title>@stack('title') Hukum Keluarga - Universitas Muhammadiyah Makassar </title>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    @stack('meta')

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,500i,600,700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="logo.png">
    <link rel="stylesheet" href="/frontend/css/studiare-assets.min.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/fonts/font-awesome/font-awesome.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/frontend/css/fonts/elegant-icons/style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/frontend/css/fonts/iconfont/material-icons.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/frontend/css/style.css">
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    @stack('css')
</head>

<body>

    <div id="container">
        <header class="clearfix">

            <div class="top-line">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="/">
                                <div class="d-flex align-items-center mt-1">
                                    <img src="/logo.png" style="width:50px; height:50px;" />
                                    <div class="ml-3">
                                        <div class="text-white" style="font-size:20px;"><b>Hukum
                                                Keluarga</b></div>
                                        <div class="text-white" style="font-size:14px; margin-top:0px !important;">
                                            <b>Universitas Muhammadiyah Makassar</b>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-top-line">
                                <ul class="top-menu">
                                    <p><i class="material-icons">phone</i> <span>0411-860837/860132</span></p>
                                    <p><i class="material-icons">email</i> <span>info@unismuh.ac.id</span></p>
                                </ul>
                                <button class="search-icon">
                                    <i class="material-icons open-search">search</i>
                                    <i class="material-icons close-search">close</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form class="search_bar">
                <div class="container">
                    <input type="search" class="search-input" placeholder="What are you looking for...">
                    <button type="submit" class="submit">
                        <i class="material-icons">search</i>
                    </button>
                </div>
            </form>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">

                    <a class="navbar-brand" href="index.html">
                        <img src="images/logo.svg" alt="">
                    </a>

                    <a href="#" class="mobile-nav-toggle">
                        <span></span>
                    </a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="drop-link">
                                <a class="{{ request()->is("/") ? "active" : "" }}" href="/">Home</a>
                            </li>
                            @foreach (get_menu() as $m)
                                <li class="drop-link">
                                    @php
                                        $submenu = get_child_menu($m->id);
                                    @endphp
                                    <a class="{{ request()->is(str_replace("/", "", $m->link) . "*") ? "active" : "" }}" href="{{ $m->link }}">{{ $m->nama }}
                                        @if ($submenu->count() > 0)
                                            <i class="fa fa-angle-down"></i>
                                        @endif
                                    </a>
                                    @if ($submenu->count() > 0)
                                        <ul class="dropdown">
                                            @foreach ($submenu as $sm)
                                                <li><a href="{{ $sm->link }}">{{ $sm->nama }}</li></a>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach

                        </ul>
                        <a href="https://e-pmb.unismuh.ac.id/" class="register-modal-opener login-button"
                            target="_blank"><b>Daftar Disini</b></a>
                    </div>
                </div>
            </nav>

            <div class="mobile-menu">
                <nav class="mobile-nav">
                    <ul class="mobile-menu-list">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        @foreach (get_menu() as $m)
                        <li class="drop-link">
                            @php
                                $submenu = get_child_menu($m->id);
                            @endphp
                            <a class="{{ request()->is(str_replace("/", "", $m->link) . "*") ? "active" : "" }}" href="{{ $m->link }}">{{ $m->nama }}
                            </a>
                            @if ($submenu->count() > 0)
                                <ul class="drop-level">
                                    @foreach ($submenu as $sm)
                                        <li><a href="{{ $sm->link }}">{{ $sm->nama }}</li></a>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                    </ul>
                </nav>
            </div>

        </header>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
        <footer>
            <div class="container">
                @php
                    $footer = get_footer();
                @endphp
                <div class="up-footer">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget text-widget">
                                <a href="/" class="footer-logo"><img src="{{ asset("storage/$footer->komponen1") }}"
                                        alt="footer-gambar" style="width:300px;"></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget text-widget">
                                {!! $footer->komponen2 !!}
                                <h2>Alamat Lengkap </h2>
                                <ul>
                                    <li>
                                        <div class="contact-info-icon">
                                            <i class="material-icons">location_on</i>
                                        </div>
                                        <div class="contact-info-value">{{ $footer->komponen3 }}</div>
                                    </li>
                                    <li>
                                        <div class="contact-info-icon">
                                            <i class="material-icons">phone_android</i>
                                        </div>
                                        <div class="contact-info-value">{{ $footer->komponen4 }}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget quick-widget">
                                <h2>Link Terkait</h2>
                                <ul class="quick-list">
                                    {!! $footer->komponen5 !!}
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="footer-copyright copyrights-layout-default">
                <div class="container">
                    <div class="copyright-inner">
                        <div class="copyright-cell"> &copy; 2023 <span class="highlight text-white">Hukum Keluarga</span>. Developed by
                            Universitas Muhammadiyah Makassar.</div>
                        <div class="copyright-cell">
                            <ul class="studiare-social-links">
                                <li><a href="{{ $footer->komponen6 }}" target="_blank" class="facebook"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="{{ $footer->komponen7 }}" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="{{ $footer->komponen8 }}" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="{{ $footer->komponen9 }}" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="/frontend/js/studiare-plugins.min.js"></script>
    <script src="/frontend/js/jquery.countTo.js"></script>
    <script src="/frontend/js/popper.js"></script>
    <script src="/frontend/js/bootstrap.min.js"></script>
    <script
        src="http://maps.google.com/maps/api/js?key=AIzaSyCiqrIen8rWQrvJsu-7f4rOta0fmI5r2SI&amp;sensor=false&amp;language=en">
    </script>
    <script src="/frontend/js/gmap3.min.js"></script>
    <script src="/frontend/js/script.js"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        var tpj = jQuery;
        var revapi202;
        tpj(document).ready(function() {
            if (tpj("#rev_slider_202_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_202_1");
            } else {
                revapi202 = tpj("#rev_slider_202_1").show().revolution({
                    sliderType: "standard",
                    jsFileLocation: "frontend/js/",
                    dottedOverlay: "none",
                    delay: 5000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        onHoverStop: "off",
                        arrows: {
                            enable: true,
                            style: 'gyges',
                            left: {
                                container: 'slider',
                                h_align: 'left',
                                v_align: 'center',
                                h_offset: 20,
                                v_offset: -60
                            },

                            right: {
                                container: 'slider',
                                h_align: 'right',
                                v_align: 'center',
                                h_offset: 20,
                                v_offset: -60
                            }
                        },
                        touch: {
                            touchenabled: "on",
                            swipe_threshold: 75,
                            swipe_min_touches: 50,
                            swipe_direction: "horizontal",
                            drag_block_vertical: false
                        },
                        bullets: {

                            enable: false,
                            style: 'persephone',
                            tmp: '',
                            direction: 'horizontal',
                            rtl: false,

                            container: 'slider',
                            h_align: 'center',
                            v_align: 'bottom',
                            h_offset: 0,
                            v_offset: 55,
                            space: 7,

                            hide_onleave: false,
                            hide_onmobile: false,
                            hide_under: 0,
                            hide_over: 9999,
                            hide_delay: 200,
                            hide_delay_mobile: 1200
                        }
                    },
                    responsiveLevels: [1210, 1024, 778, 480],
                    visibilityLevels: [1210, 1024, 778, 480],
                    gridwidth: [1210, 1024, 778, 480],
                    gridheight: [700, 700, 600, 600],
                    lazyType: "none",
                    parallax: {
                        type: "scroll",
                        origo: "slidercenter",
                        speed: 1000,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                        type: "scroll",
                    },
                    shadow: 0,
                    spinner: "off",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    fullScreenAutoWidth: "off",
                    fullScreenAlignForce: "off",
                    fullScreenOffsetContainer: "",
                    fullScreenOffset: "0px",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
        }); /*ready*/
    </script>
    <script src="{{ asset('js/share.js') }}"></script>
    @if (session()->has('success'))
        <script>
            Swal.fire({
                title: "{{ session('success') }}",
                icon: "success",
            })
        </script>
    @endif
    @if (session()->has('error'))
        <script src="/frontend/js/studiare-plugins.min.js"></script>
    @endif
    @stack('js')

</body>

</html>
