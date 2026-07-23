
<?php	 	

	class Activitydscrptn extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	
	/*
			 * Edit Testimonials
			*/			
		function editActivitydscrptn($inputs){
$insert	=	array('actvty_dscrptn_cntnt'=>$this->addFilter($this->escapeHtml($inputs['dscrptn'])),
										'actvty_dscrptn_stus'=>$inputs['status']
										
										
										
							);
							//print_r($insert); exit;	
				$this->update($insert,"actvty_dscrptn",'`actvty_dscrptn_id`='.$inputs['id']);		
				return true;
			}
			
	 function getActivitydscrptn(){
		$query	=	"SELECT * FROM `actvty_dscrptn`";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
?>