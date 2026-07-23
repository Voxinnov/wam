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

$a_id	=	$_GET["a_id"];
$cat	=	new RecordDelete();
$delete	=	$cat->deletGalleryList($a_id);
header("location:gallery_list.php");
$message	=	new Message('Address Is Successfully Deleted','success');
$message->setMessage();
exit;
?>