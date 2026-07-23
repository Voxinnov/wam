<?php	 	

class Files extends MySql{

	function getNextOrder(){
		$query="SELECT max(`order`) FROM `cms_downloads` ";
		$rec=	$this->fetchAll($query);
		if(count($rec)>0){
			return $rec[0]['max(`order`)']+1;
		}else{
			return 1;
		}
	}
	

			function addFile($inputs){
					$insert	=	array(
											'published'=>$inputs['published'],'file_path'=>$inputs['file_path'],
										
											'file_title'=>$this->addFilter($this->escapeHtml($inputs['file_title'])),											
											
											'date_added'=>date("Y-m-d "), 'order'=>$inputs['order']
											
											);
				$this->insert($insert,"cms_downloads");	
				//$this->lastId	=	$this->lastInsertId();		
				return true;
			}
			
						//Unpublish
	
	function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'0'),"cms_downloads",'`download_id`='.$list[$i]);
		}
	
	}
	
	//Delete
	function deleteList($list){
		for($i=0;$i<count($list);$i++){
		
			$query="SELECT * FROM `cms_downloads` WHERE `download_id`='".$list[$i]."'";
			$rec=$this->fetchAll($query);
			unlink('../media/downloads/'.$rec[0]['file_path']);
			$this->delete('cms_downloads','`download_id`='.$list[$i]);
			
			
		}
	}
	
	function getInsert(){
		return $this->lastId;
	}
	
	//Publish
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'1'),"cms_downloads",'`download_id`='.$list[$i]);
		}

	}
	function listFiles($values){
		
		$start		=	$values['start'];
		$limit		=	$values['limit'];
		$mode			=	trim($values['mode']);
		$ord			=	trim($values['ord']);
		$keyword	=	trim($values['keyword']);
		$parent		=	trim($values['parent']);
		
		$qry="";
		$order	=	'';
		
		if(!empty($keyword)){
			 $qry.=" AND c.`file_title` LIKE '%$keyword%'" ;
			
		}
			
		
		
		$query	=	"SELECT count(c.`download_id`) FROM `cms_downloads` c WHERE c.`download_id`!=''";
		 $query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`download_id`)'];
	
		
		$query	=	"SELECT * FROM `cms_downloads` c WHERE c.`download_id`!='' ORDER BY `download_id` DESC ";
		$query.=$qry;
		//$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		 $this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	/*
	 * Check Page is top
	*/
	function checkOnTop($id){
		$query="SELECT `download_id` FROM `cms_downloads` WHERE `download_id`='".$id."'";		
		$rec	=	$this->fetchAll($query);
		if(count($rec)>0){
			return true;
		}else{
			return false;
		}
	}
	function getFiles($id){
		$query	=	"SELECT * FROM `cms_downloads` WHERE `download_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	function getAllFiles(){
		$query	=	"SELECT * FROM `cms_downloads` WHERE `published`='1' ORDER BY `default` DESC ";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
	function getDownload(){
		
	$query	=	"SELECT * FROM `cms_downloads` WHERE `default`='1'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	/*
	 * Set a Default Page
	*/
	
	function setDefault($id){
		$this->update(array('default'=>0),"cms_downloads",'');
		$this->update(array('default'=>1),"cms_downloads",'`download_id`='.$id);
	}
	
function updateFiles($inputs){
		$insert	=	array(	
		'published'=>$inputs['published'],
		'file_title'=>$this->addFilter($inputs['file_title']),
		
		'date_added'=>date("Y-m-d")
		);
		
		
		$this->update($insert,"cms_downloads",'`download_id`='.$inputs['id']);
		return true;
	}
	function updateFile($inputs){
		$insert	=	array('file_path'=>$inputs['file_path']);
	
		
		$this->update($insert,"cms_downloads",'`download_id`='.$inputs['id']);
		return true;
	}
	function updateDownloadFile($id,$image){
	
		$this->update(array('file_path'=>$image),'cms_downloads','`download_id`='.$id);
	}
	
		
	function setOrder($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('order'=>$list[$i][1]),"cms_downloads",'`download_id`='.$list[$i][0]);
		}
	}
}

?>