<?php	 	

	class Booking extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	
	/*
			 * Edit Testimonials
			*/			
		function editBooking($inputs){
		$insert	=	array('booking_rithu_ttl'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'booking_rithu_dscrptn'=>$inputs['dscrptn'],
										'booking_rithu_stus'=>$inputs['status']
										
										
										
							);
							//print_r($insert); exit;	
				$this->update($insert,"booking_rithu",'`booking_rithu_id`='.$inputs['id']);		
				return true;
			}
			
	 function getBooking(){
		$query	=	"SELECT * FROM `booking_rithu`";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
?>