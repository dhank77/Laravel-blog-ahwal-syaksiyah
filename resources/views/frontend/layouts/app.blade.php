<!doctype html>


<html lang="en" class="no-js">

<head>
    <title>Studiare</title>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,500i,600,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/frontend/css/studiare-assets.min.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/fonts/font-awesome/font-awesome.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/frontend/css/fonts/elegant-icons/style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/frontend/css/fonts/iconfont/material-icons.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/frontend/css/style.css">

</head>

<body>

    <div id="container">
        <header class="clearfix">

            <div class="top-line">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center mt-1">
                                <img src="/logo.png" style="width:50px; height:50px;" />
                                <div class="ml-3">
                                    <div class="text-white" style="font-size:20px;"><b>Hukum
                                            Keluarga</b></div>
                                    <div class="text-white" style="font-size:14px; margin-top:0px !important;">
                                        <b>Universitas Muhammadiyah Makassar</b></div>
                                </div>
                            </div>
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
                                <a class="active" href="/">Home</a>
                            </li>
                            @foreach (get_menu() as $m)
                                <li class="drop-link">
                                    @php
                                        $submenu = get_child_menu($m->id);
                                    @endphp
                                    <a href="{{ $m->link }}">{{ $m->nama }}
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
                <div class="search-form-box">
                    <form class="search-form">
                        <input type="search" class="search-field" placeholder="Enter keyword...">
                        <button type="submit" class="search-submit">
                            <i class="material-icons open-search">search</i>
                        </button>
                    </form>
                </div>
                <div class="shopping-cart-box">
                    <a class="shop-icon" href="/frontend/cart.html">
                        <i class="material-icons">shopping_cart</i>
                        Cart
                        <span class="studiare-cart-number">0</span>
                    </a>
                </div>
                <nav class="mobile-nav">
                    <ul class="mobile-menu-list">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="drop-link">
                            <a href="#">Pages</a>
                            <ul class="drop-level">
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="pricing.html">Pricing Packages</a></li>
                                <li><a href="portfolio.html">Portfolio</a></li>
                                <li><a href="single-project.html">Portfolio Single</a></li>
                                <li><a href="teachers.html">Teachers</a></li>
                                <li><a href="single-teacher.html">Teacher Single</a></li>
                                <li><a href="/frontend/cart.html">Shopping Cart</a></li>
                                <li><a href="/frontend/checkout.html">Checkout</a></li>
                                <li><a href="single-teacher.html">Teacher Single</a></li>
                                <li class="drop-link">
                                    <a href="#">Submenu Level 1</a>
                                    <ul class="drop-level">
                                        <li><a href="#">Submenu Level 2</a></li>
                                        <li class="drop-link">
                                            <a href="#">Submenu Level 2</a>
                                            <ul class="drop-level">
                                                <li><a href="#">Submenu Level 3</a></li>
                                                <li><a href="#">Submenu Level 3</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Submenu Level 2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="drop-link">
                            <a href="blog.html">Blog</a>
                            <ul class="drop-level">
                                <li class="drop-link">
                                    <a href="blog-list.html">Blog List</a>
                                    <ul class="drop-level">
                                        <li><a href="blog-list-leftsidebar.html">Blog List - Sidebar Left</a></li>
                                        <li><a href="blog-list-rightsidebar.html">Blog List - Sidebar Right</a></li>
                                        <li><a href="blog-list.html">No Sidebar</a></li>
                                    </ul>
                                </li>
                                <li class="drop-link">
                                    <a href="blog-grid-3.html">Blog Grid</a>
                                    <ul class="drop-level">
                                        <li><a href="blog-grid-3.html">3 Column</a></li>
                                        <li><a href="blog-grid-4.html">4 Column</a></li>
                                        <li><a href="blog-grid-leftsidebar.html">Sidebar Left</a></li>
                                        <li><a href="blog-grid-rightsidebar.html">Sidebar Right</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">Blog Classic</a></li>
                                <li><a href="single-post.html">Post Single</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/frontend/courses.html">Courses</a>
                        </li>
                        <li>
                            <a href="events.html">Events</a>
                        </li>
                        <li>
                            <a href="/frontend/contact.html">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </header>

        @yield('content')
        <!-- footer
   ================================================== -->
        <footer>
            <div class="container">

                <div class="up-footer">
                    <div class="row">

                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget text-widget">
                                <a href="index.html" class="footer-logo"><img src="images/logo_light.svg"
                                        alt=""></a>
                                <p>We named our theme Studiare because to us,<br> the best brands are simple ones.
                                    Brands thrive<br> on their ability to be understood.</p>
                                <ul>
                                    <li>
                                        <div class="contact-info-icon">
                                            <i class="material-icons">location_on</i>
                                        </div>
                                        <div class="contact-info-value">127 Elizabeth Street, NY New York</div>
                                    </li>
                                    <li>
                                        <div class="contact-info-icon">
                                            <i class="material-icons">phone_android</i>
                                        </div>
                                        <div class="contact-info-value">+55-11-3097-0508</div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget quick-widget">
                                <h2>Quick Links</h2>
                                <ul class="quick-list">
                                    <li><a href="/frontend/contact.html">Contact</a></li>
                                    <li><a href="pricing.html">Pricing Packages</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="/frontend/courses.html">Courses</a></li>
                                    <li><a href="blog.html">News</a></li>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="#">Sample Page</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widget subscribe-widget">
                                <h2>Newsletter</h2>
                                <p>Don’t miss anything, sign up now and keep informed about our company.</p>
                                <div class="newsletter-form">
                                    <input class="form-control" type="email" name="EMAIL"
                                        placeholder="Enter Your E-mail" required="">
                                    <input type="submit" value="Subscribe">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="footer-copyright copyrights-layout-default">
                <div class="container">
                    <div class="copyright-inner">
                        <div class="copyright-cell"> &copy; 2019 <span class="highlight">Studiare</span>. Created by
                            CodeBean Team.</div>
                        <div class="copyright-cell">
                            <ul class="studiare-social-links">
                                <li><a href="#" class="facebook"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
        <!-- End footer -->

    </div>
    <!-- End Container -->


    <script src="/frontend/js/studiare-plugins.min.js"></script>
    <script src="/frontend/js/jquery.countTo.js"></script>
    <script src="/frontend/js/popper.js"></script>
    <script src="/frontend/js/bootstrap.min.js"></script>
    <script
        src="http://maps.google.com/maps/api/js?key=AIzaSyCiqrIen8rWQrvJsu-7f4rOta0fmI5r2SI&amp;sensor=false&amp;language=en">
    </script>
    <script src="/frontend/js/gmap3.min.js"></script>
    <script src="/frontend/js/script.js"></script>

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


</body>

</html>
