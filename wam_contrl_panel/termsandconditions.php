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
$cat    =   new Generalinfo();
                 
$get    =   $cat->getGeneralinfo();
$g_id=  $get[0]['general_info_id'];
//print_r($get[0]["abut_title"]);

If(isset($_POST["update"])){
       $title   =   $_POST['title'];
        $dscrptn    =   $_POST['dscrptn']; 
 $dscrptn  = str_replace("'", "`", $dscrptn);		
         $status        =   $_POST['status'];
          
       if(empty($title)){
        header("location:about_general.php");
            $message    =   new Message('Enter mandatory fields','error');
            $message->setMessage();
            exit;
       }
      
        $inputs =array('title'=>$title,
                                      'dscrptn'=>$dscrptn,
                                      'status'=>$status,
                                      'id'=>$g_id
                                      );
                                //print_r($inputs); exit;    
                if($cat->editGeneralinfo($inputs)){
                
                    
                    $message    =   new Message('Gallery Image Updated ','message');
                    $message->setMessage();
                    header("Location:about_general.php");
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
     <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link id="beyond-link" href="assets/css/beyond.min.css" rel="stylesheet" type="text/css" />
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
                         Terms and Conditions                    </h1>
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
                                            <span class="widget-caption">Terms and Conditions</span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="collapse in">
                                                <form role="form" method="post" enctype="multipart/form-data">
                                                   
                                                    <div class="form-group">
                                                        <label for="sminput">Title</label>
                                                        <input type="text" name="title" class="form-control input-sm" id="sminput" value="<?php echo $get[0]
                                                        ["general_info_ttl"];?>">
                                                    </div>
                                         
                           
                                                    <div class="col-sm-12">
                                                  <div class="mail-body">Description
                          <div class="mail-compose">
                          <div class="widget-body">
                            <div class="widget-main no-padding">
                          
                              <textarea name="dscrptn" id="summernote"><?php echo $get[0]["general_info_dscrptn"];?></textarea>
                            </div>
                          </div>
                          </div>
                          </div> </div>





                                                  
<div class="row">
      <div class="col-sm-1">
      <label>Status</label>
        </div>
      <div class="col-sm-8">
        <div class="input-group">
      <select name="status" class="form-control select2" style="width: 100%;">
      <option value="1" <?php if($get[0]["general_info_stus"]== 1){?> selected="selected"<?php }?> ><?php echo "Publish";?></option>
     <option value="2" <?php if($get[0][" general_info_stus"]== 2){?> selected="selected"<?php }?> ><?php echo "Unpublish";?></option>
                                         
        </select>
          </div>
  </div>
  <div class="col-sm-3">
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



    <script type="text/javascript">
  $(".chosen").chosen();
</script>



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
     <!--Basic Scripts-->
    <script src="assets/js/jquery-2.0.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	
    <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>

    <!--Beyond Scripts--> 
    <script src="assets/js/beyond.min.js"></script>

    <!--Page Related Scripts-->
    <!--Summernote Scripts-->
    <script src="assets/js/editors/summernote/summernote.js"></script>
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