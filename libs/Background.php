<?php	 	

	class Background extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listGallery(){
		
		
		


		$query = "SELECT * FROM `back_img`";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	  }
	 /* Add Testimonials
			*/			
		/*	function addGallery($inputs){
		$insert	=	array('gal_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),					
										'gal_typ_cata'=>$inputs['catogory'],
										'back_img_img'=>$inputs['photo'],
										'gal_stus'=>$inputs['status']
										
							);
				//print_r($insert);exit;
				$this->insert($insert,"back_img");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}*/
	/*
			 * Edit Testimonials
			*/			
	

	function updateGalleryImage($id,$image){
		 $this->update(array('back_img_img'=>$image),'back_img','`back_img_id`='.$id);
	}
	 function getGallery($id){
		$query	=	"SELECT * FROM `back_img` WHERE `back_img_id`=$id";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	 
	function getAllGalleryDetails()
	{
		$query = "SELECT * FROM back_img ";
		$rec = $this->fetchAll($query);
		return $rec;	
	}

}
?>