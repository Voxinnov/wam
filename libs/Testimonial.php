<?php	 	

	class Testimonial extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listTestimonial(){
		
		
		


$query = "SELECT * FROM `testim` WHERE `testim_id`!='' ORDER BY `testim_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	 /* Add Testimonials
			*/			
			function addTestimonial($inputs){
	$insert	=	array('testim_name'=>$this->addFilter($this->escapeHtml($inputs['name'])),
								'testim_place'=>$inputs['place'],
								'testim_contnt'=>$inputs['contn'],
								'testim_stat'=>$inputs['status']
										
										
										);
				//print_r($insert);exit;
				$this->insert($insert,"testim");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editTestimonial($inputs){
	$insert	=	array('testim_name'=>$this->addFilter($this->escapeHtml($inputs['name'])),
								'testim_place'=>$inputs['place'],
								'testim_contnt'=>$inputs['contn'],
								'testim_stat'=>$inputs['status']
										
										
										);
				$this->update($insert,"testim",'`testim_id`='.$inputs['id']);		
				return true;
			}

	/*function updateGalleryImage($id,$image){
		 $this->update(array('faculty_image'=>$image),'testim','`testim_id`='.$id);
	}*/
	  function getTestimonial($id){
		$query	=	"SELECT * FROM `testim` WHERE `testim_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}


	 function getAllTestimonial(){
		$query	=	"SELECT * FROM `testim` where  testim_stat=1";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}

}
?>