<?php	 	

	class Classified extends MySql{
	
	
	
	function deleteList($list){
					for($i=0;$i<count($list);$i++){
							$this->delete('testimonials','`t_id`='.$list[$i]);
					}
			}	
			
			
	
	function listClassified(){
		
		



		$query = "SELECT * FROM `classifies` WHERE `clas_id`!='' ORDER BY `clas_id` DESC";
	
		$rec	=	$this->fetchAll($query);
	
		
		return $rec;		
		
		
	}
	 /* Add Testimonials
			*/			
			function addClassified($inputs){
					$insert	=	array(	'clas_title'=>$inputs['title'],
											'clas_img'=>$inputs['photo'],
												'clas_status'=>$inputs['status']								
										);
				//print_r($insert);exit;
				$this->insert($insert,"classifies");	
				
				return true;
				
				
			}


		function getInsert(){
		return $this->lastId;
	}
	/*
			 * Edit Testimonials
			*/			
			function editClassified($inputs){
					$insert	=	array(	'clas_img'=>$inputs['photo'],
												
												'clas_title'=>$inputs['title'],
												'clas_status'=>$inputs['status'],
												'clas_id'=>$inputs['id']
							);
					//print_r($insert);exit;
				$this->update($insert,"classifies",'`clas_id`='.$inputs['id']);		
				return true;
			}

	function updateClassifiedImage($id,$image){
		 $this->update(array('clas_img'=>$image),'classifies','`clas_id`='.$id);
	}
	 function getClassified($id){
		$query	=	"SELECT * FROM `classifies` WHERE `clas_id`='$id' ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	function getAllClassifiedDetails()
	{
		$query = "SELECT * FROM classifies WHERE clas_status=1";
		$rec = $this->fetchAll($query);
		//print_r($rec);exit;
		return $rec;	
	}
	
	}
?>