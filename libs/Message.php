<?php	 	

	
	class Message{
		
		private $message;
		private $type;		
		
		function __construct($message = '', $type = ''){
			$this->message	=	$message;
			$this->type			=	$type;
		}
		
		function setMessage(){
			$_SESSION["messageText"] = $this->message;
			$_SESSION["messageType"] = $this->type;
			$_SESSION["messageView"] = 0;
		}
		
		
		function showMessage(){
			$view    = $_SESSION["messageView"] ?? null;
			$message = $_SESSION["messageText"] ?? '';
			$type    = $_SESSION["messageType"] ?? '';
			if(($view === 0 || $view === "0") && !empty($message) && !empty($type)){
				switch($type){
					case 'error':
						echo '<div class="msgError">'.$message.'</div>';
						break;
					case 'message':
						echo '<div class="msgMessage">'.$message.'</div>';
						break;
					case 'warning':
						echo '<div class="msgWarning">'.$message.'</div>';
						break;
					
					default:
						echo '<div class="msgMessage">'.$message.'</div>';
						break;
				}
			}			
			unset($_SESSION["messageView"]);
			unset($_SESSION["messageText"]);
			unset($_SESSION["messageType"]);
		}
			
		
	}
	
	

?>
