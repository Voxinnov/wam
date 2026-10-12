<?php 
class Admin extends MySql{

function getNextOrder(){
		$query="SELECT max(`order`) FROM `clients`";
		$rec=	$this->fetchAll($query);
		if(count($rec)>0){
			return $rec[0]['max(`order`)']+1;
		}else{
			return 1;
		}
	}
	function testAd(){
		$query= "SELECT * FROM `rithu_admin`  WHERE `id`='1'";
		 $rec		=	$this->fetchAll($query);
		 return $rec;
		
		}
	
	
function userLogin($array){
		$this->username	=	$array["user_name"];
		$this->password	=	$array["password"];
	
		 $query	=	"SELECT * FROM `rithu_admin` WHERE BINARY `rithu_admin_uname`=BINARY '".$this->addFilter($this->username)."' and 
		             BINARY rithu_admin_password = BINARY '".$this->addFilter($this->password)."' ";
		           //print_r($query); exit;
		 $rec		=	$this->fetchAll($query);
//print_r($rec); exit;
	
		if(count($rec)>0){
			
			$password	=	$array["password"];
			if($password==$rec[0]["rithu_admin_password"]){
				$this->adminID	=	$rec[0]["rithu_admin_id"];
				$this->userName	=	$rec[0]["rithu_admin_uname"];
				//$this->adminStatus	=	$rec[0]["status"];
				
				 $rec[0]["id"];
				// $rec[0]["email"];
				 $rec[0]["user_name"];
				 $rec[0]["password"];
				// $rec[0]["status"];
				//$this->dateCreated		=	$rec[0]["date_create"];				
				return true;
			}	
		}		
		return false;
	}
function userRegisteralready($array){
		$this->email	=	$array["email"];
		$this->password	=	$array["password"];
	
		 $query	=	"SELECT * FROM `depaul_alumni` WHERE BINARY `alumni_email`= BINARY '".$this->addFilter($this->email)."' and 
		             BINARY alumni_password = BINARY '".$this->addFilter($this->password)."'";
		 $rec		=	$this->fetchAll($query);
		//print($query);exit;
		 return $rec;
}

function loginAlumni($array){
		$this->email	=	$array["email"];
		$this->password	=	$array["password"];
	
		 $query	=	"SELECT * FROM `depaul_alumni` WHERE BINARY `alumni_email`= BINARY '".$this->addFilter($this->email)."' and 
		             BINARY alumni_password = BINARY '".$this->addFilter($this->password)."' and alumni_status ='approve' ";
		 $rec		=	$this->fetchAll($query);
		if(count($rec)>0){
			
			$password	=	$array["password"];
			if($password==$rec[0]["alumni_password"]){
				$this->userID	=	$rec[0]["alumni_id"];
				$this->userName	=	$rec[0]["alumni_email"];
				//$this->adminStatus	=	$rec[0]["status"];
				
				 $rec[0]["alumni_password"];
				// $rec[0]["email"];
				 $rec[0]["alumni_id"];
				 $rec[0]["alumni_email"];
				// $rec[0]["status"];
				//$this->dateCreated		=	$rec[0]["date_create"];				
				return true;
			}	
		}		
		return false;
}
function activeAdmin($username)
		{
		$query	=	"SELECT * FROM `admin` WHERE `user_name`='$username' AND `status`=1";
		
		  $rec	= $this->fetchAll($query);
 		return $rec;
	
	    }	

/*
	 * Add New Content
	 * input=Array of values
	*/
	function addAdmin($inputs){
		
 $insert	=	array(  'name'=>$this->addFilter($inputs['name']),
							'username'=>$inputs['username'],
							'password'=>$inputs['password'],
							'email'=>$inputs['email'],
							'mobile'=>$inputs['mobile'],
							'status'=>$inputs['status'],
							'position'=>$inputs['position'],
							'photo'=>$inputs["photo"]
							);
							
			
		$this->insert($insert,"admin");
		$this->lastId	=	$this->lastInsertId();	
		return true;
		
	}
	function updateLastLogin($id){
		$date=date("Y-m-d H:i:s");
		$query= "UPDATE admin SET last_login='$date' WHERE id='$id'";
		$this->execute($query);
		return $query;
	}
	
	function getInsert(){
		return $this->lastId;
	}
	
	function getClientId($passid)
	{
		$query= "SELECT * FROM `clients`  WHERE `client_id`='$passid'";
		 $rec		=	$this->fetchAll($query);
		 return $rec;
		
	}
		function getFileId($fileid)
	{
		$query= "SELECT * FROM `file_categories`  WHERE `file_id`='$fileid'";
		 $rec		=	$this->fetchAll($query);
		 return $rec;
		
	}
    

	/*
	 * Update Content
	*/
	function updateAdmin($inputs){
		
		$insert	=	array(  'name'=>$this->addFilter($inputs['name']),
							'user_name'=>$inputs['user_name'],
							'password'=>$inputs['password'],
							'email'=>$inputs['email'],
							'phone'=>$inputs['phone'],
							'id'=>$inputs['id']
							);
							
		
		 $this->update($insert,"admin",'`id`='.$inputs['id']);
		return true;
	}
	
	
		function updatePassword($password){
		$insert	=	array(	
				'password'=>$this->addFilter($password['password']));
		$this->update($insert,"clients",'`client_id`='.$password['id']);
		
		return true;
	}
	
	
	
		function updateEmail($inputs){
		 $insert	=array('code'=>$this->addFilter($inputs['code']),'email_id'=>$this->addFilter($inputs['email_id']));
		$rec	= $this->fetchAll("SELECT * FROM `temp`");  
		if (!empty($rec)){			
		$this->update($insert,"temp",$rec[0]['temp_id']);
		}else{									
	       $this->insert($insert,"temp",'');	
		   }	
		return true;
	}     
	
	
	function getCodeInfo()
         {
		$query	=	"SELECT * FROM  `temp`";
		
		return $this->fetchAll($query);
	
	    }
	
		function updateLogo($id,$image){
		$this->update(array('logo'=>$image),'clients','`client_id`='.$id);
	}
	
	
	function getPicture($id){		
		
	    $query="SELECT *  FROM `clients` WHERE client_id='$id'";		
		$rec	=	$this->fetchAll($query);		
		return $rec;		
		
	}
	

	
	/*
	 * Delete the COntents
	*/	
	
	
			function deleteList1($list){
		for($i=0;$i<count($list);$i++){
		
			$query="SELECT * FROM `admin` WHERE `id`='".$list[$i]."'";
			$rec=$this->fetchAll($query);
			unlink('../admin/photo/'.$rec[0]['photo']);
			$this->delete('admin','`id`='.$list[$i]);
			
			
		}
	}
			
		/*
	 * Un Publush records
	*/	
	function unpublishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'0'),"admin",'`id`='.$list[$i]);
		}
	}
	
	
	/*
	 * Publush records
	*/
	
	function publishList($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'1'),"admin",'`id`='.$list[$i]);
		}
	}
	
	
	
	
		function highlightList($list){
		
		for($i=0;$i<count($list);$i++){
		
			$query	=	"SELECT * FROM `clients` WHERE `client_id`=".$list[$i];
			$res	=	$this->fetchAll($query);
		
		if($res[0]['highlights']==1){
		
			$this->update(array('highlights'=>'0'),'clients','`client_id`='.$list[$i]);
		}
		else if($res[0]['highlights']==0){
				$this->update(array('highlights'=>'1'),'clients','`client_id`='.$list[$i]);
		}
	}
}	

	function updatestatus($id)
	{
		 $this->update(array('aprove'=>'1'),'clients','`client_id`='.$id);
	}
	
	function updateNew_email($inputs){
		$insert	=array('email'=>$this->addFilter($inputs['email']));
				    
											
	       $this->update($insert,"clients",'`client_id`='.$inputs['id']);		
		return true;
	}  
	/*
	 * Set Order for Pages
	*/
		
/*	function setOrder($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('order'=>$list[$i][1]),"db_people",'`people_id`='.$list[$i][0]);
		}
	}   */
	
	
	
	/*
	*get details of logged in admin
	*/
	function getAdmin($id){
		  $query = "SELECT * FROM `admin` WHERE `id`='$id'";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }
	function getAll(){
		  $query = "SELECT * FROM `category` ";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }
   function getAllSub(){
		  $query = "SELECT * FROM `sub_category` ";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }
	
	function updateBanner($id,$image){
		 $this->update(array('photo'=>$image),'admin','`id`='.$id);
	}
	
	function getEmail($email){
				$query="SELECT * FROM `admin` WHERE `email`='$email'";
				$rec	=	$this->fetchAll($query);
				return $rec;
			} 
			
			 function getLoggedData($userid)
         {
		 $query	=	"SELECT * FROM  `admin` where `id`='1'";
		
		$rec	= $this->fetchAll($query);
		return $rec;
	
	    }	
			function getUsername($username){
				$query="SELECT * FROM `admin` WHERE `username`='$username'";
				$rec	=	$this->fetchAll($query);
				return $rec;
			} 
			
/******************************************************* Product Table Starting **************************************************/			
			
		/* Get Details of Product */
		
		function getProduct($id){
		  $query = "SELECT * FROM `category` WHERE `id`='$id'";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }	
   
   function getEmployee($id){
		  $query = "SELECT * FROM `employee` WHERE `id`='$id'";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }	
   
   /*
	 * Update Product Details
	*/
	function updateProduct($inputs){
		
		$insert	=	array(  'name'=>$this->addFilter($inputs['name']),
							'price'=>$inputs['price'],
							'quantity'=>$inputs['quantity'],
							'description'=>$inputs['description'],
							'id'=>$inputs['id']
							);
							
		
		 $this->update($insert,"product",'`id`='.$inputs['id']);
		return true;
	}
	
	function updateUserProduct($inputs){
		
		$insert	=	array( 
		                    'name'=>$this->addFilter($inputs['name']),
							'price'=>$inputs['price'],
							'description'=>$inputs['description'],
							'status'=>$inputs['status'],
							'id'=>$inputs['id']
							);
							
		
		 $this->update($insert,"product",'`id`='.$inputs['id']);
		return true;
	}
	/* Update Product Banner*/
	
	function updateProductBanner($id,$image){
		 $this->update(array('photo'=>$image),'category','`id`='.$id);
	}
	
	function updateUserProductBanner($id,$image){
		 $this->update(array('photo'=>$image),'product','`id`='.$id);
	}
	
	function updateEmployeeBanner($id,$image){
		 $this->update(array('photo'=>$image),'employee','`id`='.$id);
	}
	
	
	/*
	 *  List Contents
	*/
	
	function listProducts($values){
		
		$start		=	$values['start'];
		$limit		=	$values['limit'];
		$mode		=	trim($values['mode']);
		$ord		=	trim($values['ord']);
		$keyword	=	trim($values['keyword']);
		$parent		=	trim($values['parent']);
		
		$qry="";
		$order	=	'';
		
		if(!empty($keyword)){
			$qry.=' AND LOWER(c.`category`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
		}
	 if(trim($parent)!=''){
			$qry.=' AND c.`id`=\''.$parent.'\'';
		}
		if(!empty($mode) && !empty($ord)){
			if($mode=='name'){
				if($ord=='dsc'){
					$order=' ORDER BY c.`category` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`category` ASC';
				}
			}
			if($mode=='order'){
				if($ord=='dsc'){

					$order=' ORDER BY c.`id` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`id` ASC';
				}
			}
		}else{
			$order=" ORDER BY c.`id` ASC";
		}
		
		$query	=	"SELECT count(c.`id`) FROM `category` c WHERE c.`id`!='' ";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		 $this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
	 $query	=	"SELECT c.*  FROM `category` c WHERE c.`id`!='' ORDER BY id DESC";

	 	$query.=$qry;
		
	
		$query.=' LIMIT '.$start.','.$limit;
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	
	function addProduct($inputs){
		
    $insert	=	array(  'category'=>$this->addFilter($inputs['category']),
							'location'=>$inputs['location'],
							'date'=>$inputs["date"],
							'status'=>$inputs["status"],
							'photo'=>$inputs["photo"],
							);
							
			
		$this->insert($insert,"category");
		$this->lastId	=	$this->lastInsertId();	
		return true;
		
	}
	
	
	function addSub($inputs){
		
    $insert	=	array(  'sub_category'=>$this->addFilter($inputs['sub_category']),
							'category_id'=>$inputs['category_id'],
							'date'=>$inputs["date"],
							'status'=>$inputs["status"],
							'location'=>$inputs["location"],
							);
							
			
		$this->insert($insert,"sub_category");
		$this->lastId	=	$this->lastInsertId();	
		return true;
		
	}
	
	function deleteList($list){
		for($i=0;$i<count($list);$i++){
		
			$query="SELECT * FROM `category` WHERE `id`='".$list[$i]."'";
			$rec=$this->fetchAll($query);
			//unlink('../media/logo/'.$rec[0]['logo']);
			$this->delete('category','`id`='.$list[$i]);
			
			
		}
	}
	
	function deleteSub($list){
		for($i=0;$i<count($list);$i++){
		
			$query="SELECT * FROM `sub_category` WHERE `id`='".$list[$i]."'";
			$rec=$this->fetchAll($query);
			//unlink('../media/logo/'.$rec[0]['logo']);
			$this->delete('sub_category','`id`='.$list[$i]);
			
			
		}
	}
	
	function Approve($list){
		for($i=0;$i<count($list);$i++){
			$this->update(array('status'=>'1'),"product",'`id`='.$list[$i]);
		}
	}
	
	
		function listUserProducts($values){
		
		$start		=	$values['start'];
		$limit		=	$values['limit'];
		$mode		=	trim($values['mode']);
		$ord		=	trim($values['ord']);
		$keyword	=	trim($values['keyword']);
		$parent		=	trim($values['parent']);
		
		$qry="";
		$order	=	'';
		
		if(!empty($keyword)){
			$qry.=' AND LOWER(c.`name`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
		}
	 if(trim($parent)!=''){
			$qry.=' AND c.`id`=\''.$parent.'\'';
		}
		if(!empty($mode) && !empty($ord)){
			if($mode=='name'){
				if($ord=='dsc'){
					$order=' ORDER BY c.`id` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`id` ASC';
				}
			}
			if($mode=='order'){
				if($ord=='dsc'){

					$order=' ORDER BY c.`id` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`id` ASC';
				}
			}
		}else{
			$order=" ORDER BY c.`id` ASC";
		}
		
		$query	=	"SELECT count(c.`id`) FROM `product` c WHERE c.`id`!='' AND c.`user_name`!='' AND c.`user_email`!='' ";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		 $this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
	 $query	=	"SELECT c.*  FROM `product` c WHERE c.`id`!='' AND c.`user_name`!='' AND c.`user_email`!='' ORDER BY id DESC";

	 	$query.=$qry;
		
	
		$query.=' LIMIT '.$start.','.$limit;
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	
	

/********************************************--- End Product Table ---************************************************/

/*******************************************--- Pages Table Starting ---**********************************************/
	
		
	function listSub($values){
		
		$start		=	$values['start'];
		$limit		=	$values['limit'];
		$mode		=	trim($values['mode']);
		$ord		=	trim($values['ord']);
		$keyword	=	trim($values['keyword']);
		$parent		=	trim($values['parent']);
		
		$qry="";
		$order	=	'';
		
		if(!empty($keyword)){
			$qry.=' AND LOWER(c.`title`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
		}
	 if(trim($parent)!=''){
			$qry.=' AND c.`id`=\''.$parent.'\'';
		}
		if(!empty($mode) && !empty($ord)){
			if($mode=='title'){
				if($ord=='dsc'){
					$order=' ORDER BY c.`id` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`id` ASC';
				}
			}
			if($mode=='order'){
				if($ord=='dsc'){

					$order=' ORDER BY c.`id` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`id` ASC';
				}
			}
		}else{
			$order=" ORDER BY c.`id` ASC";
		}
		
		$query	=	"SELECT count(c.`id`) FROM `sub_category` c WHERE c.`id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		 $this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
	 $query	=	"SELECT c.*  FROM `sub_category` c WHERE c.`id`!='' ORDER BY id DESC";

	 	$query.=$qry;
		
	
		$query.=' LIMIT '.$start.','.$limit;
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	
			
	function listEmployee($values){
		
		$start		=	$values['start'];
		$limit		=	$values['limit'];
		$mode		=	trim($values['mode']);
		$ord		=	trim($values['ord']);
		$keyword	=	trim($values['keyword']);
		$parent		=	trim($values['parent']);
		
		$qry="";
		$order	=	'';
		
		if(!empty($keyword)){
			$qry.=' AND LOWER(c.`name`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
		}
	 if(trim($parent)!=''){
			$qry.=' AND c.`id`=\''.$parent.'\'';
		}
		if(!empty($mode) && !empty($ord)){
			if($mode=='name'){
				if($ord=='dsc'){
					$order=' ORDER BY c.`id` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`id` ASC';
				}
			}
			if($mode=='order'){
				if($ord=='dsc'){

					$order=' ORDER BY c.`id` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`id` ASC';
				}
			}
		}else{
			$order=" ORDER BY c.`id` ASC";
		}
		
		$query	=	"SELECT count(c.`id`) FROM `employee` c WHERE c.`id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		 $this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
	 $query	=	"SELECT c.*  FROM `employee` c WHERE c.`id`!='' ORDER BY id DESC";

	 	$query.=$qry;
		
	
		$query.=' LIMIT '.$start.','.$limit;
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	
	function getPage($id){
		  $query = "SELECT * FROM `pages` WHERE `id`='$id'";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }
   function getCategory($id){
		  $query = "SELECT * FROM `category` WHERE `id`='$id'";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }
   
   function getSubCat($id){
		  $query = "SELECT * FROM `sub_category` WHERE `id`='$id'";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }
   function getCat($id){
		  $query = "SELECT `category` FROM `category` WHERE `id`='$id'";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }	
   
   /*
	 * Update page Details
	*/
	function updatePage($inputs){
		
		$insert	=	array(  'title'=>$this->addFilter($inputs['title']),
							'meta_description'=>$inputs['meta_description'],
							'description'=>$inputs['description'],
							'status'=>$inputs['status'],
							'id'=>$inputs['id']
							);
							
		
		 $this->update($insert,"pages",'`id`='.$inputs['id']);
		return true;
	}
	
	function updateSub($inputs){
		
		$insert	=	array(  'sub_category'=>$this->addFilter($inputs['sub_category']),
							'category_id'=>$inputs['category_id'],
							'location'=>$inputs['location'],
							'status'=>$inputs['status'],
							'id'=>$inputs['id']
							);
							
		
		 $this->update($insert,"sub_category",'`id`='.$inputs['id']);
		return true;
	}
	
   function addPage($inputs){
		//$date=date("d-m-y h:i:s");    
		$insert	=	array(  'title'=>$this->addFilter($inputs['title']),
							'meta_description'=>$inputs['meta_description'],
							'description'=>$inputs["description"],
							'date'=>$inputs["date"],
							'status'=>$inputs["status"],
							);
							
			
		$this->insert($insert,"pages");
		$this->lastId	=	$this->lastInsertId();	
		return true;
		
	}
	
	 function addEmployee($inputs){
		//$date=date("d-m-y h:i:s");    
		$insert	=	array(  'name'=>$this->addFilter($inputs['name']),
							'email'=>$inputs['email'],
							'phone'=>$inputs["phone"],
							'date'=>$inputs["date"],
							'sub_id'=>$inputs["sub_id"],
							'status'=>$inputs["status"],
							);
							
			
		$this->insert($insert,"employee");
		$this->lastId	=	$this->lastInsertId();	
		return true;
		
	}
	
	function updateEmployee($inputs){
		
		$insert	=	array(  'name'=>$this->addFilter($inputs['name']),
							'email'=>$inputs['email'],
							'phone'=>$inputs["phone"],
							'date'=>$inputs["date"],
							'sub_id'=>$inputs["sub_id"],
							'status'=>$inputs["status"],
							);
							
		
		 $this->update($insert,"employee",'`id`='.$inputs['id']);
		return true;
	}
	
	function deletePages($list){
		for($i=0;$i<count($list);$i++){
		
			$query="SELECT * FROM `pages` WHERE `id`='".$list[$i]."'";
			$rec=$this->fetchAll($query);
			//unlink('../media/logo/'.$rec[0]['logo']);
			$this->delete('pages','`id`='.$list[$i]);
			
			
		}
	}
	function deleteEmployee($list){
		for($i=0;$i<count($list);$i++){
		
			$query="SELECT * FROM `employee` WHERE `id`='".$list[$i]."'";
			$rec=$this->fetchAll($query);
			//unlink('../media/logo/'.$rec[0]['logo']);
			$this->delete('employee','`id`='.$list[$i]);
			
			
		}
	}
	

/*******************************************--- End Pages Table ---*************************************************/

/****************************************--- Starting Contact Details ---*******************************************/

function getContact($id){
		  $query = "SELECT * FROM `contact` WHERE `id`='$id'";
		  $rec  = $this->fetchAll($query);
		  return $rec;
   }	
   
   /*
	 * Update page Details
	*/
	function updateContact($inputs){
		
		$insert	=	array(  'email'=>$this->addFilter($inputs['email']),
							'phone'=>$inputs['phone'],
							'mob'=>$inputs['mob'],
							'address'=>$inputs['address'],
							'map'=>$inputs['map'],
							'id'=>$inputs['id']
							);
							
		
		 $this->update($insert,"contact",'`id`='.$inputs['id']);
		return true;
	}
	

/*******************************************--- End Contact Table ---*************************************************/

/****************************************--- Starting Order Details ---*******************************************/
	
	function listOrders($values){
		
		$start		=	$values['start'];
		$limit		=	$values['limit'];
		$mode		=	trim($values['mode']);
		$ord		=	trim($values['ord']);
		$keyword	=	trim($values['keyword']);
		$parent		=	trim($values['parent']);
		
		$qry="";
		$order	=	'';
		
		if(!empty($keyword)){
			$qry.=' AND LOWER(c.`name`) LIKE \'%'.$this->addFilter($this->escapeHtml($keyword)).'%\'';
		}
	 if(trim($parent)!=''){
			$qry.=' AND c.`id`=\''.$parent.'\'';
		}
		if(!empty($mode) && !empty($ord)){
			if($mode=='title'){
				if($ord=='dsc'){
					$order=' ORDER BY c.`id` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`id` ASC';
				}
			}
			if($mode=='order'){
				if($ord=='dsc'){

					$order=' ORDER BY c.`id` DESC';
				}else if($ord='asc'){
					$order=' ORDER BY c.`id` ASC';
				}
			}
		}else{
			$order=" ORDER BY c.`id` ASC";
		}
		
		$query	=	"SELECT count(c.`id`) FROM `order` c WHERE c.`id`!=''";
		$query.=$qry;
		$rec	=	$this->fetchAll($query);
		 $this->totalRecords	=	$rec[0]['count(c.`id`)'];
		
	 $query	=	"SELECT c.*  FROM `order` c WHERE c.`id`!='' ORDER BY id DESC";

	 	$query.=$qry;
		
	
		$query.=' LIMIT '.$start.','.$limit;
		$rec	=	$this->fetchAll($query);
		$this->pageRecords	=	count($rec);
		
		return $rec;		
		
		
	}
	
																						
}
	?>
	
    
    
    
    