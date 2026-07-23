<?php	 	

	class Ourspeci extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	
	/*
			 * Edit Testimonials
			*/			
		function editOurspeci($inputs){
		$insert	=	array('jspr_os_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'jspr_os_dscrptn'=>$inputs['dscrptn'],
										'jspr_os_stus'=>$inputs['status']
										
										
										
							);
							//print_r($insert); exit;	
				$this->update($insert,"jspr_ourspecification",'`jspr_os_id`='.$inputs['id']);		
				return true;
			}
			function updateGalleryImage($id,$pdf){
		  $this->update(array('jspr_abt_img'=>$image),'jspr_ourspecification','`jspr_os_id`='.$id);
	}

	/*function updateGalleryImage($id,$image){
		 $this->update(array('gip_prfl_img'=>$image),'gip_prfl','`gip_prfl_id`='.$id);
	}*/
	 function getOurspeci(){
		$query	=	"SELECT * FROM `jspr_ourspecification`";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
?>