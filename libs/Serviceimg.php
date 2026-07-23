<?php	 	

	class Serviceimg extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listServiceimg(){
		
		
		


		$query = "SELECT * FROM `service_img` c WHERE c.`service_img_id`!='' ORDER BY `service_img_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
 /* Add Testimonials
			*/			
			function addServiceimg($inputs){
				$insert	=	array('service_img_photo'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'service'=>$inputs['service']
										);
					//print_r($insert); exit;
				
				$this->insert($insert,"service_img");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/	

			function editServiceimg($inputs){
$insert	=	array('service_img_photo'=>$this->addFilter($this->escapeHtml($inputs['photo'])),
										'service'=>$inputs['service'],	
										'service_img_id'=>$inputs['id']
										);
					//print_r($insert); exit;	
				$this->update($insert,"service_img",'`service_img_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('service_img_photo'=>$image),'service_img','`service_img_id`='.$id);
	}
	 function getServiceimg($id){
		$query	=	"SELECT * FROM `service_img` WHERE `service_img_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}

	function getServiceimg_act($id){
		$query	=	"SELECT * FROM `service_img` WHERE `service`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
		//print_r($query);exit;
	}

	function getAllServiceimgDetails()
	{
		$query = "SELECT * FROM service_img";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}

}
?>