<?php	 	

	class Acimg extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listAcimg(){
		
		
		


		$query = "SELECT * FROM `activity_images` c WHERE c.`activity_id`!='' ORDER BY `activity_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	
	 /* Add Testimonials
			*/			
			function addAcimg($inputs){
					$insert	=	array('activity_img'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'activity'=>$inputs['activity']
										);
				//print_r($insert);exit;
				$this->insert($insert,"activity_images");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editAcimg($inputs){
					$insert	= array('activity_img'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'activity'=>$inputs['activity'],	
										'activity_id'=>$inputs['id']
							);
				$this->update($insert,"activity_images",'`activity_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		//print_r($image);
		//print_r($id);exit;
		 $this->update(array('activity_img'=>$image),'activity_images','`activity_id`='.$id);
	}
	 function getAcimg($id){
		$query	=	"SELECT * FROM `activity_images` WHERE `activity_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAcimg_act($id){
		$query	=	"SELECT * FROM `activity_images` WHERE `activity`='$id'  ";
		///print_r($query);exit;
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAllAcimgDetails()
	{
		$query = "SELECT * FROM activity_images where  sldr_stus=1";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}

}
?>