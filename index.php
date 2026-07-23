<!doctype html>
<html class="no-js" lang="en">
    
<head>
        <!-- title -->
        <title>Weston Associaton of Malayalees</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="author" content="WAM">
        <!-- description -->
        <meta name="description" content="WAM ">
        <!-- keywords -->
        <meta name="keywords" content="WAM">
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
        <!-- justified gallery -->
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
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
	
		max-height: 158px;
height: auto;
margin-top: 0px !important;
	}
		}
		
		/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 99999; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
		</style>
    </head>
    <body>
        <button id="myBtn" style="display:none" >Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      
    </div>
    <div class="modal-body">
        <iframe src="https://www.youtube.com/embed/U9AANriAuBo" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                          
    </div>
    
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
        <!-- start header -->
      <?php
include("autoload.php");
$db     =   new MySql();
$db->connect();	  
$cont	=	new Location();
$get_cont	=	$cont->getLocation();
	  include('header.php');

 $Obj  = new Slider();
                    $sldrContent= $Obj->getAllSliderDetails($s_id);
                  //  print_r($SliderContent);exit;
                //  $sldrCount = count($sldrContent);
               $sldrCount = count($sldrContent);
                
	  ?>
        <!-- end header -->
		<section style="padding: 0px 0px !important;">
		
 <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php  for($i = 0; $i<$sldrCount; $i++)
                  { ?>   
      <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0){ echo 'active'; }?>"></li>
	  <?php } ?>
	      <li data-target="#myCarousel" data-slide-to="<?php echo $i++; ?>" class=""></li>
	      <li data-target="#myCarousel" data-slide-to="<?php echo $i++; ?>" class=""></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
       <?php  for($i = 0; $i<$sldrCount; $i++)
                  { ?>
      <div class="item <?php if($i==0){ echo 'active'; }	?>">
        <img src="wam_contrl_panel/upload/slider/<?php echo $sldrContent[$i]['rithu_slider_photo'];?>" alt="WAM" style="width:100%;">
         <div class="carousel-caption" style="right: 1%;
left: 80%;
padding-bottom: 30%;">
        <img src="images/flag.gif"  style="width:200px" />
      </div>
      </div>
		<?php } ?>
 <div class="item">
        <img src="images/bannerwam6.jpg" alt="WAM" style="width:100%;">
         <div class="carousel-caption" style="
left: 1%;
right: 75%;
padding-bottom: 10%;">
        <img src="images/flag.gif"  style="width:300px" />
      </div>
      </div>
       <div class="item">
        <img src="images/bannerwam7.jpg" alt="WAM" style="width:100%;">
         <div class="carousel-caption" style="left: 1%;
right: 75%;
padding-bottom: 10%;">
        <img src="images/flag.gif"  style="width:300px" />
      </div>
      </div>
    </div>

  
  </div>
		</section>
        <!-- start parallax hero section -->
        <!--<section class="wow fadeIn p-0 parallax sm-background-image-center" data-stellar-background-ratio="0.5" style="background-image: url('images/parallax-bg7.jpg')">
           
            <div class="container-fluid position-relative full-screen">
                <div class="slider-typography">
                    <div class="slider-text-middle-main">
                        
                    </div>
                </div>
            </div>
        </section>-->
        <!-- end parallax hero section -->
        <!-- start about agency section -->
		<?php $Objabt  = new About();
                    $abtContent= $Objabt->getAbout(); ?>
        <section class="wow fadeIn" style="padding-bottom:5px">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 col-md-11 text-center margin-six-bottom ">
                        <div class="alt-font text-medium-gray margin-5px-bottom text-uppercase "><h5><?php echo $abtContent[0]['about_wam_ttl'];?></h5></div>
                        <p class="font-weight-300 text-extra-dark-gray mb-0" align="justify" >   <?php  $contn= strip_tags($abtContent[0]['about_wam_dscrptn']);
                            if(strlen($contn)>650)
                            {
                                $subcon=substr($contn, 0, 650);
                                $contn = substr($subcon, 0, strrpos($subcon, ' '));
                            }
                         echo $contn; echo" ...";?></p>
                    <br><a href="about.php" class="btn btn-transparent-dark-gray btn-rounded btn-small margin-20px-lr sm-margin-5px-tb">Read More</a>
					</div>
                </div>
             
		   </div>            
        </section>
        <!-- end about agency section -->
		 <!-- start portfolioc section -->
        <section class="wow fadeIn bg-light-gray">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 hover-option4 margin-5px-bottom">
					<h5 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 md-width-100" style="text-align:center">Portfolio</h5>
                        
                        <div class="swiper-multy-row-container overflow-hidden">
                            <div class="swiper-wrapper">
                                <!-- start slide item -->
							<?php 	$port = new GalleryList();

            $act_cntnt = $port-> getAllGalleryListDetails();
            $act_cntnt_cont = count($act_cntnt);


            for ($i=0; $i <$act_cntnt_cont ; $i++) { 
                # code...
            
            ?>
                                <div class="swiper-slide grid-item">
                                    <a href="portfolio_details.php?g_id=<?php echo $act_cntnt[$i]["gal_lst_id"];?>">
                                        <figure>
                                            <div class="portfolio-img bg-extra-dark-gray"><img src="wam_contrl_panel/upload/Gallery/<?php echo $act_cntnt[$i]['gal_lst_img'];?>" alt=""/></div>
                                            <figcaption>
                                                <div class="portfolio-hover-main text-center">
                                                    <div class="portfolio-hover-box align-middle">
                                                        <div class="portfolio-hover-content position-relative last-paragraph-no-margin">
                                                            <p class="text-medium-gray text-uppercase text-extra-small">   <?php echo $act_cntnt[$i]['gal_lst_name'];?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>
			<?php } ?>
                                <!-- end slide item -->
                        
                            </div>
                            <!-- start slider pagination -->
                            <div class="swiper-portfolio-prev swiper-button-black-highlight"><i class="ti-arrow-left"></i></div>
                            <div class="swiper-portfolio-next swiper-button-black-highlight"><i class="ti-arrow-right"></i></div>
                            <!-- end slider pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end portfolio section -->
		
		<!-- start section -->
        <section class="wow fadeIn p-0 main-slider mobile-height content-right-slider">
            <div class="container-fluid">
                <div class="row">
                   
                   
				   <div class="swiper-full-screen swiper-container col-12 col-lg-6 px-0 white-move bg-extra-dark-gray text-center sm-padding-20px-tb wow fadeIn">
				   
						<h5 class="text-uppercase alt-font font-weight-700 text-white md-width-100" style="padding-top:20px" >News & Events</h5>
                        <div class="swiper-wrapper">
                      <?php 
					  $newsobj = new Hotel();
					  $news_content = $newsobj->getAllHotelDetails();
					  $total_news = count($news_content);
					  for($i=0;$i<$total_news;$i++)
					  {
						  
					  ?>
                            <!-- start slider item -->
                            <div class="swiper-slide last-paragraph-no-margin">
                                <div class="padding-eighteen-all lg-padding-eight-all md-padding-thirteen-all sm-padding-15px-lr">
                                    <div class="margin-30px-bottom text-center position-relative">
                                    </div>
                                    <p class=" text-white-2" style="font-size:18px"><?php echo $news_content[$i]['hot_name']; ?></p>
                                    <p class="width-90 md-width-95 sm-width-85 mx-auto">
								<?php	$contn= strip_tags($news_content[$i]['hot_details']);
                            if(strlen($contn)>250)
                            {
                                $subcon=substr($contn, 0, 250);
                                $contn = substr($subcon, 0, strrpos($subcon, ' '));
                            }
                         echo $contn; echo" ...";?></p>
									   <a href="news_details.php?g_id=<?php echo $news_content[$i]['hot_id']; ?>" class="btn btn-small btn-white margin-35px-top">Read More</a>
                                 </div>
                            </div>
					  <?php } ?>
                            <!-- end slider item -->
                          
                        </div>
                        <!-- start slider pagination -->
                        <div class="swiper-button-next slider-long-arrow-white"></div>
                        <div class="swiper-button-prev slider-long-arrow-white"></div>
                        <!-- end slider pagination -->
                    </div>
                <div class="col-12 col-lg-6 cover-background md-height-500px sm-height-350px wow fadeIn" style="padding-left:0px;padding-right:0px">
					 <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
  <!--  <ol class="carousel-indicators">
        
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1" class=" "></li>
    </ol>-->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
       <?php 
	   $clsf = new Classified();
	   $cntnt  = $clsf->getAllClassifiedDetails();
	   $total_classifi = count($cntnt);
	  
	  for($i=0;$i<$total_classifi;$i++)
	  {
		  
	   ?>
      <div class="item <?php if($i==0) { echo 'active'; } ?>">
        <img src="wam_contrl_panel/upload/classifies/<?php echo $cntnt[$i]["clas_img"];?>" alt="WAM" style="width:100%;">
      </div>
	  <?php } ?>

    </div>

  
  </div>
					</div>
			   </div>
            </div>
        </section>
        <!-- end section -->
		 <!-- start portfolioc section -->
        <section class="wow fadeIn ">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 hover-option4 margin-5px-bottom">
				 <h5 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 md-width-100">Youth Activity</h5>
                        <span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-table mx-auto width-100px"></span>
                        <div class="swiper-multy-row-container2 overflow-hidden">
                            <div class="swiper-wrapper">
                                <?php 
								$act =new Activity();
								$act_yout = $act->getAllActivityDetailsbycat(1);
								$act_img = new Acimg();

								for($i=0;$i<count($act_yout); $i++)
								{
									$get_img = $act_img->getAcimg_act($act_yout[$i]['activity_id']);
								?>
                                <!-- start slide item -->
                                <div class="swiper-slide grid-item">
                                                                  <div class="blog-post">
                                    <div class="blog-post-images overflow-hidden">
                                        <a href="activities_details.php?g_id=<?php echo $act_yout[$i]["activity_id"];?>">
                                            <img src="wam_contrl_panel/upload/Activity/<?php echo $get_img[0]['activity_img'];?>" alt="" >
                                        </a>
                                    </div>
                                    <div class="post-details padding-40px-all bg-light-gray md-padding-20px-all">
                                        <div class="blog-hover-color"></div>
                                        <a href="activities_details.php?g_id=<?php echo $act_yout[$i]["activity_id"];?>" class="alt-font post-title text-medium text-extra-dark-gray width-90 d-block lg-width-100 margin-5px-bottom">
										<?php echo $act_yout[$i]["activity_title"];?></a>
                                        
                                        <div class="separator-line-horrizontal-full bg-medium-gray margin-seven-tb lg-margin-four-tb"></div>
                                        <p>
											<?php	$contn= strip_tags($act_yout[$i]["activity_dscrptn"]);
                            if(strlen($contn)>300)
                            {
                                $subcon=substr($contn, 0, 300);
                                $contn = substr($subcon, 0, strrpos($subcon, ' '));
                            }
                         echo $contn; echo" ...";?>
										</p>
                                    </div>
                                </div>
                                </div>
                                <!-- end slide item -->
								<?php } ?>
                       <!-- start slide item -->
                            </div>
                            <!-- start slider pagination -->
                            <div class="swiper-portfolio-prev swiper-button-black-highlight"><i class="ti-arrow-left"></i></div>
                            <div class="swiper-portfolio-next swiper-button-black-highlight"><i class="ti-arrow-right"></i></div>
                            <!-- end slider pagination -->
                        </div>
                    </div>
					     <div class="col-12 col-lg-6 hover-option4 margin-5px-bottom">
				 <h5 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 md-width-100">Kids Corner</h5>
                        <span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-table mx-auto width-100px"></span>
                        <div class="swiper-multy-row-container2 overflow-hidden">
                            <div class="swiper-wrapper">
                                
                                    <?php 
								$act =new Activity();
								$act_kids = $act->getAllActivityDetailsbycat(2);
								$act_img = new Acimg();

								for($i=0;$i<count($act_kids); $i++)
								{
									$get_img = $act_img->getAcimg_act($act_kids[$i]['activity_id']);
								?>
                                <!-- start slide item -->
                                <div class="swiper-slide grid-item">
                                                                  <div class="blog-post">
                                    <div class="blog-post-images overflow-hidden">
                                        <a href="activities_details.php?g_id=<?php echo $act_kids[$i]["activity_id"];?>">
                                            <img src="wam_contrl_panel/upload/Activity/<?php echo $get_img[0]['activity_img'];?>" alt="" >
                                        </a>
                                    </div>
                                    <div class="post-details padding-40px-all bg-light-gray md-padding-20px-all">
                                        <div class="blog-hover-color"></div>
                                        <a href="activities_details.php?g_id=<?php echo $act_kids[$i]["activity_id"];?>" class="alt-font post-title text-medium text-extra-dark-gray width-90 d-block lg-width-100 margin-5px-bottom">
										<?php echo $act_kids[$i]["activity_title"];?></a>
                                        
                                        <div class="separator-line-horrizontal-full bg-medium-gray margin-seven-tb lg-margin-four-tb"></div>
                                        <p>
											<?php	$contn= strip_tags($act_kids[$i]["activity_dscrptn"]);
                            if(strlen($contn)>300)
                            {
                                $subcon=substr($contn, 0, 300);
                                $contn = substr($subcon, 0, strrpos($subcon, ' '));
                            }
                         echo $contn; echo" ...";?>
										</p>
                                    </div>
                                </div>
                                </div>
                                <!-- end slide item -->
								<?php } ?>
                            </div>
                            <!-- start slider pagination -->
                            <div class="swiper-portfolio-prev swiper-button-black-highlight"><i class="ti-arrow-left"></i></div>
                            <div class="swiper-portfolio-next swiper-button-black-highlight"><i class="ti-arrow-right"></i></div>
                            <!-- end slider pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end portfolio section -->
		
		        <!-- start team section -->
        <section class="parallax one-second-screen parallax-feature-box md-height-auto" data-stellar-background-ratio="0.3" style="background-image:url('images/homepage-9-parallax-img2.jpg');">
 <div class="opacity-medium bg-extra-dark-gray"></div>           
		   <div class="container">
                <div class="row">
                    <div class="col-12 text-center margin-100px-bottom md-margin-70px-bottom sm-margin-50px-bottom">
                        <p class="alt-font margin-5px-bottom text-uppercase text-medium-gray text-small">Teamwork builds trust</p>
                        <h5 class="text-uppercase alt-font text-white margin-20px-bottom font-weight-700 md-width-100">Office Bearers</h5>
                        <span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-table mx-auto width-100px"></span>
                    </div>
                </div>
                <div class="row">
				  <div class="col-12 p-0">
                        <div class="swiper-container black-move blog-slider swiper-four-slides swiper-pagination-bottom">
                            <div class="swiper-wrapper">
                                <!-- start team item -->
								<?php $team= new OfficeBearers();

										$allteam =$team->getAllOfficeBearersDetails();
										$totalteam=count($allteam);
										for($i=0;$i<$totalteam;$i++)
										{
										?>
                                <div class="swiper-slide padding-15px-lr team-block text-left team-style-1 lg-margin-40px-bottom wow fadeInUp">
                                <figure>
                            <div class="team-image sm-width-100">
                                <img src="wam_contrl_panel/upload/bearers/<?php echo $allteam[$i]['gip_ofc_brers_img']; ?>" alt="">
                            <p class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small"> <?php echo $allteam[$i]['gip_ofc_brers_name']; ?></p>
                                <div class="overlay-content text-center d-flex align-items-end justify-content-center">
                                    <div class="icon-social-small padding-twelve-all width-100">
                                      
                                    <div class="text-small font-weight-500 text-white text-uppercase"><?php echo $allteam[$i]['gip_ofc_brers_name']; ?></div>
                                    <div class="text-extra-small text-uppercase text-medium-gray"><?php echo $allteam[$i]['gip_ofc_brers_titl']; ?></div>
									<div class="separator-line-horrizontal-full bg-deep-pink margin-eleven-tb"></div>
                                      </div>
                                </div>
                                <div class="team-overlay bg-extra-dark-gray opacity8"></div>
                            </div>
                           <!-- <figcaption>
                                <div class="team-member-position margin-20px-top text-center">
                                    <div class="text-small font-weight-500 text-white text-uppercase">Dummy Text</div>
                                    <div class="text-extra-small text-uppercase text-medium-gray">Dummy Text</div>
                                </div>   
                            </figcaption>-->
                        </figure></div>
						
		<?php } ?>
                                <!-- end team item -->
                             
                                <!-- end team item -->                                
                            </div>                        
                            <div class="swiper-pagination swiper-pagination-four-slides"></div>
                        </div>
                    </div>
                  
                </div>
            </div> 
        </section>
        <!-- end team section -->
     <!-- start testimonials section -->
        <section class="wow fadeIn bg-light-gray">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center margin-100px-bottom md-margin-70px-bottom sm-margin-50px-bottom">
                        <p class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">what people says</p>
                        <h5 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 md-width-100">Testimonials</h5>
                        <span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-table mx-auto width-100px"></span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="swiper-container swiper-pagination-bottom black-move blog-slider swiper-three-slides">
                        <div class="swiper-wrapper">
						
						<?php
						$testim = new Testimonial();
						$test_cont = $testim->getAllTestimonial();
						
						for($i=0;$i<count($test_cont);$i++)
						{
						
						?>
                            <!-- start testimonial item -->
                            <div class="col-12 col-lg-4 col-md-6 swiper-slide md-margin-four-bottom" >
                                <div class="margin-half-all bg-white box-shadow-light text-center padding-fourteen-all sm-padding-20px-all" style="max-height:320px">
                                   <p class="md-margin-15px-bottom sm-margin-20px-bottom"><?php echo $test_cont[$i]['testim_contnt']; ?></p>
                                    <span class="text-extra-dark-gray text-small text-uppercase d-block line-height-10 alt-font font-weight-600"><?php echo $test_cont[$i]['testim_name']; ?></span>
                                    <span class="text-light-gray2 text-extra-small text-uppercase text-medium-gray"><?php echo $test_cont[$i]['testim_place']; ?></span>
                                </div>
                            </div>
                            <!-- end testimonial item -->
						<?php } ?>
                          
                        </div>                        
                        <div class="swiper-pagination swiper-pagination-three-slides h-auto"></div>
                    </div>
                </div> 
            </div>
        </section>
        <!-- end testimonial section  -->
      
       
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