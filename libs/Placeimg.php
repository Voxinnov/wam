<?php	 	

	class Placeimg extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listPlaceimg(){
		
		
		


		$query = "SELECT * FROM `place_images` c WHERE c.`place_id`!='' ORDER BY `place_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	
	 /* Add Testimonials
			*/			
			function addPlaceimg($inputs){
					$insert	=	array('place_img'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'place_details'=>$inputs['place_details']
										);
				//print_r($insert);exit;
				$this->insert($insert,"place_images");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editPlaceimg($inputs){
					$insert	= array('place_img'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'place_details'=>$inputs['place_details'],	
										'place_id'=>$inputs['id']
							);
					//print_r($insert);exit;
				$this->update($insert,"place_images",'`place_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		//print_r($image);
		//print_r($id);exit;
		 $this->update(array('place_img'=>$image),'place_images','`place_id`='.$id);
	}
	 function getPlaceimg($id){
		$query	=	"SELECT * FROM `place_images` WHERE `place_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getPlaceimg_act($id){
		$query	=	"SELECT * FROM `place_images` WHERE `place_details`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAllPlaceimgDetails()
	{
		$query = "SELECT * FROM  place_images ";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}

}
?>