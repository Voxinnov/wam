
<?php	 	

	class Tourdscrptn extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	
	/*
			 * Edit Testimonials
			*/			
		function editTourdscrptn($inputs){
$insert	=	array('tour_dscrptn_cntnt'=>$this->addFilter($this->escapeHtml($inputs['dscrptn'])),
										'tour_dscrptn_stus'=>$inputs['status']
										
										
										
							);
							//print_r($insert); exit;	
				$this->update($insert,"tour_dscrptn",'`tour_dscrptn_id`='.$inputs['id']);		
				return true;
			}
			
	 function getTourdscrptn(){
		$query	=	"SELECT * FROM `tour_dscrptn`";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
?>