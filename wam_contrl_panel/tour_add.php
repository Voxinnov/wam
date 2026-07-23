<?php
 ob_start();
session_start();
include("autoload.php");
include("session.php");
$pasid  =   $_SESSION["LogUserID"];
$ad_name    =   $_SESSION["Loguser_name"];
$db     =   new MySql();
$db->connect();
$objA   =   new Admin();
$data   =   $objA->getAdmin($pasid);
///$p_cat= new Activity();
$act_img = new Tourimg();
If(isset($_POST["submit"])){
    $title       =   $_POST['title'];
   // print_r($title);exit;
     $description       =   $_POST['description'];
      $resStr = str_replace("'", "`", $description); 
      $itinerary       =   $_POST['itinerary'];
     $itinerary = str_replace("'", "`", $itinerary);
          $map        =   $_POST['map'];
    
      // $photo       =   $_FILES["upload"]["name"];
         $status        =   $_POST['status'];
      // print_r($dscrptn1);exit;
     //print_r(expression)($proof);exit;
      /*  $proof_count = count(proof);
        $proof_array = array();
        for ($i=0; $i <proof_count ; $i++) { 
          $proof_array[$i]=$proof[$i];
        }*/
        $proof_org = serialize($proof);
//print_r($proof_org);exit; 
        /*$dcumnts_count = count(dcumnts);

        $dcumnts_array = array();
        for ($i=0; $i <dcumnts_count ; $i++) { 
          $dcumnts_array[$i]=$dcumnts[$i];
        }*/
        $dcumnts_org = serialize($dcumnts);

       if(empty($title)){
        header("location:tour_add.php");
            $message    =   new Message('Enter mandatory fields','error');
            $message->setMessage();
            exit;
       }
          
        $cat    =   new Tour();
                 $inputs    =   array('title'=>$title,
                                        'description'=>$resStr,
                                        'itinerary'=>$itinerary,
                                        'map'=>$map,
                                      'status'=>$status
                                      );
            
                if($cat->addTour($inputs)){  

                
                $get_last_id = $cat->getAllTourMax();
                $last_id = $get_last_id[0]['max_id'];

                $count_file = count($_FILES['upload']['name']);
             

                     for($i=0; $i<$count_file; $i++) {
              
             $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

                $shortname = $_FILES["upload"]["name"][$i];

                $filePath = "upload/Tour/" . date('d-m-Y-H-i-s').'-'.$_FILES["upload"]["name"][$i];
 
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                    $files= date('d-m-Y-H-i-s').'-'.$_FILES["upload"]["name"][$i];
                   
                    $input =   array('tours_details'=>$last_id,
                                      
                                      'photo'=>$files
                                      );
                                      
                                //print_r($inputs);exit;
                                      $act_img->addTourimg($input);
                    //print_r($act_img);exit;

                }
               
                 
             
                     }
                
                    
                    $message    =   new Message('New Gallery added ','message');
                    $message->setMessage();
                    header('Location:view_tour.php');
                    exit;
                    
                }else{
                    
                    $message    =   new Message('Unknown error','error');
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
                         Tour                    </h1>
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
                                            <span class="widget-caption">Tour


                                            </span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="collapse in">
                                                <form role="form" method="post" enctype="multipart/form-data">
                                                 
                                          


                                               
                                                    <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="sminput">Title</label>
                                                        <input type="text" name="title" class="form-control input-sm" id="sminput" >
                                                    </div></div>


                                                                                          
                                          
                                                       
                                                   <div class="col-sm-12"> 
                                                        <div class="mail-body">Description
                                                    <div class="mail-compose">
                                                    <div class="widget-body">
                                                        <div class="widget-main no-padding">
                                                    
                                                            <textarea name="description" id="summernote"></textarea>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div></div>
                                                   
                                                
                                                     <div class="col-sm-12"> 
                                                        <div class="mail-body">Itinerary
                                                    <div class="mail-compose">
                                                    <div class="widget-body">
                                                        <div class="widget-main no-padding">
                                                    
                                                            <textarea name="itinerary" id="summernote4"></textarea>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div></div>
                                                     <div class="col-sm-12"> 
                                                        <div class="mail-body">Map
                                                    <div class="mail-compose">
                                                    <div class="widget-body">
                                                        <div class="widget-main no-padding">
                                                    
                                                          <input type="text" name="map"class="form-control input-sm" id="sminput">
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div></div>
                                                     <div class="form-group">
                                                    <label for="sminput">Images<br> Size (957 x 336)</label>
                                                        <input type="file" name="upload[]" class="form-control input-sm" id="sminput" multiple="multiple" >
                                                      
                                                    </div> 








                                                    <div class="row">
                                                    <div class="col-sm-1">
                                                     <label>Status</label>
                                                    </div>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                        <select name="status" class="form-control select2" style="width: 100%;">
                                                             
                                                                                <option value="1">Publish</option>
                                                                                 <option value="2">Unpublish</option>
                                                                               
                                                            </select>
                                                                
                                                            

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                      
                                                       
                                                       <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>

                                                    </div>
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

<script src="assets/js/jquery-2.0.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>

    <!--Beyond Scripts-->
    <script src="assets/js/beyond.min.js"></script>

    <!--Page Related Scripts-->
    <!--Summernote Scripts-->
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
