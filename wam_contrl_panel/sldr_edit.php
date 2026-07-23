<?php
ob_start();
session_start();
include("autoload.php");
include("session.php");

$pasid   = $_SESSION["LogUserID"];
$ad_name = $_SESSION["Loguser_name"];

$db = new MySql();
$db->connect();

$objA = new Admin();
$data = $objA->getAdmin($pasid);

$g_id = $_GET["n_id"] ?? null;
$cat = new Slider();
$get = $cat->getSlider($g_id); // fetch current slider data

if (isset($_POST["update"])) {
    $title    = trim($_POST['title']);
    $caption  = trim($_POST['caption']);
    $type     = trim($_POST['type']);
    $status   = trim($_POST['status']);
    $oldImage = $_POST['hidding'] ?? '';
    $image    = $oldImage;

    // ✅ Validate required fields
    if (empty($title)) {
        $message = new Message('Enter mandatory fields', 'error');
        $message->setMessage();
        header("Location: sldr_edit.php?n_id=$g_id");
        exit;
    }

    // ✅ Directory setup
    $absDirName = dirname(__FILE__) . '/upload/slider/';
    if (!is_dir($absDirName)) {
        mkdir($absDirName, 0777, true);
    }

    // ✅ Handle image upload if new image provided
    if (!empty($_FILES['upload']['name'])) {
        $file       = $_FILES['upload'];
        $fileName   = $file['name'];
        $fileTmp    = $file['tmp_name'];
        $fileSize   = $file['size'];
        $fileError  = $file['error'];
        $fileExt    = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
        $maxFileSize       = 20 * 1024 * 1024; // 20MB

        if ($fileError !== UPLOAD_ERR_OK) {
            $message = new Message('Error in file upload', 'error');
            $message->setMessage();
            header("Location: sldr_edit.php?n_id=$g_id");
            exit;
        }

        if (!in_array($fileExt, $allowedExtensions)) {
            $message = new Message('Invalid file format', 'error');
            $message->setMessage();
            header("Location: sldr_edit.php?n_id=$g_id");
            exit;
        }

        if ($fileSize > $maxFileSize) {
            $message = new Message('File size exceeds 20MB limit', 'error');
            $message->setMessage();
            header("Location: sldr_edit.php?n_id=$g_id");
            exit;
        }

        // ✅ Generate new SEO-friendly file name
        $baseName   = seoTitle(pathinfo($fileName, PATHINFO_FILENAME));
        $uniqueName = $baseName . '-' . time() . '.' . $fileExt;
        $targetPath = $absDirName . $uniqueName;

        if (!move_uploaded_file($fileTmp, $targetPath)) {
            $message = new Message('File upload failed', 'error');
            $message->setMessage();
            header("Location: sldr_edit.php?n_id=$g_id");
            exit;
        }

        // ✅ Delete old image if exists
        if (!empty($oldImage) && file_exists($absDirName . $oldImage)) {
            unlink($absDirName . $oldImage);
        }

        $image = $uniqueName;
    }

    // ✅ Prepare updated data
    $inputs = [
        'title'   => $title,
        'caption' => $caption,
        'photo'   => $image,
        'type'    => $type,
        'status'  => $status,
        'id'      => $g_id
    ];

    // ✅ Update the database
    if ($cat->editSlider($inputs)) {
        $message = new Message('Slider updated successfully', 'message');
        $message->setMessage();
        header("Location: view_sldr.php");
        exit;
    } else {
        $message = new Message('Unknown error occurred', 'error');
        $message->setMessage();
    }
}
?>

<!DOCTYPE html>


<html xmlns="http://www.w3.org/1999/xhtml">


<head>
    <meta charset="utf-8" />
   <title>WAM</title>

    <meta name="description" content="blank page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <!--Basic Styles-->
     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://foliotek.github.io/Croppie/croppie.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
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
                    <ul class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="#">Home</a>                        </li>
                        <li>
                            <a href="#">More Pages</a>                        </li>
                        <li class="active">Blank Page</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Header -->
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>
                           Update Slider                      </h1>
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
                                            <span class="widget-caption"> Update Slider </span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="collapse in">
                                                <form role="form" method="post" enctype="multipart/form-data">
                                                   
                                                    <div class="form-group">
                                                        <label for="sminput">Title</label>
                                                        <input type="text" name="title" class="form-control input-sm" id="sminput" value="<?php echo $get[0]
                                                        ["rithu_slider_ttl"];?>">
                                                    </div>
													 <div class="form-group">
                                                        <label for="sminput">Slider Caption</label>
                                                        <input type="text" name="caption" class="form-control input-sm" id="sminput" value="<?php echo $get[0]
                                                        ["rithu_slider_cptn"];?>">
                                                    </div> 
													<div class="form-group">
                                                        <label for="sminput">Image<br> Size (957 x 336) </label></label>
                                                        
                                                  <?php if($get[0]["rithu_slider_photo"]!=''){?>
                                                  <div style="margin-top:10px; margin-bottom:5px;">
                                                   <img src="upload/slider/<?php echo $get[0]["rithu_slider_photo"];?>" height=70px width=120px ></div>
                                                 <?php } ?>
                                                        <input type="file" name="upload" class="" id="sminput" >
                                                            <input type="hidden" value="<?php echo $get[0]
                                                            ["rithu_slider_photo"];?>" name="hidding">
                                                    </div>

                                                    <div class="row">
													<div class="col-sm-1">
													 <label>Status</label>
													</div>
														<div class="col-sm-5">
															<div class="input-group">
															<select name="status" class="form-control select2" style="width: 100%;">
															 
																			<option value="1" <?php if($get[0]['rithu_slider_stus']== 1){?> selected="selected"<?php }?> ><?php echo "Publish";?></option>
																			<option value="2" <?php if($get[0]['rithu_slider_stus']== 2){?> selected="selected"<?php }?> ><?php echo "Un Publish";?></option>
																			   
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://foliotek.github.io/Croppie/croppie.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>

    <!--Page Related Scripts-->
    
    <!--Summernote Scripts-->
    <script src="assets/js/editors/summernote/summernote.js"></script>
    <script>
        $('#summernote').summernote({ height: 300 });
        $('#summernote1').summernote({ height: 300 });
        $('#summernote2').summernote({ height: 300 });
         $('#summernote3').summernote({ height: 300 });
    </script>
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