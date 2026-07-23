<?php	 	

	class Client extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listClient(){
		
		
		


		$query = "SELECT * FROM `jspr_client` c WHERE c.`jspr_clnt_id`!='' ORDER BY `jspr_clnt_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	  }
	 /* Add Testimonials
			*/			
			function addClient($inputs){
		$insert	=	array('jspr_clnt_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'jspr_clnt_img'=>$inputs['photo'],
										'jspr_clnt_stus'=>$inputs['status'],
										);
				//print_r($insert);exit;
				$this->insert($insert,"jspr_client");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editClient($inputs){
	$insert	=	array('jspr_clnt_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),	
										'jspr_clnt_img'=>$inputs['photo'],
										'jspr_clnt_stus'=>$inputs['status']
										);
	//print_r($insert);exit;
				$this->update($insert,"jspr_client",'`jspr_clnt_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('jspr_clnt_img'=>$image),'jspr_client','`jspr_clnt_id`='.$id);
	}
	 function getClient($id){
		$query	=	"SELECT * FROM `jspr_client` WHERE `jspr_clnt_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	function getAllClientDetails()
	{
		$query = "SELECT * FROM jspr_client where jspr_clnt_stus=1";
		$rec = $this->fetchAll($query);
		return $rec;	
	}

}
?>