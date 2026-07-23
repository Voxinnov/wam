<?php	 	

	class Travel extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	
	/*
			 * Edit Testimonials
			*/			
		function editTravel($inputs){
		$insert	=	array('travel_rithu_ttl'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'travel_rithu_dscrptn'=>$inputs['dscrptn'],
										'travel_rithu_stus'=>$inputs['status']
										
										
										
							);
							//print_r($insert); exit;	
				$this->update($insert,"travel_rithu",'`travel_rithu_id`='.$inputs['id']);		
				return true;
			}
			
	 function getTravel(){
		$query	=	"SELECT * FROM `travel_rithu`";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
?>