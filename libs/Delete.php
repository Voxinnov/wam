<?php
class Delete extends MySql{
	
	function deleteBanner($list){
			
     	$insert	=array('image'=>'');
		$this->update($insert,"db_album",'`album_id`='.$list);		
		return true;
		
	}
function deleteNews($list){
			
     	$insert	=array('image'=>'');
		$this->update($insert,"cms_news",'`news_id`='.$list);		
		return true;
}
function deleteClient($list){
			
     	$insert	=array('logo'=>'');
		$this->update($insert,"clients",'`client_id`='.$list);		
		return true;
}


}
?>