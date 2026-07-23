<?php	 	

	class OfficeBearers extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listOfficeBearers(){
		
		
		


		$query = "SELECT * FROM `gip_ofc_brers` c WHERE c.`gip_ofc_brers_id`!='' ORDER BY `gip_ofc_brers_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	 /* Add Testimonials
			*/			
			function addOfficeBearers($inputs){
					$insert	=	array('gip_ofc_brers_titl'=>$this->addFilter($this->escapeHtml($inputs['pos'])),
										'gip_ofc_brers_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),						
										'gip_ofc_brers_desc'=>' ',
										
										'gip_ofc_brers_img'=>$inputs['photo'],
										'gip_ofc_brers_status'=>$inputs['status'],
										);
				//print_r($insert);exit;
				$this->insert($insert,"gip_ofc_brers");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editOfficeBearers($inputs){
					$insert	=	array('gip_ofc_brers_titl'=>$this->addFilter($this->escapeHtml($inputs['pos'])),
										'gip_ofc_brers_name'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										
										'gip_ofc_brers_img'=>$inputs['photo'],
										'gip_ofc_brers_status'=>$inputs['status'],
										'gip_ofc_brers_id'=>$inputs['id']
							);
						//	print_r($insert);die;
				$this->update($insert,"gip_ofc_brers",'`gip_ofc_brers_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('gip_ofc_brers_img'=>$image),'gip_ofc_brers','`gip_ofc_brers_id`='.$id);
	}
	 function getOfficeBearers($id){
		$query	=	"SELECT * FROM `gip_ofc_brers` WHERE `gip_ofc_brers_id`='$id'  ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAllOfficeBearersDetails()
	{
		$query = "SELECT * FROM gip_ofc_brers where gip_ofc_brers_status=1 ORDER BY `gip_ofc_brers_id` DESC";
		$rec = $this->fetchAll($query);
		return $rec;	
	}

}
?>