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
    </head>
    <body>
        <!-- start header -->
       <?php include('menu.php'); ?>
        
        <!-- end header -->
        <!-- start page title section -->
        <section class="wow fadeIn bg-light-gray padding-50px-tb sm-padding-30px-tb page-title-small">
            <div class="container">
                <div class="row align-items-center alt-font">
                    <div class="col-lg-8 col-md-6 text-center text-md-left">
                        <!-- start page title -->
                        <h1 class="text-extra-dark-gray font-weight-600 mb-0">Office Bearers</h1>
                        <!-- end page title -->
                      
                    </div>
                    <div class="col-lg-4 col-md-6 sm-margin-10px-top breadcrumb text-small justify-content-center justify-content-md-end">
                        <!-- start breadcrumb -->
                        <ul>
                            <li><a href="index.php" class="text-dark-gray">Home</a></li>
                            <li class="text-dark-gray">Office Bearers</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title section -->
	   <!-- start team -->
        <section class="wow fadeIn">
            <div class="container-fluid padding-seventeen-lr lg-padding-ten-lr sm-padding-15px-lr">
                <div class="row">
				
					<?php $team= new OfficeBearers();

										$allteam =$team->getAllOfficeBearersDetails();
										$totalteam=count($allteam);
										for($i=0;$i<$totalteam;$i++)
										{
										?>
                    <!-- start team item -->
                    <div class="col-12 col-lg-3 col-md-6 team-block text-left team-style-1 margin-40px-bottom md-margin-seven-bottom sm-margin-30px-bottom wow fadeInRight">
                        <figure>
                            <div class="team-image sm-width-100">
                                <img src="wam_contrl_panel/upload/bearers/<?php echo $allteam[$i]['gip_ofc_brers_img']; ?>" alt="" >
                              <!--  <div class="overlay-content text-center d-flex align-items-end justify-content-center">
                                    <div class="icon-social-small padding-twelve-all width-100">
                                        <span class="text-white-2 text-small d-inline-block m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry dummy text.</span>
                                        <div class="separator-line-horrizontal-full bg-deep-pink margin-eleven-tb"></div>
                                        <a href="http://www.facebook.com/" class="text-white-2" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a href="http://www.twitter.com/" class="text-white-2" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="http://www.plus.google.com/" class="text-white-2" target="_blank"><i class="fab fa-google-plus-g"></i></a>
                                        <a href="http://www.instagram.com/" class="text-white-2" target="_blank"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                                <div class="team-overlay bg-extra-dark-gray opacity8"></div>-->
                            </div>
                            <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-extra-dark-gray text-uppercase"><?php echo $allteam[$i]['gip_ofc_brers_name']; ?></div>
                                    <div class="text-extra-small text-uppercase text-medium-gray"><?php echo $allteam[$i]['gip_ofc_brers_titl']; ?></div>
                                </div>   
                            </figcaption>
                        </figure>
                    </div>
                    <!-- end team item -->
										<?php } ?>
                </div> 
            </div>
        </section>
        <!-- end team section -->
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