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
$g_id=	$_GET["g_id"];

$data	=	$objA->getAdmin($pasid);
$gal = new GalleryList();
$records	=	$gal->getAllGalleryListDetails();
//print_r($type); exit;

$totalRecords	=	count($records);
$cat	=	new Gallery ();
			     
$get	=	$cat->getGallery($g_id);
//print_r($get);

If(isset($_POST["update"])){
	  
	     $folder	    =	$_POST['folder']; 
	 
		$status	    =	$_POST['status'];
	   $photo	    =	$_FILES["upload"]["name"];
      //print_r( $photo);exit;
	     $absDirName	=	dirname(__FILE__).'/upload/Gallery'; 
			$relDirName	=	'upload/Gallery'; 
	
		$obj	=	new Uploader($absDirName.'/');
  		 $fileName = $name;
		 $fileName = seoTitle($fileName ); 
  		$obj->setSequence($fileName);
 	 	$obj->setExtensions(array('png','gif','jpg','jpeg'));
 	  	$obj->setMaxSize(20);
	
	
	   if(empty($folder)){
	   	header("location:edit_gallery.php?n_id=$g_id");
			$message	=	new Message('Enter mandatory fields','error');
			$message->setMessage();
			exit; 
	   }else{
		  if(empty($file))
		  {
			$image=$_POST['hidding']; 
            //print_r($image);
		  }
		  else{
	   	if($obj->uploadFile("upload")){ 
		         $image	=	$obj->getUploadName();
				 $cat->updateGalleryImage($g_id,$image);	
				 unlink('upload/Gallery/'.$get[0]['rithu_gal_img']);
			    
				 }
		  }
		  
		
	    $inputs	=array(
							'folder'=>$folder,
							
							'status'=>$status,
                             'photo'=>$photo,
							'id'=>$g_id
							 );
       //print_r($inputs); exit;
									 
				if($cat->editGallery ($inputs)){
				
					
					$message	=	new Message('Gallery Image Updated ','message');
					$message->setMessage();
					header("Location:gallery.php");
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
   <title> Gallery </title>

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
                           Update Gallery                       </h1>
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
                           
                            <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="widget">
                                        <div class="widget-header bordered-top bordered-palegreen">
                                            <span class="widget-caption"> Update Gallery  </span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="collapse in">
                                                <form role="form" method="post" enctype="multipart/form-data">
                                                   <div class="form-group">
                                                        <label for="sminput">Gallery Name</label>
                                                      	<select name="folder" class="form-control select2" style="width: 100%;">
															 	<?php 
									for($i=0;$i<$totalRecords;$i++){
										?>
																				<option value="<?php echo $records[$i]["gal_lst_id"];?>" <?php if($get[0]['rithu_gal_fldr']== $records[$i]["gal_lst_id"]){?> selected="selected"<?php }?> ><?php echo $records[$i]["gal_lst_name"];?></option>
																				
																	<?php 
										 } 
								?>	 
			   
															</select>
															</div>
                                                  
													 
													 <div class="form-group" >
                                                        <label for="sminput">Image<br> Size (503 x 336) </label></label><br>
														<img src="upload/Gallery/<?php echo $get[0]["rithu_gal_img"];?>" width="100" height="80">
												  
                                                        <input type="file" name="upload" class="" id="sminput" >
															<input type="hidden" value="<?php echo $get[0]["rithu_gal_img"];?>" name="hidding">
                                                    </div>
													
													<div class="row">
													<div class="col-sm-1">
													 <label>Status</label>
													</div>
														<div class="col-sm-5">
															<div class="input-group">
															<select name="status" class="form-control select2" style="width: 100%;">
															 
																	<option value="1" <?php if($get[0]['rithu_gal_status']== 1){?> selected="selected"<?php }?> ><?php echo "Publish";?></option>
																	<option value="2" <?php if($get[0]['rithu_gal_status']== 2){?> selected="selected"<?php }?> ><?php echo "Un Publish";?></option>
															</select>
                                                         

                                                            </div>
														</div>
														<div class="col-sm-6">
														<input type="submit" name="update" class="btn btn-primary btn-block" value="update">
														
														</div>
														
													</div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							
							</div>
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
