<?php	 	

	class About extends MySql{
	
	
	
	/*
			 * Edit Testimonials
			*/			
		function editAbout($inputs){
		$insert	=	array('about_wam_ttl'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'about_wam_dscrptn'=>$inputs['dscrptn'],
										'about_wam_img'=>$inputs['title1']
										
							);
								//print_r($insert); exit;	
				$this->update($insert,"about_wam",'`about_wam_id`='.$inputs['id']);		
				return true;
			}
function updateGalleryImage($id,$image){
		 $this->update(array('about_wam_img'=>$image),'about_wam','`about_wam_id`='.$id);
	}
	 function getAbout(){
		$query	=	"SELECT * FROM `about_wam`";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
?>