<?php	 	

	class Team extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	
	/*
			 * Edit Testimonials
			*/			
		function editTeam($inputs){
		$insert	=	array('team_rithu_ttl'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'team_rithu_dscrptn'=>$inputs['dscrptn'],
										'team_rithu_stus'=>$inputs['status']
										
										
										
							);
							//print_r($insert); exit;	
				$this->update($insert,"team_rithu",'`team_rithu_id`='.$inputs['id']);		
				return true;
			}
			
	 function getTeam(){
		$query	=	"SELECT * FROM `team_rithu`";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
?>