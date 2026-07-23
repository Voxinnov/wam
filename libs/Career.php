<?php	 	

	class Career extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listCareer(){
		
		
		


$query = "SELECT * FROM `jspr_career` c WHERE c.`jspr_career_id`!='' ORDER BY `jspr_career_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	 /* Add Testimonials
			*/			
			function addCareer($inputs){
	$insert	=	array('jspr_career_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),
								'jspr_career_dscrptn'=>$inputs['description'],
								'jspr_career_stus'=>$inputs['status']
										
										
										);
				//print_r($insert);exit;
				$this->insert($insert,"jspr_career");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editCareer($inputs){
	$insert	=	array('jspr_career_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),
								'jspr_career_dscrptn'=>$inputs['description'],
								'jspr_career_stus'=>$inputs['status']
										
							);
				$this->update($insert,"jspr_career",'`jspr_career_id`='.$inputs['id']);		
				return true;
			}

	/*function updateGalleryImage($id,$image){
		 $this->update(array('faculty_image'=>$image),'jspr_career','`jspr_career_id`='.$id);
	}*/
	  function getCareer($id){
		$query	=	"SELECT * FROM `jspr_career` WHERE `jspr_career_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}


	 function getAllCareer(){
		$query	=	"SELECT * FROM `jspr_career` where  jspr_career_stus=1";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}

}
?>