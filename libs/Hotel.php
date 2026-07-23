<?php	 	

	class Hotel extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listHotel(){
		
		
		


		$query = "SELECT * FROM hotels c WHERE c.`hot_id`!='' ORDER BY `hot_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	  }

	  		function listHotelEmp($id){
		
		
		$query = "SELECT * FROM `hotels`  WHERE `hot_id`!='' and hotel_cata like '%$id%' or hotel_cata=$id ORDER BY `hot_id` DESC";
	//print_r($query);exit;
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
				
	}
	 /* Add Testimonials
			*/			
			function addHotel($inputs){
		$insert	=	array('hot_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'hot_details'=>$inputs['description'],
										'hot_stus'=>$inputs['status']
										);
				//print_r($insert);exit;
				$this->insert($insert,"hotels");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editHotel($inputs){
	$insert	=	array('hot_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'hot_details'=>$inputs['description'],
										'hot_stus'=>$inputs['status']
										);
//	print_r($insert);exit;
				$this->update($insert,"hotels",'`hot_id`='.$inputs['id']);		
				return true;
			}

/*	function updateGalleryImage($id,$image){
		 $this->update(array('Hotel_img'=>$image),'Hotel','`hot_id`='.$id);
	}*/
	 function getHotel($id){
		$query	=	"SELECT * FROM hotels WHERE `hot_id`='$id' ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	function getAllHotelDetails()
	{
		$query = "SELECT * FROM hotels where   hot_stus=1";
		$rec = $this->fetchAll($query);
		return $rec;	
	}
	function getAllHotelMax()
	{
		$query = "SELECT max(hot_id) as max_id FROM hotels";
		$rec = $this->fetchAll($query);
		return $rec;	
	}

}
?>