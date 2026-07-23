<?php	 	

	class Virtualtour extends MySql{
	
	
	
			
			
	
	function listVirtualtour(){
		
		
		


		$query = "SELECT * FROM `virtual_tour` c WHERE c.`virtual_tour_id`!='' ORDER BY `virtual_tour_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	 /* Add Testimonials
			*/			
			function addVirtualtour($inputs){
					$insert	=	array('virtual_tour_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'virtual_tour_desc'=>$inputs['descr'],	
										'virtual_tour_link'=>$inputs['link'],	
										'virtual_tour_img'=>$inputs['photo'],	
										'virtual_tour_status'=>$inputs['status']
										);
				//print_r($insert);exit;
				$this->insert($insert,"virtual_tour");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editVirtualtour($inputs){
					$insert	=	array('virtual_tour_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'virtual_tour_desc'=>$inputs['descr'],	
										'virtual_tour_link'=>$inputs['link'],
										'virtual_tour_img'=>$inputs['photo'],
										'virtual_tour_status'=>$inputs['status'],
										'virtual_tour_id'=>$inputs['id']
							);
				$this->update($insert,"virtual_tour",'`virtual_tour_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('virtual_tour_img'=>$image),'virtual_tour','`virtual_tour_id`='.$id);
	}
	 function getVirtualtour($id){
		$query	=	"SELECT * FROM `virtual_tour` WHERE `virtual_tour_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAllVirtualtourDetails()
	{
		$query = "SELECT * FROM virtual_tour WHERE virtual_tour_status =1";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}
		function getVirtualtourDetails()
	{
		$query = "SELECT * FROM virtual_tour";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}


}
?>