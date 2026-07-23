<?php	 	

	class Service extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listService(){
		
		
		


		$query = "SELECT * FROM `service_block` c WHERE c.`b_id`!='' ORDER BY `b_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	  }
	 /* Add Testimonials
			*/			
			function addService($inputs){
		$insert	=	array('s_ttl'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										's_dscrptn'=>$inputs['dscrptn'],
										'b_heading'=>$inputs['title1'],
										'b_content'=>$inputs['dscrptn1'],
										'stus'=>$inputs['status']
										
										
										
							);
		//print_r($insert);exit;
				$this->insert($insert,"service_block");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editService($inputs){
		$insert	=	array('s_ttl'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										's_dscrptn'=>$inputs['dscrptn'],
										'b_heading'=>$inputs['title1'],
										'b_content'=>$inputs['dscrptn1'],
										'stus'=>$inputs['status']
										
										
										
							);
	//print_r($insert);exit;
				$this->update($insert,"service_block",'`b_id`='.$inputs['id']);		
				return true;
			}

	 function getService($id){
		$query	=	"SELECT * FROM `service_block` WHERE `b_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	function getAllServiceDetails()
	{
		$query = "SELECT * FROM `service_block` where stus=1";
		$rec = $this->fetchAll($query);
		return $rec;	
	}
	function getAllServiceMax()
	{
		$query = "SELECT max(b_id) as max_id FROM `service_block`";
		$rec = $this->fetchAll($query);
		return $rec;	
	}

}
?>