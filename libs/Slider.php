<?php	 	

	class Slider extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listSlider(){
		
		
		


		$query = "SELECT * FROM `rithu_slider` c WHERE c.`rithu_slider_id`!='' ORDER BY `rithu_slider_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
		function listSliderId(){
		
		
		


		$query = "SELECT * FROM `rithu_slider` c WHERE c.`rithu_slider_id`!=''  ORDER BY `rithu_slider_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	 /* Add Testimonials
			*/			
			function addSlider($inputs){
					$insert	=	array('rithu_slider_ttl'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'rithu_slider_cptn'=>$this->addFilter($this->escapeHtml($inputs['caption'])),
										'rithu_slider_photo'=>$inputs['photo'],
										'rithu_slider_stus'=>$inputs['status'],
										);
				
				$this->insert($insert,"rithu_slider");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editSlider($inputs){
					$insert	=	array('rithu_slider_ttl'=>$this->addFilter($this->escapeHtml($inputs['title'])),
										'rithu_slider_cptn'=>$this->addFilter($this->escapeHtml($inputs['caption'])),
										'rithu_slider_photo'=>$inputs['photo'],
										'rithu_slider_stus'=>$inputs['status'],
										'rithu_slider_id'=>$inputs['id']
							);
					//print_r($insert);exit;
				$this->update($insert,"rithu_slider",'`rithu_slider_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('rithu_slider_photo'=>$image),'rithu_slider','`rithu_slider_id`='.$id);
	}
	 function getSlider($id){
		$query	=	"SELECT * FROM `rithu_slider` WHERE `rithu_slider_id`='$id' ";
		$rec		=	$this->fetchAll($query);
		//print_r($query);exit;
		return $rec;
	}
	function getAllSliderDetails()
	{
		$query = "SELECT * FROM rithu_slider where  rithu_slider_stus=1 ORDER BY `rithu_slider_id` DESC";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}

}
?>