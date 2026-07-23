<?php
ob_start();
include("autoload.php");
session_start();

if(isset($_POST["submit"]))
{
//print_r('Enter');exit;
 	$txtUsername	=	trim($_POST["txtUsername"])	;		//username
 	$txtPassword	=	trim($_POST["txtPassword"]);		//password
	//$chkRemember	=	trim($_POST["chkRemember"]);		//store login
	
	/*Validation
	
	*/	
	//print_r($txtUsername);
	//print_r($txtPassword);exit;
	if(empty($txtUsername) || empty($txtPassword))
	{
		$message = new Message('Enter Mandatory fields','error');
		$message->setMessage();
		header("Location:index.php");
	}
	else
	{
		/*
		* Login Verification 
		* Use Admin Library for login check
		*/
		$db	= new MySql();
		$db->connect();
		$auth =	new Admin();
		$test= $auth->testAd();
		$key = rand(1,9999).rand(111,9999);
		$crypt = new Crypt; 
		$crypt->crypt_key($key); 										// Get encryption key
		$password = $crypt->encrypt($txtPassword);	// encrypt Password	
		//echo $password; exit;
		if($auth->userLogin(array("user_name"=>$txtUsername,"password"=>$password)))
		{
			
			$userName =	$auth->userName;	 
		    $userId	= $auth->adminID; 
			$_SESSION["LogUserID"] = $userId;
			$_SESSION["LogUserNAME"] = $userName;
			header("Location:dashboard.php");
				
		}
		else
		{
			
			$message = new Message('Invalid Username Or Password','error');
			$message->setMessage();
			//if(!empty($msgId) && $msgId=='57913'){
				//header("Location:login.php?msgId=57913#log?error=$error");
			//}else{
			header("Location:index.php");
			//}
				
			//exit;
		}				
	}
	
	
}
			
?>



