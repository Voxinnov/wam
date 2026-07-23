<?php
 ob_start();
session_start();
include("autoload.php");
include("session.php");
$pasid	=	$_SESSION["LogUserID"];
$ad_name	=	$_SESSION["Loguser_name"];
$db		=	new MySql();
$db->connect();
$objA	=	new Admin();

$data	=	$objA->getAdmin($pasid);
$cat	=	new Location();
			     
$get	=	$cat->getLocation();
$g_id	=	$get[0]["cnt_id"];
//print_r($get[0]["abut_title"]);

If(isset($_POST["update"])){
		$address	=	$_POST['address'];
	   $phn	=	$_POST['phn'];
		$contact_map	=	$_POST['contact_map'];
		$email	=	$_POST['email'];
        $fb  =   $_POST['fb'];
        $insta  =   $_POST['insta'];
        $twtr  =   $_POST['twtr'];
		
		
	   if(empty($address)){
	   	header("location:contact.php");
			$message	=	new Message('Enter mandatory fields','error');
			$message->setMessage();
			exit;
	   }else{
		   
	    $inputs	=array('address'=>$address,
				                      'phn'=>$phn,
									  'contact_map'=>$contact_map,
									'email'=>$email,
                                    'fb'=>$fb,
                                    'insta'=>$insta,
                                    'twtr'=>$twtr,
                                    'flkr'=>$flkr,
                                    'blgr'=>$blgr,
                                    'ggl'=>$ggl,
                                    'vimeo'=>$vimeo,
                                    'id'=>1
									  );
					//print_r($inputs);exit;		 
				if($cat->editLocation($inputs)){
				
					
					$message	=	new Message('Gallery Image Updated ','message');
					$message->setMessage();
					header("Location:contact.php");
					exit;
					
				}else{
					
					$message	=	new Message('Unknown error','error');
					$message->setMessage();
				}
				
		
	   }
	  
}
?>
<!DOCTYPE html>


<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
   <title>Contact WAM</title>

    <meta name="description" content="blank page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--Basic Styles-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="#" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/weather-icons.min.css" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300"
          rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" />
    <link href="assets/css/demo.min.css" rel="stylesheet" />
    <link href="assets/css/typicons.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="#" rel="stylesheet" type="text/css" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="assets/js/skins.min.js"></script>
</head>
<!-- /Head -->
<!-- Body -->
<body>
    
    <!-- Navbar -->
	<?php include('header.php') ?>
    <!-- /Navbar -->
    <!-- Main Container -->
    <div class="main-container container-fluid">
        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
				<?php include('menu.php') ?>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->

            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                 
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                           Contact us                       </h1>
                    </div>
                    <!--Header Buttons-->
                    <div class="header-buttons">
                        <a class="sidebar-toggler" href="#">
                            <i class="fa fa-arrows-h"></i>                        </a>
                        <a class="refresh" id="refresh-toggler" href="#">
                            <i class="glyphicon glyphicon-refresh"></i>                        </a>
                        <a class="fullscreen" id="fullscreen-toggler" href="#">
                            <i class="glyphicon glyphicon-fullscreen"></i>                        </a>                    </div>
                    <!--Header Buttons End-->
                </div>
                <!-- /Page Header -->
                <!-- Page Body -->
                <div class="page-body">
				
		
						<div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <form role="form" method="post" enctype="multipart/form-data">
                            <div class="row">
							
						
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="widget">
                                       <div class="widget-header bordered-top bordered-palegreen">
                                            <span class="widget-caption"> Contact</span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="collapse in">
                                              
													
													
													
													<div class="form-group">
                                                        <label for="sminput">contact no:</label>
                                                        <input type="text" name="phn" class="form-control input-sm" id="sminput" value="<?php  echo $get[0]
                                                        ["cnt_no"]; ?>">
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="sminput">Address</label>
                                                     <textarea name="address" class="form-control input-sm" id="sminput"><?php  echo $get[0]
                                                        ["cnt_adrs"]; ?></textarea>
                                                    </div> 
                                                    
													
													
													
													 <div class="form-group">
                                                        <label for="sminput">Email Id:</label>
                                                        <input type="email" name="email" class="form-control input-sm" id="sminput" value="<?php  echo $get[0]
                                                        ["cnt_email"]; ?>">
                                                    </div>
												
													
													<div class="form-group">
                                                        <label for="sminput">Location Map Url:</label>
                                                <input type="text" name="contact_map" class="form-control input-sm" id="sminput" value="<?php  echo  $get[0]["cnt_lcn"];  ?>">
                                                    </div>

                                                    <div class="form-group">
                                                <label for="sminput">FB</label>
                                                <input type="text" name="fb" class="form-control input-sm" 
                                            id="sminput" value="<?php echo $get[0]["cnt_fb"];?>">
                                                    </div>
													 <div class="form-group">
                                                <label for="sminput">Twitter</label>
                                                <input type="text" name="twtr" class="form-control input-sm" 
                                            id="sminput" value="<?php echo $get[0]["cnt_twtr"];?>">
                                                    </div>
                                                    
													<div class="form-group">
                                                <label for="sminput">Instagram</label>
                                                <input type="text" name="insta" class="form-control input-sm" 
                                            id="sminput" value="<?php echo $get[0]["cnt_insta"];?>">
                                                    </div>

                                                
																				
													
													<div class="row">
												
														<div class="col-sm-6">
														<input type="submit" name="update" class="btn btn-primary btn-block" value="update">
														
													</div>
														
													</div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
								    
								
							
							</div>
							</form>
						</div>
					</div>
				</div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
        </div>
        <!-- /Page Container -->
        <!-- Main Container -->
    </div>

    <!--Basic Scripts-->
    <script src="assets/js/jquery-2.0.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>

    <!--Beyond Scripts-->
    <script src="assets/js/beyond.min.js"></script>

    <!--Page Related Scripts-->
    <!--Google Analytics::Demo Only-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date(); a = s.createElement(o),
            m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '../www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-60412744-1', 'auto');
        ga('send', 'pageview');

    </script>
</body>
<!--  /Body -->

<!-- Mirrored from beyondadmin-v1.3.s3-website-us-east-1.amazonaws.com/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 May 2015 06:07:50 GMT -->
</html>
