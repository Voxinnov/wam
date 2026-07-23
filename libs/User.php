<?php

class User extends MySql{
	private $authId;
	private $username;
	private $password;
/*
	 * User login authetiction Check
	*/
	function userLogin($array){
		$this->username	=	$array["username"];
		$this->password	=	$array["password"];
	
		 $query	=	"SELECT * FROM `clients` WHERE `username`='".$this->addFilter($this->username)."' ";
		
		 $rec		=	$this->fetchAll($query);
	
		if(count($rec)>0){
			
			$password	=	$array["password"];
			if($password==$rec[0]["password"]){
				$this->userID	=	$rec[0]["client_id"];
				$this->userEmail	=	$rec[0]["email"];
				$this->userName	=	$rec[0]["username"];
				$this->userApprove	=	$rec[0]["aprove"];
				 $rec[0]["client_id"];
				 $rec[0]["email"];
				 $rec[0]["username"];
				 $rec[0]["password"];
				 $rec[0]["aprove"];
				//$this->dateCreated		=	$rec[0]["date_create"];				
				return true;
			}	
		}		
		return false;
	}
	function getUserEmail($email){
	             
				  $query="SELECT * FROM `clients` WHERE `client_id`=$email";
				 $rec	=$this->fetchAll($query);
				return $rec;
		}
		function approvedUser($username)
		{
		$query	=	"SELECT * FROM `clients` WHERE `username`='$username' AND `aprove`=1";
		
		  $rec	= $this->fetchAll($query);
 		return $rec;
	
	    }	
		
	 function getLoggedData($email)
         {
	 $query	=	"SELECT * FROM  `clients` WHERE `email`='$email'";		
		  $rec	= $this->fetchAll($query);
 		return $rec;
	
	    }	
}
	
	?>