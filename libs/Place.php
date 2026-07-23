<?php	 	

	class Place extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listPlace(){
		
		
		


		$query = "SELECT * FROM `place_details` c WHERE c.`place_id`!='' ORDER BY `place_name`";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	  }
	 /* Add Testimonials
			*/			
			function addPlace($inputs){
		$insert	=	array('place_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),									'place_description'=>$inputs['description'],
										'place_map'=>$inputs['map'],
										'place_category'=>$inputs['type'],
										'place_stus'=>$inputs['status']
										
							);
				//print_r($insert);exit;
				$this->insert($insert,"place_details");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editPlace($inputs){
			$insert	=	array('place_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),								'place_description'=>$inputs['description'],
										'place_map'=>$inputs['map'],	
										'place_category'=>$inputs['type'],
										'place_stus'=>$inputs['status']
										
							);
										
						
				$this->update($insert,"place_details",'`place_id`='.$inputs['id']);		
				return true;
			}
	function updateGalleryImage($id,$image){
		 $this->update(array('place_img'=>$image),'place_details','`place_id`='.$id);
	}

	 function getPlace($id){
		$query	=	"SELECT * FROM `place_details` WHERE `place_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}

		function getAllPlaceMax()
	{
		$query = "SELECT max(place_id) as max_id FROM `place_details`";
		$rec = $this->fetchAll($query);
		return $rec;	
	}

		

	function getAllPlaceDetails()
{
		$query = "SELECT * FROM place_details WHERE place_stus=1";
		$rec = $this->fetchAll($query);
	return $rec;	
	}
	

}
?>