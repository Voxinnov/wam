<?php	 	

	class Gallery extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listGallery(){
		
		



		$query = "SELECT * FROM `rithu_gal` INNER JOIN `gal_lst` ON rithu_gal_fldr = gal_lst_id WHERE `rithu_gal_id`!='' ORDER BY `rithu_gal_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
		function listAllGallery($id){
		

	$query = "SELECT * FROM `rithu_gal` INNER JOIN gal_lst ON rithu_gal_fldr = gal_lst_id WHERE `rithu_gal_fldr`=$id and rithu_gal_status=1 ORDER BY `rithu_gal_id` DESC";
	//print_r($query);exit;
		
	$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	

}

	 /* Add Testimonials
			*/			
			function addGallery($inputs){
					$insert	=	array(	'rithu_gal_img'=>$inputs['photo'],
												
												'rithu_gal_fldr'=>$inputs['folder'],
												'rithu_gal_status'=>$inputs['status']								
										);
				//print_r($insert);exit;
				$this->insert($insert,"rithu_gal");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editGallery($inputs){
					$insert	=	array(	'rithu_gal_img'=>$inputs['photo'],
												
												'rithu_gal_fldr'=>$inputs['folder'],
												'rithu_gal_status'=>$inputs['status'],
												'rithu_gal_id'=>$inputs['id']
							);
					//print_r($insert);exit;
				$this->update($insert,"rithu_gal",'`rithu_gal_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('rithu_gal_img'=>$image),'rithu_gal','`rithu_gal_id`='.$id);
	}
	 function getGallery($id){
		$query	=	"SELECT * FROM `rithu_gal` WHERE `rithu_gal_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAllGalleryDetails()
	{
		$query = "SELECT * FROM rithu_gal WHERE rithu_gal_status =1";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}
	
	}
?>