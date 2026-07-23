<?php	 	

	class Destiimg extends MySql{
	
	
		function getDestiimg_act($id){
		$query	=	"SELECT * FROM `desti_img` WHERE `desti`=$id";
       //print_r($query);exit;
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
			
			
	
	function listDestiimg(){
		
		
		


		$query = "SELECT * FROM `desti_img` c WHERE c.`about_img_id`!='' ORDER BY `about_img_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
 /* Add Testimonials
			*/			
			function addDestiimg($inputs){
				$insert	=	array('about_img_photo'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'desti'=>$inputs['desti']
										);
					//print_r($insert); exit;
				
				$this->insert($insert,"desti_img");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/	

			function editDestiimg($inputs){
$insert	=	array('about_img_photo'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'desti'=>$inputs['desti'],	
										'about_img_id'=>$inputs['id']
										);
					//print_r($insert); exit;	
				$this->update($insert,"desti_img",'`about_img_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('about_img_photo'=>$image),'desti_img','`about_img_id`='.$id);
	}
	 function getDestiimg($id){
		$query	=	"SELECT * FROM `desti_img` WHERE `about_img_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}


	function getAllDestiimgDetails()
	{
		$query = "SELECT * FROM desti_rithu where about_stus=1";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}

}
?>