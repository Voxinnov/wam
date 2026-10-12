<?php
	
	date_default_timezone_set("Asia/Kolkata");
	define("CONST_BASEDIR",dirname(dirname(__FILE__)));
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
        $string        =    strtolower($string);
        $pattern    =    '/[^a-zA-Z0-9\s]+/';
        $replace    =    preg_replace($pattern,'',$string);
        $pattern    =    '/[\s]+/';
        $replace    =    preg_replace($pattern,'-',$replace);
        return strtolower($replace);
}


?>