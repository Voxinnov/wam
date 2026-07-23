<?php	 	

	class Gallerydscrptn extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	
	/*
			 * Edit Testimonials
			*/			
		function editGallerydscrptn($inputs){
$insert	=	array('gallery_dscrptn_d'=>$this->addFilter($this->escapeHtml($inputs['dscrptn'])),
										'gallery_dscrptn_stus'=>$inputs['status']
										
										
										
							);
							//print_r($insert); exit;	
				$this->update($insert,"gallery_dscrptn",'`gallery_dscrptn_id`='.$inputs['id']);		
				return true;
			}
			
	 function getGallerydscrptn(){
		$query	=	"SELECT * FROM `gallery_dscrptn`";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
?>