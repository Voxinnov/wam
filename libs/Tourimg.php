<?php	 	

	class Tourimg extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listTourimg(){
		
		
		


		$query = "SELECT * FROM `tours_images` c WHERE c.`tours_details_id`!='' ORDER BY `tours_details_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	
	 /* Add Testimonials
			*/			
			function addTourimg($inputs){
					$insert	=	array('tours_img'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'tours_details'=>$inputs['tours_details']
										);
				//print_r($insert);exit;
				$this->insert($insert,"tours_images");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editTourimg($inputs){
					$insert	= array('tours_img'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'tours_details'=>$inputs['tours_details'],	
										'tours_details_id'=>$inputs['id']
							);
					//print_r($insert);exit;
				$this->update($insert,"tours_images",'`tours_details_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		//print_r($image);
		//print_r($id);exit;
		 $this->update(array('tours_img'=>$image),'tours_images','`tours_details_id`='.$id);
	}
	 function getTourimg($id){
		$query	=	"SELECT * FROM `tours_images` WHERE `tours_details_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getTourimg_act($id){
		$query	=	"SELECT * FROM `tours_images` WHERE `tours_details`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAllTourimgDetails($id)
	{
		$query = "SELECT * FROM  tours_images  ";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}

}
?>