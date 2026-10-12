<?php

class Faq extends MySql{

	function getNextOrder(){
		$query="SELECT max(`order`) FROM `cms_faq`";
		$rec=	$this->fetchAll($query);
		if(count($rec)>0){
			return $rec[0]['max(`order`)']+1;
		}else{
			return 1;
		}
	}
	
	/*
	 * Add New Content
	 * input=Array of values
	*/
	function addFaq($inputs){
		$insert	=	array(	'question'=>$inputs['question'],
				'answer'=>$inputs['answer'],
				'published'=>$inputs['published'],
				'date_update'=>date("Y-m-d H:i:s"),
				'order'=>$inputs['order']
				);
		$this->insert($insert,"cms_faq");	
		$this->lastId	=	$this->lastInsertId();	
		return true;
		
	}
	
	function getInsert(){
		return $this->lastId;
	}
	
	/*
	 * Update Content
	*/
	function updateFaq($inputs){
		$insert	=	array(	'question'=>$inputs['question'],
				'answer'=>$inputs['answer'],
				'published'=>$inputs['published'],
				'date_update'=>date("Y-m-d H:i:s")
		);
		$this->update($insert,"cms_faq",'`faq_id`='.$inputs['id']);
		return true;
	}
	
	
	/*
	 *  List Contents
	*/
	
	function listFaq($values){
		
		$start		=	$values['start'];
		$limit		=	$values['limit'];
		$mode			=	trim($values['mode']);
		$ord			=	trim($values['ord']);
		$keyword	=	trim($values['keyword']);
		$parent		=	trim($values['parent']);
		
		$qry="";
		$order	=	'';
		
		if(!empty($keyword)){
			$qry.=' AND LOWER(c.`question`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
		}
		if(trim($parent)!=''){
			$qry.=' AND c.`parent`=\''.$parent.'\'';
		}
		if(!empty($mode) && !empty($ord)){
			if($mode=='title'){
				if($ord=='dsc'){
					$order=' ORDER BY c.`question` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`question` ASC';
				}
			}
			if($mode=='order'){
				if($ord=='dsc'){
					$order=' ORDER BY c.`order` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`order` ASC';
				}
			}
		}else{
			$order=" ORDER BY c.`faq_id` DESC";
		}
		
		$query	=	"SELECT count(c.`faq_id`) FROM `cms_faq` c WHERE c.`faq_id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		$this->totalRecords	=	$rec[0]['count(c.`faq_id`)'];
		
		 $query	=	"SELECT c.*  FROM `cms_faq` c WHERE c.`faq_id`!=''";
		$query.=$qry;
		$query.=$order;
		$query.=' LIMIT '.$start.','.$limit;
		 $rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
	
		
	}
	
	
	/*
	 * Delete the COntents
	*/	
	function deleteList($list){
		for($i=0;$i<count($list);$i++){								
			$this->delete("cms_faq",'`faq_id`='.$list[$i]);
						
		}
	}
	
	/*
	 * Un Publush records
	*/	
	function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'0'),"cms_faq",'`faq_id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Publush records
	*/
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('published'=>'1'),"cms_faq",'`faq_id`='.$list[$i]);
		}
	}
	
	

	

	/*
	 * Set Order for Pages
	*/
		
	function setOrder($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('order'=>$list[$i][1]),"cms_faq",'`faq_id`='.$list[$i][0]);
		}
	}
	
	function getFaq($id){
		$query	=	"SELECT * FROM `cms_faq` WHERE `faq_id`='$id'";
		$rec		=	$this->fetchAll($query);
		return $rec;
	}
	
}
	