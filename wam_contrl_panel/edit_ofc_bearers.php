<?php
ob_start();
session_start();
include("autoload.php");
include("session.php");

$pasid   = $_SESSION["LogUserID"]  ?? null;
$ad_name = $_SESSION["Loguser_name"] ?? null;

$db = new MySql();
$db->connect();

$objA = new Admin();
$data = $objA->getAdmin($pasid);

// Get the bearer ID from URL
$n_id = $_GET["n_id"] ?? null;
if (!$n_id) {
    $message = new Message('Invalid request: missing ID', 'error');
    $message->setMessage();
    header("Location: ofc_bearers.php");
    exit;
}

$cat = new OfficeBearers();
$get = $cat->getOfficeBearers($n_id); // Optional: use to prefill the form

if (isset($_POST["update"])) {
    // Read inputs
    $title    = trim($_POST['title'] ?? '');
    $pos      = trim($_POST['pos']   ?? '');
    $status   = trim($_POST['status'] ?? '1');
    $n_id     = $_POST['n_id'] ?? $n_id;      // prefer POST id if present
    $oldImage = $_POST['hidding'] ?? '';      // hidden field carrying current image filename

    // Validate
    if ($title === '') {
        $message = new Message('Enter mandatory fields', 'error');
        $message->setMessage();
        header("Location: edit_ofc_bearers.php?n_id=$n_id");
        exit;
    }

    // Default to existing image
    $image = $oldImage;

    // Handle file upload (single file input name="upload")
    if (!empty($_FILES["upload"]["name"])) {
        $file        = $_FILES["upload"];
        $fileName    = $file["name"] ?? '';
        $fileTmp     = $file["tmp_name"] ?? '';
        $fileSize    = $file["size"] ?? 0;
        $fileError   = $file["error"] ?? UPLOAD_ERR_NO_FILE;
        $fileExt     = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['png', 'gif', 'jpg', 'jpeg'];
        $allowedMime       = ['image/png','image/gif','image/jpeg'];
        $maxFileSize       = 20 * 1024 * 1024; // 20MB

  
        if (!in_array($fileExt, $allowedExtensions, true)) {
            $message = new Message('Invalid file format', 'error');
            $message->setMessage();
            header("Location: edit_ofc_bearers.php?n_id=$n_id");
            exit;
        }

        if ($fileSize > $maxFileSize) {
            $message = new Message('File size exceeds 20MB limit', 'error');
            $message->setMessage();
            header("Location: edit_ofc_bearers.php?n_id=$n_id");
            exit;
        }


        // Build unique, SEO-friendly filename
        $nameSlug   = seoTitle($title ?: 'bearer');
        $baseName   = seoTitle(pathinfo($fileName, PATHINFO_FILENAME));
        $unique     = $nameSlug . '-' . time() . '-' . uniqid();
        $uniqueName = ($baseName ? $baseName . '-' : '') . $unique . '.' . $fileExt;

        // Directories
        $absDirName = __DIR__ . '/upload/bearers/';
        if (!is_dir($absDirName)) {
            if (!mkdir($absDirName, 0755, true)) {
                $message = new Message('Failed to create upload directory', 'error');
                $message->setMessage();
                header("Location: edit_ofc_bearers.php?n_id=$n_id");
                exit;
            }
        }
        if (!is_writable($absDirName)) {
            @chmod($absDirName, 0755);
            if (!is_writable($absDirName)) {
                $message = new Message('Upload directory is not writable', 'error');
                $message->setMessage();
                header("Location: edit_ofc_bearers.php?n_id=$n_id");
                exit;
            }
        }

        // Move file
        $dest = $absDirName . $uniqueName;
        if (!move_uploaded_file($fileTmp, $dest)) {
            $message = new Message('File upload failed', 'error');
            $message->setMessage();
            header("Location: edit_ofc_bearers.php?n_id=$n_id");
            exit;
        }

        // Delete old image if new uploaded successfully
        if (!empty($oldImage)) {
            $oldPath = $absDirName . $oldImage;
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }

        // Use new filename
        $image = $uniqueName;
    }

    // Prepare update data for model
    $inputs = [
        'id'     => $n_id,
        'title'  => $title,
        'pos'    => $pos,
        'photo'  => $image,   // unchanged if no new file
        'status' => $status
    ];

    if ($cat->editOfficeBearers($inputs)) {
        $message = new Message('Office Bearer Details Updated', 'message');
        $message->setMessage();
        header("Location: ofc_bearers.php");
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
                          Edit Office Bearers                       </h1>
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
                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="widget">
                                        <div class="widget-header bordered-top bordered-palegreen">
                                            <span class="widget-caption"> Update Office Bearers  </span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="collapse in">
                                                <form role="form" method="post" enctype="multipart/form-data">
                                                   
                                                    <div class="form-group">
                                                        <label for="sminput">Position</label>
                                                        <input type="text" name="pos" class="form-control input-sm" id="sminput" value="<?php echo $get[0]["gip_ofc_brers_titl"];?>">
                                                    </div>
													<div class="form-group">
                                                        <label for="sminput">Name</label>
                                                        <input type="text" name="title" class="form-control input-sm" id="sminput" value="<?php echo $get[0]["gip_ofc_brers_name"];?>">
                                                    </div>
												
													 <div class="form-group">
                                                        <label for="sminput">News image</label>
														
												 
												  <div style="margin-top:10px; margin-bottom:5px;"> <img src="upload/bearers/<?php echo $get[0]["gip_ofc_brers_img"];?>" height=70px width=120px  ></div>
												
                                                        <input type="file" name="upload" class="" id="sminput" >
														<input type="hidden" value="<?php echo $get[0]["gip_ofc_brers_img"];?>" name="hidding">
                                                    </div>
													<div class="row">
													<div class="col-sm-1">
													 <label>Status</label>
													</div>
														<div class="col-sm-5">
															<div class="input-group">
															<select name="status" class="form-control select2" style="width: 100%;">
															 
																	<option value="1" <?php if($get[0]['gip_ofc_brers_status']== 1){?> selected="selected"<?php }?> ><?php echo "Publish";?></option>
																	<option value="2" <?php if($get[0]['gip_ofc_brers_status']== 2){?> selected="selected"<?php }?> ><?php echo "Un Publish";?></option>
															</select>
                                                                
                                                               <!-- <div class="input-group-btn">
                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Status <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#">Publish</a></li>
                                                                        <li><a href="#">Unpublish</a></li>
                                                                        
                                                                    </ul>
                                                                </div>-->

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
<script src="assets/js/datetime/bootstrap-datepicker.js"></script>

    <!--Bootstrap Time Picker-->
    <script src="assets/js/datetime/bootstrap-timepicker.js"></script>
<script>
   $('.date-picker').datepicker();

        //--Bootstrap Time Picker--
        $('#timepicker1').timepicker();
</script>

    <!--Page Related Scripts-->
	<!--Summernote Scripts-->
    <script src="assets/js/editors/summernote/summernote.js"></script>
    <script>
        $('#summernote').summernote({ height: 300 });
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
<!--  /Body -->

<!-- Mirrored from beyondadmin-v1.3.s3-website-us-east-1.amazonaws.com/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 May 2015 06:07:50 GMT -->
</html>
