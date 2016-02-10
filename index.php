<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<!--

Grill Template

http://www.templatemo.com/free-website-templates/417-grill test2

-->
<head>
    <meta charset="utf-8">
    <title>Alanya Krommenie</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/templatemo_style.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/flexslider.css">
    <link rel="stylesheet" href="css/testimonails-slider.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/orange.css">
    <link rel="stylesheet" href="css/scrolltop.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/sidebar.css">

    <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <script>
        $(document).ready(function(){
            $("#nav-mobile").html($("#nav-main").html());
            $("#nav-trigger span").click(function(){
                if ($("nav#nav-mobile ul").hasClass("expanded")) {
                    $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                    $(this).removeClass("open");
                } else {
                    $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                    $(this).addClass("open");
                }
            });
        });
    </script>

</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->
<nav class="navbar navbar-static-top" id="positionfixed">
    <div id="main">
        <div class="container-fluid">
            <div id="nav-trigger">
                <span>Menu</span>
            </div>
            <nav id="nav-main">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="Contact.php">Contact</a></li>
                    <li><a href="discounts.php">Acties</a></li>
                    <li><a href="menu.php">Menukaart</a></li>
                    <li><a href="tel:0756409003"><span class="glyphicon glyphicon-earphone"></span> 075-6409003 </a></li>
                    <li><a href="register.php">Registreer</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
                </ul>
            </nav>
            <nav id="nav-mobile"></nav>
        </div>
    </div><!-- #main -->

</nav>
<div id="wrapper">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Winkelwagen</h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>1. Panel content</li>
                        <li>2. Panel content</li>
                        <li>3. Panel content</li>
                        <li>4. Panel content</li>
                        <li><a href="shoppingcart.php">Bestelling afronden</a></li>
                    </ul>
                </div>
            </div>
        </ul>
    </div>
    <div id="page-content-wrapper">
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="logo" style="padding-top: 120px;">
                    <center><img src="images/testlogo4.png"></center>
                </div>
            </div>
            <div class="col-md-12 heading-section">
                <h2>Categorieën</h2>
                <img src="images/under-heading.png" alt="" >
            </div>
        </div>
    </div>
</div>
</header>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 15%;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Log in</h4>
            </div> <!-- /.modal-header -->

            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="uLogin" placeholder="Gebruikersnaam">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                        </div>
                    </div> <!-- /.form-group -->

                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="uPassword" placeholder="Wachtwoord">
                            <label for="uPassword" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                        </div> <!-- /.input-group -->
                    </div> <!-- /.form-group -->

                    <p>Nog geen account? <a href="register.php">Registreer</a></p>
                </form>

            </div> <!-- /.modal-body -->

            <div class="modal-footer">
                <button class="form-control btn orange">Ok</button>

                <div class="progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
                        <span class="sr-only">progress</span>
                    </div>
                </div>
            </div> <!-- /.modal-footer -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /originalsliderplace -->

<div id="latest-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/grillcat1.png" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="single-post.html">Special Houtskool Grill</a></h4>
                            <span>09 Feb 2016</span>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/pizzcat2.png" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="single-post.html">Italiaanse Pizza's</a></h4>
                            <span>09 Feb 2016</span>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/brocat3.png" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="single-post.html">Broodjes &AMP; Dürüm</a></h4>
                            <span>09 Feb 2016</span>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/blogpost4.jpg" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="single-post.html">Healthy Food</a></h4>
                            <span>25 Aug 2084</span>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/blogpost5.jpg" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="single-post.html">Great Breakfast</a></h4>
                            <span>17 Aug 2084</span>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/blogpost6.jpg" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="single-post.html">Fresh Fruit Juice</a></h4>
                            <span>12 Aug 2084</span>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="services">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section">
                    <h2>Free Website Templates</h2>
                    <img src="images/under-heading.png" alt="" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <h4>Make an order</h4>
                    <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu  sagittis vel diam in, malesuada malesuada risus. Aenean a sem leoneski.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
                    <h4>Promotions</h4>
                    <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu  sagittis vel diam in, malesuada malesuada risus. Aenean a sem leoneski.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa fa-bell"></i>
                    </div>
                    <h4>Ready to Serve</h4>
                    <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu  sagittis vel diam in, malesuada malesuada risus. Aenean a sem leoneski.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa fa-heart"></i>
                    </div>
                    <h4>Satisfaction</h4>
                    <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu  sagittis vel diam in, malesuada malesuada risus. Aenean a sem leoneski.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="slider">
    <div class="flexslider">
        <ul class="slides">
            <li>
                <div class="slider-caption">
                    <h1>Spareribs</h1>
                    <p>Donec justo dui, semper vitae aliquam euzali, ornare pretium enim. Maecenas molestie diam
                        <br><br>eget tellus luctus fermentum.</p>
                    <a href="single-post.html">Shop Now</a>
                </div>
                <img src="images/testslide1.png" alt="" />
            </li>
            <li>
                <div class="slider-caption">
                    <h1>Pizza</h1>
                    <p>Nulla id iaculis ligula. Vivamus mattis quam eget urna tincidunt consequat. Nullam
                        <br><br>consectetur tempor neque vitae iaculis. Aliquam erat volutpat.</p>
                    <a href="single-post.html">More Details</a>
                </div>
                <img src="images/testslide2.png" alt="" />
            </li>
            <li>
                <div class="slider-caption">
                    <h1>Healthy Drinks</h1>
                    <p>Maecenas fermentum est ut elementum vulputate. Ut vel consequat urna. Ut aliquet
                        <br><br>ornare massa, quis dapibus quam condimentum id.</p>
                    <a href="single-post.html">Get Ready</a>
                </div>
                <img src="images/slide3.jpg" alt="" />
            </li>
        </ul>
    </div>
</div>


<div id="testimonails">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section">
                    <h2>What Customers Say</h2>
                    <img src="images/under-heading.png" alt="" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="testimonails-slider">
                    <ul class="slides">
                        <li>
                            <div class="testimonails-content">
                                <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                                <h6>Jennifer - <a href="#">Chief Designer</a></h6>
                            </div>
                        </li>
                        <li>
                            <div class="testimonails-content">
                                <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                                <h6>Laureen - <a href="#">Marketing Executive</a></h6>
                            </div>
                        </li>
                        <li>
                            <div class="testimonails-content">
                                <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                                <h6>Tanya - <a href="#">Creative Director</a></h6>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="top-footer">
            <div class="row">
                <div class="col-md-9">
                    <div class="subscribe-form">
                        <span>Get in touch with us</span>
                        <form method="get" class="subscribeForm">
                            <input id="subscribe" type="text" />
                            <input type="submit" id="submitButton" />
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="social-bottom">
                        <span>Follow us:</span>
                        <ul>
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-rss"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-footer">
            <div class="row">
                <div class="col-md-3">
                    <div class="about">
                        <h4 class="footer-title">About Grill</h4>
                        <p>Grill is free HTML5 template by <span class="blue">template</span><span class="green">mo</span> and it is a free responsive bootstrap layout that can be applied for any purpose.
                            <br><br>Credit goes to <a rel="nofollow" href="http://unsplash.com">Unsplash</a> for photos used in this template. Nam commodo erat quis ligula placerat viverra.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="shop-list">
                        <h4 class="footer-title">Shop Categories</h4>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i>New Grill Menu</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Healthy Fresh Juices</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Spicy Delicious Meals</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Simple Italian Pizzas</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Pure Good Yogurts</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Ice-cream for kids</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="recent-posts">
                        <h4 class="footer-title">Recent posts</h4>
                        <div class="recent-post">
                            <div class="recent-post-thumb">
                                <img src="images/recent-post1.jpg" alt="">
                            </div>
                            <div class="recent-post-info">
                                <h6><a href="#">Delicious and Healthy Menus</a></h6>
                                <span>24/12/2084</span>
                            </div>
                        </div>
                        <div class="recent-post">
                            <div class="recent-post-thumb">
                                <img src="images/recent-post2.jpg" alt="">
                            </div>
                            <div class="recent-post-info">
                                <h6><a href="#">Simple and effective meals</a></h6>
                                <span>18/12/2084</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="more-info">
                        <h4 class="footer-title">More info</h4>
                        <p>Sed dignissim, diam id molestie faucibus, purus nisl pretium quam, in pulvinar velit massa id elit.</p>
                        <ul>
                            <li><i class="fa fa-phone"></i>010-020-0340</li>
                            <li><i class="fa fa-globe"></i>123 Dagon Studio, Yakin Street, Digital Estate</li>
                            <li><i class="fa fa-envelope"></i><a href="#">info@company.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <p>
                        	<span>Copyright © 2016 <a href="#">Alanya Krommenie</a>
                            | Design: <a rel="nofollow" href="http://www.templatemo.com" target="_parent"><span class="blue">template</span><span class="green">mo</span></a></span>
            </p>
        </div>

    </div>

</footer>


<!-- The scroll to top feature -->

<div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
<i class="fa fa-2x fa-arrow-circle-up"></i>
  </span>
</div>
<script src="js/vendor/jquery-1.11.0.min.js"></script>
<script src="js/vendor/jquery.gmap3.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/login.js"></script>
<script src="js/scrolltop.js"></script>

</body>
</html>