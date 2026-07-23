<?php
ob_start();
session_start();
include("autoload.php");
include("session.php");

$pasid = $_SESSION["LogUserID"];
$ad_name = $_SESSION["Loguser_name"];

$db = new MySql();
$db->connect();
$objA = new Admin();
$data = $objA->getAdmin($pasid);

$n_id = $_GET["n_id"] ?? null;
$place_id = $_GET["place_id"] ?? null;

$dbtr_list = new Place();
$list_dbrt = $dbtr_list->getAllPlaceDetails($pasid);
$c_list_dbtr = count($list_dbrt);
$dclsContent = $dbtr_list->getPlace($place_id);

$cat = new Hotel();
$get = $cat->getHotel($n_id);

$act_img = new Hotelimg();
$get_img = $act_img->getHotelimg_act($n_id);
$get_total = count($get_img);

// ✅ Handle single image update
if (isset($_POST["submit"])) {
    $img_id = $_POST['img_id'];
    $img_hide = $_POST['hidding'];

    $photo = $_FILES["upload"]["name"];
    $absDirName = dirname(__FILE__) . '/upload/hotel';
    $relDirName = 'upload/hotel';

    if (!file_exists($absDirName)) {
        mkdir($absDirName, 0777, true);
    }

    $fileName = pathinfo($photo, PATHINFO_FILENAME);
    $fileName = seoTitle($fileName);
    
    $obj = new Uploader($absDirName . '/');
    $obj->setSequence($fileName);
    $obj->setExtensions(['png', 'gif', 'jpg', 'jpeg']);
    $obj->setMaxSize(20);

    if ($obj->uploadFile("upload")) {
        $image = $obj->getUploadName();
        $act_img->updateGalleryImage($img_id, $image);
        if (!empty($img_hide) && file_exists("$relDirName/$img_hide")) {
            unlink("$relDirName/$img_hide");
        }
    }

    header("Location:newsandevents_edit.php?n_id=$n_id");
    exit;
}

// ✅ Handle update of multiple images + hotel info
if (isset($_POST["update"])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];

    if (empty($title)) {
        $message = new Message('Enter mandatory fields', 'error');
        $message->setMessage();
        header("location:activity_edit.php");
        exit;
    }

    $inputs = [
        'title' => $title,
        'description' => $description,
        'status' => $status,
        'id' => $n_id
    ];

    if ($cat->editHotel($inputs)) {
        $upload_dir = "upload/hotel/";

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $count_file = count($_FILES['upload']['name']);

        for ($i = 0; $i < $count_file; $i++) {
            if ($_FILES['upload']['error'][$i] === UPLOAD_ERR_OK) {
                $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
                $original_name = $_FILES['upload']['name'][$i];
                $filename = date('d-m-Y-H-i-s') . '-' . uniqid() . '-' . basename($original_name);
                $filePath = $upload_dir . $filename;

                if (move_uploaded_file($tmpFilePath, $filePath)) {
                    $file_inputs = [
                        'hotel' => $n_id,
                        'photo' => $filename
                    ];
                    $act_img->addHotelimg($file_inputs);
                } else {
                    error_log("Failed to move uploaded file: $original_name");
                }
            } else {
                error_log("Upload error code: " . $_FILES['upload']['error'][$i]);
            }
        }

        $message = new Message('Hotel details updated successfully', 'message');
        $message->setMessage();
        header('Location:newsandevents.php');
        exit;
    } else {
        $message = new Message('Unknown error', 'error');
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


  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
 <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" type="text/css" />
    




   
  
    
   
   
    


    <!--Basic Styles-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link id="bootstrap-rtl-link" href="#" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/weather-icons.min.css" rel="stylesheet" />

    <!--Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">

    <!--Beyond styles-->
    <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" />
    <link href="assets/css/demo.min.css" rel="stylesheet" />
    <link href="assets/css/typicons.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link id="skin-link" href="#" rel="stylesheet" type="text/css" />

    <!--Skin Script: Place this script in head to load scripts for skins and rtl support-->
    <script src="assets/js/skins.min.js"></script>
  
</head>
<!-- Body -->
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
                         News & Events                    </h1>
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
                                            <span class="widget-caption">News & Events</span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="collapse in">
                                                <form role="form" method="post" enctype="multipart/form-data">
                                                 
                                          


                                               
                                                    <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="sminput">Title</label>
                                                        <input type="text" name="title" class="form-control input-sm" id="sminput" value="<?php echo $get[0]
                                                        ["hot_name"];?>" >
                                                    </div></div>

                                                    


                                                   <div class="col-sm-12"> 
                                                        <div class="mail-body">Description
                                                    <div class="mail-compose">
                                                    <div class="widget-body">
                                                        <div class="widget-main no-padding">
                                                    
                                                <textarea name="description" id="summernote"><?php echo $get[0]
                                                        ["hot_details"];?></textarea>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div></div>


                                                       
                                               
                                                              <div class="form-group">
                                                        <label for="sminput">Image<br> Size (1200 x 640)</label>
                                                        
                                                  <?php if($get_img[0]["hot_img"]!=''){?>
                                                  <div style="margin-top:10px; margin-bottom:5px;">
                                                   
                                                    <?php 
                                                        for ($i=0; $i < $get_total ; $i++) { 
                                                    
                                                    ?><img src="upload/hotel/<?php echo $get_img[$i]
                                                   ['hot_img'];?>" height=70px width=120px style="margin: 10px"/>
                                                 <a href="deletehotel_img.php?a_id=<?php echo $get_img[$i]['hot_img_id'];?>">Delete</a>
                                                   <?php } ?>
                                                 
                                               </div>
                                                 <?php } ?>
                                                   <input type="file" name="upload[]" class="form-control input-sm" id="sminput" multiple="multiple" >
                                                       <div class="row">
													<div class="col-sm-1">
													 <label>Status</label>
													</div>
														<div class="col-sm-5">
															<div class="input-group">
															<select name="status" class="form-control select2" style="width: 100%;">
															 
																			<option value="1" <?php if($get[0]['hot_stus']== 1){?> selected="selected"<?php }?> ><?php echo "Publish";?></option>
																			<option value="2" <?php if($get[0]['hot_stus']== 2){?> selected="selected"<?php }?> ><?php echo "Un Publish";?></option>
																			   
															</select>
                                                            </div>
														</div>
														<div class="col-sm-6">
														<input type="submit" name="update" class="btn btn-primary btn-block" value="update">
														
														</div>
														
													</div>                  
                                                    </div>


                 
                                                   
                                                </form>
<?php 
                                                        for ($i=0; $i < $get_total ; $i++) { 
                                                    
                                                    ?>

                                                   <div id="myModal<?php echo $i; ?>" class="modal">

                                  <!-- Modal content -->
                     <div class="modal-content"  style="position: absolute; top: 25%; left: 25%; right:25%; overflow: visible; z-index:9999">
                                <div class="panel panel-primary ">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                        <i class="fa fa-fw fa-tint"></i> Edit Image
                                            </h3>
                                     <span  id="close" class="close pull-right close_span">
                                          <i class="fa fa-fw fa-times  "></i>
                                         </span>
                                         </div>
                                    <div class="panel-body" >
                                                           
                                 <form  method="post" enctype="multipart/form-data">
                                                                  
                                 <div class="form-group form-actions">
                                 <div class="row"> <div class="col-sm-6">
                                                      <img src="upload/hotel/<?php echo $get_img[$i]
                                                   ['hot_img'];?>" height=170px width=220px style="margin: 10px"/>
                                               </div>
                                                <div class="col-sm-6">
                                                    <input type="file" name="upload">
                                                    <input type="hidden" name="img_id" value="<?php echo $get_img[$i]['hot_img_id']; ?>">
                                                    <input type="hidden" name="hidding" value="<?php echo $get_img[$i]
                                                   ['hot_img'];?>">
                                                </div></div>
                                                             
                                                             </div>
                                                                <div class="form-group form-actions">
                                                                    <div class="col-md-8 col-md-offset-4">
                                                                         <input style="width: 32%;" type="submit" name="submit" value="Save" class="btn btn-primary btn-block"/>
                                                                      
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                    </div>

                                </div> 
                                <?php } ?>
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

      <script type="text/javascript">
  $(".chosen").chosen();
</script>

<script src='assets/js/editors/summernote/summernote.js'></script>

 <script>
    // Get the modal
var modal = document.getElementsByClassName('modal');

// Get the button that opens the modal
var btn = document.getElementsByClassName("myBtnn");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close_span");

// When the user clicks the button, open the modal 
<?php for($i=0;$i<$get_total;$i++){ ?>
btn[<?php echo $i; ?>].onclick = function() {
    modal[<?php echo $i; ?>].style.display = "block";
}
        <?php } ?>

// When the user clicks on <span> (x), close the modal
<?php for($i=0;$i<$get_total;$i++){ ?>
span[<?php echo $i; ?>].onclick = function() {
    modal[<?php echo $i; ?>].style.display = "none";
}
<?php } ?>

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
    </script>

 <script src="assets/js/jquery-2.0.3.min.js"></script>
  
 
    <script src="assets/js/beyond.js"></script>
    <!--Beyond Scripts-->
    <!-- <script src="assets/js/beyond.min.js"></script> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://foliotek.github.io/Croppie/croppie.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>



  <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>

    <!--Beyond Scripts-->
    <script src="assets/js/beyond.min.js"></script>

    <!--Page Related Scripts-->
    <!--Jquery Select2-->
    <script src="assets/js/select2/select2.js"></script>
    <!--Bootstrap Tags Input-->
    

    <!--Jquery Autosize-->
    <script src="assets/js/textarea/jquery.autosize.js"></script>

  
    <!--Dropzone-->
    <script src="assets/js/dropzone/dropzone.min.js"></script>

    <script>
        //--Jquery Select2--
        $("#e1").select2();
        $("#e2").select2({
            placeholder: "Select a State",
            allowClear: true
        });

   
    </script>
    <script src="assets/js/editors/summernote/summernote.js"></script>
    <script>
        $('#summernote').summernote({ height: 300 });
         $('#summernote1').summernote({ height: 300 });
        $('#summernote2').summernote({ height: 300 });
        $('#summernote3').summernote({ height: 300 });
        $('#summernote4').summernote({ height: 300 });
       
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