<?php	 	

	class Tour extends MySql{
	
	

	
	function listTour(){
		
		
		


		$query = "SELECT * FROM `tours_details` c WHERE c.`tours_details_id`!='' ORDER BY `tours_details_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	  }
	 /* Add Testimonials
			*/			
			function addTour($inputs){
$insert	=	array('tours_details_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),							
											'tours_details_dscrptn'=>$inputs['description'],
										'tours_details_itinaray'=>$inputs['itinerary'],
										'tours_details_map'=>$inputs['map'],
										'tours_details_stus'=>$inputs['status']
										);
				//print_r($insert);exit;
				$this->insert($insert,"tours_details");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editTour($inputs){
$insert	=	array('tours_details_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),							
										'tours_details_dscrptn'=>$inputs['description'],
										'tours_details_itinaray'=>$inputs['itinerary'],
										'tours_details_map'=>$inputs['map'],
										'tours_details_stus'=>$inputs['status']
										);
				//print_r($insert);exit;
				$this->update($insert,"tours_details",'`tours_details_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('tours_img'=>$image),'tours_details','`tours_details_id`='.$id);
	}
	 function getTour($id){
		$query	=	"SELECT * FROM `tours_details` WHERE `tours_details_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	function getAllTourDetails()
	{
		$query = "SELECT * FROM `tours_details` where tours_details_stus=1";
		$rec = $this->fetchAll($query);
		return $rec;	
	}
	function getAllTourMax()
	{
		$query = "SELECT max(tours_details_id) as max_id FROM `tours_details`";
		$rec = $this->fetchAll($query);
		return $rec;	
	}

}
?>