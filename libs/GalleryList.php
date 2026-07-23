<?php	 	

	class GalleryList extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listGalleryList(){
		
		
		


		$query = "SELECT * FROM `gal_lst` c WHERE c.`gal_lst_id`!='' ORDER BY `gal_lst_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	 /* Add Testimonials
			*/			
			function addGalleryList($inputs){
					$insert	=	array('gal_lst_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'gal_lst_img'=>$inputs['photo'],	
										'gal_lst_status'=>$inputs['status']
										);
				//print_r($insert);exit;
				$this->insert($insert,"gal_lst");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editGalleryList($inputs){
					$insert	=	array('gal_lst_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'gal_lst_img'=>$inputs['photo'],
										'gal_lst_status'=>$inputs['status'],
										'gal_lst_id'=>$inputs['id']
							);
				$this->update($insert,"gal_lst",'`gal_lst_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('gal_lst_img'=>$image),'gal_lst','`gal_lst_id`='.$id);
	}
	 function getGalleryList($id){
		$query	=	"SELECT * FROM `gal_lst` WHERE `gal_lst_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAllGalleryListDetails()
	{
		$query = "SELECT * FROM gal_lst WHERE gal_lst_status =1 ORDER BY `gal_lst_id` DESC";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}
		function getGalleryListDetails()
	{
		$query = "SELECT * FROM gal_lst";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}


}
?>