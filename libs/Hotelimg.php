<?php	 	

	class Hotelimg extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listHotelimg(){
		
		
		


		$query = "SELECT * FROM `hotel_images` c WHERE c.`hot_img_id`!='' ORDER BY `hot_img_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	
	 /* Add Testimonials
			*/			
			function addHotelimg($inputs){
					$insert	=	array('hot_img'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'hotel'=>$inputs['hotel']
										);
				//print_r($insert);exit;
				$this->insert($insert,"hotel_images");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editHotelimg($inputs){
					$insert	= array('hot_img'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'hotel'=>$inputs['hotel'],	
										'hot_img_id'=>$inputs['id']
							);
				$this->update($insert,"hotel_images",'`hot_img_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		//print_r($image);
		//print_r($id);exit;
		 $this->update(array('hot_img'=>$image),'hotel_images','`hot_img_id`='.$id);
	}
	 function getHotelimg($id){
		$query	=	"SELECT * FROM `hotel_images` WHERE `hot_img_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getHotelimg_act($id){
		$query	=	"SELECT * FROM `hotel_images` WHERE `hotel`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAllHotelimgDetails()
	{
		$query = "SELECT * FROM hotel_images ";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}

}
?>