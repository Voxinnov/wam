<?php

declare(strict_types=1);

	date_default_timezone_set("Asia/Kolkata"); // Fixed: Asia/Calcutta is a deprecated alias

	define("CONST_BASEDIR",dirname(__FILE__));
	define('CONST_LIBRARY_FOLDER',CONST_BASEDIR.'/libs');
	$_SESSION['CONST_BASEDIR']=CONST_BASEDIR;
error_reporting(E_ALL & ~ E_NOTICE & ~E_DEPRECATED);
spl_autoload_register(function($className){
		
		if(!class_exists($className, false)){
			$parts	=	explode("_",$className);			
			if(count($parts)==1){
				$folder	=	CONST_LIBRARY_FOLDER."/".$className.".php";
			}else{
				$folder	=	CONST_LIBRARY_FOLDER."/";
				for($i=0;$i<count($parts)-1;$i++){
					$folder.=	strtolower($parts[$i]);					
					$folder.="/";					
				}
				$folder.=$parts[count($parts)-1].".php";

			}			
			if(file_exists($folder)){
				include_once($folder);
			}
		}
	});
	
	
	function seoTitle($string){
		$string		=	strtolower($string);
		$string	 	= 	preg_replace('/[^a-z0-9\s]/i', '', $string);
		$string	 	= 	preg_replace('/[\s_]+/','-',$string);
		return $string;
	}
	
	function cmsUrl($id,$string){
		$url	=	$id.'-'.seoTitle($string).'.html';
		return $url;
	}
?>