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
        <meta name="description" content="">
        <!-- keywords -->
        <meta name="keywords" content="">
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
                        <h1 class="text-extra-dark-gray font-weight-600 mb-0">Videos</h1>
                        <!-- end page title -->
                      
                    </div>
                    <div class="col-lg-4 col-md-6 sm-margin-10px-top breadcrumb text-small justify-content-center justify-content-md-end">
                        <!-- start breadcrumb -->
                        <ul>
                            <li><a href="index.php" class="text-dark-gray">Home</a></li>
                            <li class="text-dark-gray">Videos</li>
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
                <div class="row ">
				
				<?php	$act =new Virtualtour();
								$act_yout = $act->getAllVirtualtourDetails();
							

								for($i=0;$i<count($act_yout); $i++)
								{
									?>
                   <!-- start post item -->
                    <div class="col-12 col-lg-4 col-md-6 grid-item margin-30px-bottom text-center text-md-left wow fadeInUp">
                        <div class="blog-post bg-light-gray inner-match-height">
                            <div class="blog-post-images overflow-hidden position-relative">
                                <a href="video_player.php?g_id=<?php echo $act_yout[$i]["virtual_tour_id"];?>">
                                    <img src="wam_contrl_panel/upload/video/<?php echo $act_yout[$i]['virtual_tour_img'];?>" alt="">
                                 <div class="overlay-content text-center d-flex align-items-center justify-content-center" style="" >
                                                <div class="icon-social-small" style="margin-top:-240px;">
                                                    <a href="video_player.php?g_id=<?php echo $act_yout[$i]["virtual_tour_id"];?>" class="text-white-2 text-white-2-hover"  style="color:#fff;font-size:40px"><i class="fa fa-play"></i></a>
                                                </div>
                                            </div>
                                            <div class="team-overlay bg-deep-pink opacity8"></div></a>
                            </div>
                            <div class="post-details padding-15px-all md-padding-20px-all">
                                <a href="video_player.php?g_id=<?php echo $act_yout[$i]["virtual_tour_id"];?>" class="alt-font post-title text-medium text-extra-dark-gray width-100 d-block lg-width-100 margin-15px-bottom"><?php echo $act_yout[$i]["virtual_tour_title"];?></a>
                                <p><?php	$contn= strip_tags($act_yout[$i]["virtual_tour_desc"]);
                            if(strlen($contn)>300)
                            {
                                $subcon=substr($contn, 0, 300);
                                $contn = substr($subcon, 0, strrpos($subcon, ' '));
                            }
                         echo $contn; echo" ...";?></p>
                                <div class="separator-line-horrizontal-full bg-medium-gray margin-20px-tb"></div></p>
                            </div>
                        </div>
                    </div>
                    <!-- end post item --> 
								<?php } ?>
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