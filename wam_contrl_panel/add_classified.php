<?php
ob_start();
session_start();
include("autoload.php");
include("session.php");

$pasid = $_SESSION["LogUserID"];
$ad_name = $_SESSION["Loguser_name"];

// Connect to database
$db = new MySql();
$db->connect();

$objA = new Admin();
$data = $objA->getAdmin($pasid);

// Handle form submission
if (isset($_POST["submit"])) {
    $title = trim($_POST['title']);
    $status = $_POST['status'];
    $image = '';

    // Validate title
    if (empty($title)) {
        $message = new Message('Title is required', 'error');
        $message->setMessage();
        header("Location:classifieds_add.php");
        exit;
    }

    // Handle file upload
    if (isset($_FILES["upload"]) && $_FILES["upload"]["error"] === UPLOAD_ERR_OK) {
        $uploadDir = dirname(__FILE__) . '/upload/classifies/';
        $relDir = 'upload/classifies/';

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $originalName = $_FILES["upload"]["name"];
        $fileName = pathinfo($originalName, PATHINFO_FILENAME);
        $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
        $seoName = seoTitle($fileName);
        $newFileName = $seoName . '-' . time() . '.' . $fileExt;

        $targetPath = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $targetPath)) {
            $image = $newFileName;
        }
    }

    // Save classified
    $cat = new Classified();
    $inputs = [
        'title' => $title,
        'status' => $status,
        'photo' => $image
    ];

    if ($cat->addClassified($inputs)) {
        $message = new Message('Classified added successfully', 'message');
        $message->setMessage();
        header('Location:classifieds.php');
        exit;
    } else {
        $message = new Message('Failed to add classified', 'error');
        $message->setMessage();
        header('Location:classifieds_add.php');
        exit;
    }
}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
   <title> Classified </title>

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
                           Add New Images                       </h1>
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
                                            <span class="widget-caption"> Add New Images  </span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="collapse in">
                                                <form role="form" method="post" id="Classified" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="sminput">Classified Name</label>
                                                      	<input type="text" name="title" class="form-control"  >
														 
															</div>
                                             
													
													
													 <div class="form-group">
                                                        <label for="sminput">Images<br> Size (503 x 336) </label>  </label>
                                                        <input type="file" name="upload" class="" id="image" >
														    
                                                    </div>
													<div class="row">
													<div class="col-sm-1">
													 <label>Status</label>
													</div>
														<div class="col-sm-5">
															<div class="input-group">
															<select name="status" class="form-control select2" style="width: 100%;">
															 
																				<option value="1" >Publish</option>
																				 <option value="2" >Un Publish</option>
																			   
															</select>
                                                                
                                                              
                                                            </div>
														</div>
														<div class="col-sm-6">
														<input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit">
														
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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

</html>
