<?php
ob_start();
session_start();
include("autoload.php");
include("session.php");

$pasid = $_SESSION["LogUserID"];
$ad_name = $_SESSION["Loguser_name"];

// Database connection and object initialization
$db = new MySql();
$db->connect();
$objA = new Admin();
$data = $objA->getAdmin($pasid);
$act_img = new Hotelimg();
$dbtr_list = new Place();
$list_dbrt = $dbtr_list->getAllPlaceDetails($pasid);
$c_list_dbtr = count($list_dbrt);

// Process form submission
if (isset($_POST["submit"])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $resStr = str_replace("'", "`", $description);
    $status = $_POST['status'];

    // Validation
    if (empty($title)) {
        $message = new Message('Enter mandatory fields', 'error');
        $message->setMessage();
        header("location:newsandevents_add.php");
        exit;
    }

    // Prepare hotel data
    $inputs = array(
        'title' => $title,
        'description' => $resStr,
        'status' => $status
    );

    $cat = new Hotel();
    if ($cat->addHotel($inputs)) {
        // Get the last inserted ID
        $get_last_id = $cat->getAllHotelMax();
        $last_id = $get_last_id[0]['max_id'];

        // Handle file uploads
        if (isset($_FILES['upload']) && !empty($_FILES['upload']['name'][0])) {
            $upload_dir = "upload/hotel/";
            // Create directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $file_count = count($_FILES['upload']['name']);
            
            for ($i = 0; $i < $file_count; $i++) {
                if ($_FILES['upload']['error'][$i] === UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES['upload']['tmp_name'][$i];
                    $original_name = $_FILES['upload']['name'][$i];
                    
                    // Generate unique filename
                    $filename = date('d-m-Y-H-i-s') . '-' . uniqid() . '-' . basename($original_name);
                    $destination = $upload_dir . $filename;

                    // Move the uploaded file
                    if (move_uploaded_file($tmp_name, $destination)) {
                        $file_inputs = array(
                            'hotel' => $last_id,
                            'photo' => $filename
                        );
                        
                        $act_img->addHotelimg($file_inputs);
                    } else {
                        error_log("Failed to move uploaded file: " . $original_name);
                    }
                } else {
                    error_log("Upload error code: " . $_FILES['upload']['error'][$i]);
                }
            }
        }

        $message = new Message('New Gallery added', 'message');
        $message->setMessage();
        header('Location:newsandevents.php');
        exit;
    } else {
        $message = new Message('Failed to add hotel', 'error');
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

    <!-- Styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/weather-icons.min.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300" rel="stylesheet" type="text/css">
    <link href="assets/css/beyond.min.css" rel="stylesheet" />
    <link href="assets/css/demo.min.css" rel="stylesheet" />
    <link href="assets/css/typicons.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <script src="assets/js/skins.min.js"></script>
</head>

<body>
    <?php include('header.php') ?>
    <div class="main-container container-fluid">
        <div class="page-container">
            <div class="page-sidebar" id="sidebar">
                <?php include('menu.php') ?>
            </div>

            <div class="page-content">
                <div class="page-header position-relative">
                    <div class="header-title">
                        <h1>News & Events</h1>
                    </div>
                </div>

                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="widget">
                                <div class="widget-header bordered-top bordered-palegreen">
                                    <span class="widget-caption">News & Events</span>
                                </div>
                                <div class="widget-body">
                                    <form role="form" method="post" enctype="multipart/form-data">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" class="form-control input-sm" id="title" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" id="summernote" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="upload">Images (1200 x 640 recommended)</label>
                                                <input type="file" name="upload[]" class="form-control input-sm" id="upload" multiple accept="image/*">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1">Publish</option>
                                                        <option value="2">Unpublish</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
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

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/beyond.min.js"></script>
    <script src="assets/js/editors/summernote/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({ 
                height: 300 
            });
        });
    </script>
</body>
</html>