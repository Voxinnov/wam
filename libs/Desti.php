<?php	 	

	class Desti extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	
	/*
			 * Edit Testimonials
			*/			
		function editDesti($inputs){
		$insert	=	array('about_ttl'=>$this->addFilter($this->escapeHtml($inputs['about_ttl'])),
										'about_main_dscrptn'=>$inputs['about_main_dscrptn'],
										'about_hglts_ttl'=>$inputs['about_hglts_ttl'],
										'about_hglts_dscrptn'=>$inputs['about_hglts_dscrptn'],
										'about_sub_dscrptn'=>$inputs['about_sub_dscrptn'],
										'about_stus'=>$inputs['status']
										
							);
					$this->update($insert,"desti_rithu",'`about_id`='.$inputs['id']);		
				return true;
			}
			function updateGalleryImage($id,$pdf){
		  $this->update(array('about_img_photo'=>$image),'desti_rithu','`about_id`='.$id);
	}

	/*function updateGalleryImage($id,$image){
		 $this->update(array('gip_prfl_img'=>$image),'gip_prfl','`gip_prfl_id`='.$id);
	}*/


	function getDesti($id){
		$query	=	"SELECT * FROM `desti_rithu` where  about_id=$id";

		$rec		=	$this->fetchAll($query);
		return $rec;
	}

	function getAllDestiDetails()
	{
		$query = "SELECT * FROM desti_rithu where about_stus=1";
		$rec = $this->fetchAll($query);
		return $rec;	
	}
	
}
?>