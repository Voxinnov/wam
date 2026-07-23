<!doctype html>
<html class="no-js" lang="en">
    
<head>
        <!-- title -->
        <title>WAM</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="author" content="ThemeZaa">
        <!-- description -->
        <meta name="description" content="POFO is a highly creative, modern, visually stunning and Bootstrap responsive multipurpose agency and portfolio HTML5 template with 25 ready home page demos.">
        <!-- keywords -->
        <meta name="keywords" content="creative, modern, clean, bootstrap responsive, html5, css3, portfolio, blog, agency, templates, multipurpose, one page, corporate, start-up, studio, branding, designer, freelancer, carousel, parallax, photography, personal, masonry, grid, coming soon, faq">
        <!-- favicon -->
        <link rel="shortcut icon" href="images/favicon.png">
        <link rel="apple-touch-icon" href="images/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
        <!-- animation -->
        <link rel="stylesheet" href="css/animate.css" />
        <!-- bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <!-- et line icon --> 
        <link rel="stylesheet" href="css/et-line-icons.css" />
        <!-- font-awesome icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <!-- themify icon -->
        <link rel="stylesheet" href="css/themify-icons.css">
        <!-- swiper carousel -->
        <link rel="stylesheet" href="css/swiper.min.css">
        <!-- justified gallery  -->
        <link rel="stylesheet" href="css/justified-gallery.min.css">
        <!-- magnific popup -->
        <link rel="stylesheet" href="css/magnific-popup.css" />
        <!-- revolution slider -->
        <link rel="stylesheet" type="text/css" href="revolution/css/settings.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="revolution/css/layers.css">
        <link rel="stylesheet" type="text/css" href="revolution/css/navigation.css">
        <!-- bootsnav -->
        <link rel="stylesheet" href="css/bootsnav.css">
        <!-- style -->
        <link rel="stylesheet" href="css/style.css" />
        <!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css" />
        <!--[if IE]>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
		<style>
		.desktop_icon
		{
		display:none;
		}
		@media (max-width:800px)
		{
		.desktop_icon
		{
		display:block;
		}
		header a.logo img {
	{
		max-height: 158px;
height: auto;
margin-top: 0px !important;
	}
		}
		</style>
    </head>
    <body>
        <!-- start header -->
 <?php  
 include('menu.php');
  $Objabt  = new About();
                    $abtContent= $Objabt->getAbout();
 ?>
        <!-- end header -->
        <!-- start page title section -->
        <section class="wow fadeIn bg-light-gray padding-50px-tb sm-padding-30px-tb page-title-small">
            <div class="container">
                <div class="row align-items-center alt-font">
                    <div class="col-lg-8 col-md-6 text-center text-md-left">
                        <!-- start page title -->
                        <h1 class="text-extra-dark-gray font-weight-600 mb-0">About Us</h1>
                        <!-- end page title -->
                      
                    </div>
                    <div class="col-lg-4 col-md-6 sm-margin-10px-top breadcrumb text-small justify-content-center justify-content-md-end">
                        <!-- start breadcrumb -->
                        <ul>
                            <li><a href="index.php" class="text-dark-gray">Home</a></li>
                            <li class="text-dark-gray">About</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section -->
		        <!-- start story section -->
        <section class="wow fadeIn">
            <div class="container"> 
                <div class="row align-items-center">
                   
                    <div class="col-12 col-lg-12 padding-eight-lr wow " data-wow-delay="0.2s">
                       <img src="wam_contrl_panel/upload/about/<?php echo $abtContent[0]['about_wam_img'];?>" alt="" style="max-width: 382px; float:left;margin:15px" class="border-radius-6 w-100">
                       
                        <span class="text-deep-pink alt-font margin-10px-bottom d-inline-block text-medium"><?php echo $abtContent[0]['about_wam_ttl'];?></span>
                        
                  <p style="float:left;text-align:justify" align="justify">
                            <?php echo $abtContent[0]['about_wam_dscrptn'];?></p>
                    </div>
                </div>
               
            </div>
        </section>
        <!-- end story section -->
       
        <!-- start footer --> 
           <?php include('footer.php'); ?>
		   <!-- end footer -->
        <!-- start scroll to top -->
        <a class="scroll-top-arrow" href="javascript:void(0);"><i class="ti-arrow-up"></i></a>
        <!-- end scroll to top -->
        <!-- javascript libraries -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <!--<script type="text/javascript" src="js/modernizr.js"></script>-->
        <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="js/skrollr.min.js"></script>
        <script type="text/javascript" src="js/smooth-scroll.js"></script>
        <script type="text/javascript" src="js/jquery.appear.js"></script>
        <!-- menu navigation -->
        <script type="text/javascript" src="js/bootsnav.js"></script>
        <script type="text/javascript" src="js/jquery.nav.js"></script>
        <!-- animation -->
        <script type="text/javascript" src="js/wow.min.js"></script>
        <!-- page scroll -->
        <script type="text/javascript" src="js/page-scroll.js"></script>
        <!-- swiper carousel -->
        <script type="text/javascript" src="js/swiper.min.js"></script>
        <!-- counter -->
        <script type="text/javascript" src="js/jquery.count-to.js"></script>
        <!-- parallax -->
        <script type="text/javascript" src="js/jquery.stellar.js"></script>
        <!-- magnific popup -->
        <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
        <!-- portfolio with shorting tab -->
        <script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
        <!-- images loaded -->
        <script type="text/javascript" src="js/imagesloaded.pkgd.min.js"></script>
        <!-- pull menu -->
        <script type="text/javascript" src="js/classie.js"></script>
        <script type="text/javascript" src="js/hamburger-menu.js"></script>
        <!-- counter -->
        <script type="text/javascript" src="js/counter.js"></script>
        <!-- fit video -->
        <script type="text/javascript" src="js/jquery.fitvids.js"></script>

        <!-- skill bars -->
        <script type="text/javascript" src="js/skill.bars.jquery.js"></script> 
        <!-- justified gallery -->
        <script type="text/javascript" src="js/justified-gallery.min.js"></script>
        <!--pie chart-->
        <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
        <!-- retina -->
        <script type="text/javascript" src="js/retina.min.js"></script>
       
        <script type="text/javascript" src="js/main.js"></script>
    </body>

</html>