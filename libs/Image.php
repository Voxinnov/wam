<?php	 	

	class Image extends MySql{
	
	
	/*
	 * Upload Banner Image
	*/
	
	function addimage($albumid,$bantit,$image){
		$insert	=	array('album_id'=>$albumid,'image_title'=>$bantit,'date_added'=>date('Y-m-d'),
					'image_path'=>$image,'published'=>'1');
		$this->insert($insert,'db_images');
	
	}
	
	
	/*
	* Delete imaes
	*/
	
	function deleteList($list){
		for($i=0;$i<count($list);$i++){
		
			$query="SELECT * FROM `db_images` WHERE `images_id`='".$list[$i]."'";
			$rec=$this->fetchAll($query);
			unlink('../media/albums/'.$rec[0]['image_path']);
			$this->delete('db_images','`images_id`='.$list[$i]);
			
			
		}
	}

	/*
	* Un Publush records
	*/	
	function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'0'),"db_images",'`images_id`='.$list[$i]);
		}
	}
			
			
	/*
		* Publush records
	*/
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'1'),"db_images",'`images_id`='.$list[$i]);
		}
	}

	function listimage($values,$passid){
		
		$start		=	$values['start'];
		$limit		=	$values['limit'];
		$mode			=	trim($values['mode']);
		$ord			=	trim($values['ord']);
		$keyword	=	trim($values['keyword']);
		$parent		=	trim($values['parent']);
		
		$qry="";
		$order	=	'';
		
		if(!empty($keyword)){
			$qry.=' AND LOWER(c.`title`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
		}
		if(trim($parent)!=''){
			$qry.=' AND c.`album_id`=\''.$parent.'\'';
		}
		
		
		$query	=	"SELECT count(c.`images_id`) FROM `db_images` c WHERE c.`album_id`='$passid'";
		 $query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`images_id`)'];
		$order=" ORDER BY `order`";
		$query	=	"SELECT * FROM `db_images` WHERE `album_id`='$passid'";
		$query.=$qry;
		 $query.=$order;
		$query.=' LIMIT '.$start.','.$limit;

		
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}


	function getCover(){
		$query="SELECT * FROM `db_images` WHERE `album_id`='$id' AND `status`='1' ORDER BY rand() LIMIT 0,1";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	function getOneImage($id){
		$query="SELECT * FROM `db_images` WHERE `album_id`='$id' AND `status`='1' ORDER BY rand() LIMIT 0,1";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	function albumFullList(){
		$query='SELECT * FROM `cms_album` WHERE `status`=\'1\' LIMIT 0,50';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}

	function getAlbumImages($id){
		$query="SELECT * FROM `db_images` WHERE `album_id`='$id' AND `published`='1' ORDER BY `order` ASC ";
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	function albumDetails($id){
		$query='SELECT * FROM `cms_album` WHERE `album_id`=\''.$id.'\'';
		$rec	=	$this->fetchAll($query);
		return $rec;
	}
	
	function getImage($id){
		$query	=	"SELECT * FROM `db_images` WHERE `album_id`='$id' AND `published`='1'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
}
?>
	