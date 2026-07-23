<?php	 	

	class Project extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listProject(){
		
		
		


		$query = "SELECT * FROM `jspr_prjct` c WHERE c.`jspr_prjct_id`!='' ORDER BY `jspr_prjct_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	  }
	 /* Add Testimonials
			*/			
			function addProject($inputs){
		$insert	=	array('jspr_prjct_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),	
										'jspr_prjct_place'=>$inputs['place'],
										'jspr_prjct_cata'=>$inputs['catogory'],
										'jspr_prjct_typ'=>$inputs['type'],
										'jspr_prjct_img'=>$inputs['photo'],
										'jspr_prjct_stus'=>$inputs['status']
										);
				//print_r($insert);exit;
				$this->insert($insert,"jspr_prjct");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editProject($inputs){
	$insert	=	array('jspr_prjct_title'=>$this->addFilter($this->escapeHtml($inputs['title'])),	
										'jspr_prjct_place'=>$inputs['place'],
										'jspr_prjct_cata'=>$inputs['catogory'],
										'jspr_prjct_typ'=>$inputs['type'],
										'jspr_prjct_img'=>$inputs['photo'],
										'jspr_prjct_stus'=>$inputs['status']
										);
	//print_r($insert);exit;
				$this->update($insert,"jspr_prjct",'`jspr_prjct_id`='.$inputs['id']);		
				return true;
			}

	function updateGalleryImage($id,$image){
		 $this->update(array('jspr_prjct_img'=>$image),'jspr_prjct','`jspr_prjct_id`='.$id);
	}
	 function getProject($id){
		$query	=	"SELECT * FROM `jspr_prjct` WHERE `jspr_prjct_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	function getAllProjectDetails()
	{
		$query = "SELECT * FROM jspr_prjct where jspr_prjct_stus=1";
		$rec = $this->fetchAll($query);
		return $rec;	
	}
function getPro($id)
	{
$query = "SELECT * FROM jspr_prjct where jspr_prjct_stus=1 AND jspr_prjct_typ =1 AND jspr_prjct_cata=$id ";
		$rec = $this->fetchAll($query);
		return $rec;	
	}

	function getAllPrjDetails()
	{
		$query = "SELECT * FROM jspr_prjct where jspr_prjct_stus=1 AND jspr_prjct_typ =1";
		$rec = $this->fetchAll($query);
		return $rec;	
	}
		function getAllPjDetails()
	{
		$query = "SELECT * FROM jspr_prjct where jspr_prjct_stus=1 AND jspr_prjct_typ =2";
		$rec = $this->fetchAll($query);
		return $rec;	
	}

}
?>