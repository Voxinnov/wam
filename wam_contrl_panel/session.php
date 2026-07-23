<?php
 ob_start();

if(isset($_SESSION["LogUserID"]) || ($_SESSION["LogUserNAME"])){	
}else{
	header("Location:index.php");
	exit;
} 

?>