<?php

// Define o título
$titulo = '404 - Página não encontrada';

// Define o título na janela do navegador
$this->set( 'title_for_layout', $titulo );

// Define o título na página corrente
$this->set( 'title_for_section', $titulo );

// Define o título como classe na tag <body> Ex.: <body class="bodyInstitucional">
$this->set( 'section', 'Erro' );

// Define o caminho de migalhas (pra cada item dentro do array() cria um item no breadcrumb)
$this->set( 'breadcrumb', array( $titulo ) );

// Define o arquivo CSS
$this->Html->css( 'geral', null, array( 'inline'=>false ) );
$this->Html->css( 'NativeChurch/style.css', null, array( 'inline'=>false ) );
$this->Html->css( 'erro404', null, array( 'inline'=>false ) );

?>

<!DOCTYPE html>
<html lang="en-US">
<head>

<!-- Basic Page Head -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>AGEN - One Page &amp; Multi Page Responsive HTML5 Template</title>
<meta name="description" content="One Page &amp; Multi Page Responsive HTML5 Template">
<meta name="author" content="Loco Theme - locotheme.com">
<meta name="keywords" content="one page, multi page, multipurpose, clean, modern, corporate, company, business, agency, bootstrap, responsive, fullscreen, css3, html5">

<!-- Mobile Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicons -->
<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
<link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

<!-- Css -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/prettyPhoto.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

<!-- Google Fonts -->
<link href="http://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-66631247-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>

<!-- Site Loader -->
<div class="site-loader"><img src="assets/img/loader.gif" alt="Loading"></div>
<!-- Site Loader End -->

<!-- Site Back Top -->
<div class="site-back-top" title="Back to top">
	<i class="fa fa-angle-up"></i>
</div>
<!-- Site Back Top End -->

<!-- Site Navigation -->
<div class="site-nav"></div>
<!-- Site Navigation End -->

<!-- Site Container -->
<div id="site-container" class="site-fullscreen site-sticky">
	<!-- Header -->
	<header id="site-header">
		<div class="header-inner">
			<div class="wrapper clearfix">
				<!-- Header Logo -->
				<div class="header-logo"><a href="index.html"><img src="assets/img/logo.png" alt="Agen"></a></div>
				<!-- Header Logo End -->
				
				<!-- Header Search -->
				<div class="header-search">
					<form action="search-results.html">
						<input name="search" type="text" placeholder="SEARCH">
						<button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<!-- Header Search End -->
				
				<!-- Header Menu -->
				<nav class="header-menu">
					<ul class="nav-default clearfix">
						<li class="active"><a href="index.html">HOME</a></li>
						<li><a href="services-1.html">SERVICES</a>
							<ul>
								<li><a href="services-1.html">SERVICES PAGE 1</a></li>
								<li><a href="services-2.html">SERVICES PAGE 2</a></li>
								<li><a href="services-3.html">SERVICES PAGE 3</a></li>
							</ul>
						</li>
						<li><a href="works-4-col.html">WORKS</a>
							<ul>
								<li><a href="works-4-col.html">WORKS 4 COL</a></li>
								<li><a href="works-3-col.html">WORKS 3 COL</a></li>
								<li><a href="works-2-col.html">WORKS 2 COL</a></li>
								<li><a href="works-detail-1.html">WORKS DETAIL 1</a></li>
								<li><a href="works-detail-2.html">WORKS DETAIL 2</a></li>
							</ul>
						</li>
						<li><a href="clients-1.html">CLIENTS</a>
							<ul>
								<li><a href="clients-1.html">CLIENTS PAGE 1</a></li>
								<li><a href="clients-2.html">CLIENTS PAGE 2</a></li>
							</ul>
						</li>
						<li><a href="team-list-1.html">TEAM</a>
							<ul>
								<li><a href="team-list-1.html">TEAM LIST 1</a></li>
								<li><a href="team-list-2.html">TEAM LIST 2</a></li>
								<li><a href="team-list-3.html">TEAM LIST 3</a></li>
								<li><a href="team-detail.html">TEAM DETAIL LEFT</a></li>
								<li><a href="team-detail-right.html">TEAM DETAIL RIGHT</a></li>
							</ul>
						</li>
						<li><a href="about-1.html">ABOUT</a>
							<ul>
								<li><a href="about-1.html">ABOUT PAGE 1</a></li>
								<li><a href="about-2.html">ABOUT PAGE 2</a></li>
								<li><a href="about-3.html">ABOUT PAGE 3</a></li>
							</ul>
						</li>
						<li><a href="blog-list-masonry-4-col.html">BLOG</a>
							<ul>
								<li><a href="blog-list-masonry-4-col.html">MASONRY 4 COL</a></li>
								<li><a href="blog-list-masonry-2-col.html">MASONRY 2 COL</a></li>
								<li><a href="blog-list-masonry-3-col-sidebar-left.html">MASONRY 3 COL SIDEBAR LEFT</a></li>
								<li><a href="blog-list-masonry-3-col-sidebar-right.html">MASONRY 3 COL SIDEBAR RIGHT</a></li>
								<li><a href="blog-list-sidebar-left.html">LIST SIDEBAR LEFT</a></li>
								<li><a href="blog-list-sidebar-right.html">LIST SIDEBAR RIGHT</a></li>
								<li><a href="blog-single-1.html">SINGLE 1</a></li>
								<li><a href="blog-single-1-sidebar-left.html">SINGLE 1 SIDEBAR LEFT</a></li>
								<li><a href="blog-single-1-sidebar-right.html">SINGLE 1 SIDEBAR RIGHT</a></li>
								<li><a href="blog-single-2.html">SINGLE 2</a></li>
								<li><a href="blog-single-2-sidebar-left.html">SINGLE 2 SIDEBAR LEFT</a></li>
								<li><a href="blog-single-2-sidebar-right.html">SINGLE 2 SIDEBAR RIGHT</a></li>
								<li><a href="blog-single-3-sidebar-left.html">SINGLE 3 SIDEBAR LEFT</a></li>
								<li><a href="blog-single-3-sidebar-right.html">SINGLE 3 SIDEBAR RIGHT</a></li>
								<li><a href="blog-single-4.html">SINGLE 4</a></li>
								<li><a href="blog-single-4-sidebar-left.html">SINGLE 4 SIDEBAR LEFT</a></li>
								<li><a href="blog-single-4-sidebar-right.html">SINGLE 4 SIDEBAR RIGHT</a></li>
							</ul>
						</li>
						<li><a href="#">PAGES</a>
							<ul>
								<li><a href="404.html">404 PAGE</a></li>
								<li><a href="elements.html">ELEMENTS</a></li>
								<li><a href="pricetable.html">PRICE TABLE</a></li>
								<li><a href="search-results.html">SEARCH RESULTS</a></li>
							</ul>
						</li>
						<li><a href="contact-1.html">CONTACT</a>
							<ul>
								<li><a href="contact-1.html">CONTACT PAGE 1</a></li>
								<li><a href="contact-2.html">CONTACT PAGE 2</a></li>
								<li><a href="contact-3.html">CONTACT PAGE 3</a></li>
							</ul>
						</li>
					</ul>
				</nav>
				<!-- Header Menu End -->
				
				<!-- Header Nav -->
				<div class="header-nav"><i class="fa fa-bars fa-2x"></i></div>
				<!-- Header Nav End -->
			</div>
		</div>
	</header>
	<!-- Header End -->
	
	<!-- 404 -->
	<section id="page404">
		<!-- Section Content -->
		<div class="box-grey">
			<div class="wrapper padding-all">
				<div class="row">
					<div class="col-md-12 center">
						<div class="space"></div>
						<h1 class="title-bigbig">404</h1>
						<h2 class="title-big">Sorry! the page your are looking for doesn't exist.</h2>
						<h3>Go out take a run around the block or tap the button below.</h3>
						<div class="space"></div>
						<p><a href="index.html" class="btn btn-default">GO TO THE HOMEPAGE</a></p>
						<div class="space"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Section Content -->
	</section>
	<!-- 404 End -->
		
	<!-- Footer -->
	<footer id="site-footer">
		<div class="wrapper">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="row margin-none">
					<!-- Footer Top About -->
					<div class="col-md-6 col-sm-12 padding-none clearfix">
						<img src="assets/img/logo.png" alt="Agen" class="top-logo">
						<h3 class="text-medium">agen is an international creative agency</h3>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc blandit justo id ipsum facilisis pretium. Integer nisl neque, venenatis vel ornare et, eleifend in metus.
					</div>
					<!-- Footer Top About End -->
					
					<!-- Footer Top Menu -->
					<div class="col-md-6 col-sm-12 padding-none clearfix">
						<nav class="top-menu clearfix">
							<ul class="nav-default pull-right clearfix">
								<li><a href="index.html">HOME</a></li>
								<li><a href="services-1.html">SERVICES</a></li>
								<li><a href="works-4-col.html">WORKS</a></li>
								<li><a href="clients-1.html">CLIENTS</a></li>
								<li><a href="team-list-1.html">TEAM</a></li>
								<li><a href="about-1.html">ABOUT</a></li>
								<li><a href="blog-list-masonry-4-col.html">BLOG</a></li>
								<li><a href="contact-1.html">CONTACT</a></li>
							</ul>
						</nav>
						<!-- Footer Top Menu End -->
						
						<!-- Footer Top Newsletter -->
						<div class="top-newsletter pull-right">
							<form>
								<input type="text" name="newsletter" placeholder="Please enter your email address">
								<button type="button"><i class="fa fa-paper-plane"></i></button>
							</form>
						</div>
						<!-- Footer Top Newsletter End -->
					</div>
				</div>
			</div>
			<!-- Footer Top End -->
			
			<!-- Footer Middle -->
			<div class="footer-middle">
				<div class="row margin-none">
					<!-- Footer Middle Address -->
					<div class="col-md-8 col-sm-12 padding-none">
						<ul class="address-list nav-default text-small clearfix">
							<li><i class="fa fa-map-marker"></i>2st Floor Road London SE1 7AA</li>
							<li><i class="fa fa-phone"></i>+20 7702 1377</li>
							<li><i class="fa fa-mobile-phone"></i>+20 7435 0228</li>
							<li><i class="fa fa-send"></i><a href="mailto:info@agencreative.com">info@agencreative.com</a></li>
						</ul>
					</div>
					<!-- Footer Middle Address End -->
					
					<!-- Footer Middle Social -->
					<div class="col-md-4 col-sm-12 padding-none">
						<ul class="social-icons nav-default pull-right clearfix">
							<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
					<!-- Footer Middle Social End -->
				</div>
			</div>
			<!-- Footer Middle End -->
			
			<!-- Footer Bottom -->
			<div class="footer-bottom">
				<div class="row margin-none">
					<div class="col-md-12 col-sm-12 padding-none">
						<p class="text-medium text-small">© Agen Creative Agency. All Rights Reserved.</p>
					</div>
				</div>
			</div>
			<!-- Footer Bottom End -->
		</div>
	</footer>
	<!-- Footer End -->
</div>
<!-- Site Container End -->

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.carousel.js"></script>
<script src="assets/js/jquery.bxslider.min.js"></script>
<script src="assets/js/jquery.matchHeight.js"></script>
<script src="assets/js/jquery.prettyPhoto.js"></script>
<script src="assets/js/jquery.countTo.js"></script>
<script src="assets/js/jquery.stellar.js"></script>
<script src="assets/js/jquery.fitvids.js"></script>
<script src="assets/js/imagesloaded.pkgd.js"></script>
<script src="assets/js/masonry.pkgd.js"></script>

<!-- Map Scripts -->
<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script src="assets/js/gmap3.min.js"></script>

<!-- Custom Scripts -->
<script src="assets/js/scripts.js"></script>
</body>
</html>