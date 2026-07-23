<?php	 	

	class Generalinfo extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	
	/*
			 * Edit Testimonials
			*/			
		function editGeneralinfo($inputs){
		$insert	=	array('general_info_ttl'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'general_info_dscrptn'=>$inputs['dscrptn'],
										'general_info_stus'=>$inputs['status']
										
										
										
							);
							//print_r($insert); exit;	
				$this->update($insert,"general_info",'`general_info_id`='.$inputs['id']);		
				return true;
			}
			
	 function getGeneralinfo(){
		$query	=	"SELECT * FROM `general_info`";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
?>