<?php	 	
//error_reporting(E_ALL ^ E_DEPRECATED);
	class MySql
	{
		private $dbUser;
		private $dbPass;
		private $dbName;
		private $dbHost;
		private $dbConnection;
		private $errorString;
		private $filter;		
		private $util;
		public static $instance;
		public $query;
		public $newCon;
		public static $connection;
		
		function __construct()
		{
		
			$this->dbConnection	=	null;
			$this->filter		=	true;	
			$this->newCon		=	false;
		}
		
		function setNew()
		{
			$this->newCon	=	true;
		}
		function noFilter()
		{
			$this->filter	=	false;
		}
		/*
		 * Setting Error Message on Db Operation
		 * Input String Message
		 * Called upon db operation
		*/
		
		function setError($string)
		{
			$this->errorString	=	$string;
			//echo "mysqli ERROR - ".$this->errorString;
		}
		
		/*
		 * get Error Message after a db operation
		 * Retrieves the current error Status
		*/
		
		function getError()
		{
			return $this->errorString;
		}
		
		/*
		 * Connect to mysqli Database using set up data
		 * Set up data being hold on Constructor
		 * Modify the constrct params for connection change
		*/
		
		function connect()
		{
			if(is_null($this->dbConnection)){
				require_once(CONST_BASEDIR.'/config.php')	;				
				$this->dbUser		=	$config["databaseUser"];
				$this->dbPass		=	$config["databasePass"];
				$this->dbName		=	$config["databaseName"];
				$this->dbHost		=	$config["databaseHost"];
				//try
				//{
					
		/* 		$this->dbConnection = mysqli_connect($this->dbHost,$this->dbUser,$this->dbPass);
if (!$this->dbConnection) {
    die("Database connection failed");
}

// 2. Select a database to use 
$this->dbConnection = mysqli_select_db($this->dbConnection, $this->dbName);


if (!$this->dbConnection) {
    die("Database selection failed: " . mysqli_error($this->dbConnection));
}	 */
					
					if($this->newCon==true)
					{
						$this->dbConnection	=	mysqli_connect($this->dbHost,$this->dbUser,$this->dbPass,true);
					}
					else
					{
						 $this->dbConnection	=	mysqli_connect($this->dbHost,$this->dbUser,$this->dbPass);
					}
					if($this->dbConnection)
					{
						$connection = mysqli_select_db($this->dbConnection,$this->dbName);
						if($connection)
						{
						}
						else
						{
							$this->setError(mysqli_error($this->dbConnection));
						}
					}
					else
					{
						$this->setError(mysqli_error($this->dbConnection));
					}
					return $connection;
					//print_r($dbConnection);exit;
				//	$query="SELECT * FROM sky_sldr where sldr_stus=1";
				//	$result			=	mysqli_query($this->dbConnection,$query);
				//print_r($result);exit;
				/*}
				catch(Exception $c)
				{
					$this->setError($c);
				}*/
			}
		}
		
		function getInstance(){
			return $this->dbConnection;
		}
		
		
		/*  * Close the mysqli Connection		 
		 */
		
		function close()
		{
			if($this->dbConnection)
			{
				mysqli_close($this->dbConnection);
				$this->dbConnection	=	null;
			}
			else
			{
				$this->dbConnection	=	null;
			}
		}	
		
		/*
		 * get ALl results for an SQL Select Statement
		 * Retrieves the result set values in 2 dimensional array
		 * Parms : query String
		 * Returns Array
		*/
		
		function fetchAll($query)
		{

			//$this->connect();
			$this->query=$query;
			//print_r($query);exit;
			$x = new stdClass();
			$fileds		=	array();
			$y = new stdClass();
			$resultSet	=	array();
			$row = array();
			$start = new stdClass();
			
		//$conn=	mysqli_connect("localhost","wam_uk_db","qHEAoiiEgTiC","wam_uk_db");
			$conn=	mysqli_connect("localhost","wamuk_vox_org","[YImVNO}=b([","wamuk_vox_org");
			/*try
			{*/
					$result			=	mysqli_query($conn,$query);//print_r($result);exit;
				if($result)
				{
					$fieldsLength	=	mysqli_num_fields($result);
				//	print_r($fieldsLength);
						$i=0;
							//$fileds[$i]=	mysql_field_name($result,$i);
							while ($property = mysqli_fetch_field($result)) {
							$fileds[$i]= $property->name;
							$i++;
						}
					
				//	$fileds[$x] = new stdClass();
					//print_r($fileds);exit;
					if(mysqli_num_rows($result)>0)
					{
						$start	=	0;
						//$row=mysqli_fetch_row($result);
						 //print_r($row);exit;
						while($row=mysqli_fetch_row($result))
						{		//$i = new stdClass();	
					//$resultSet[][]='';
							for($j=0;$j<$fieldsLength;$j++ )
							{				
						//$y=$fileds[$j];	
						//print_r($y);exit;
                              // $resultSet[$start][$fileds[$j]]	=	$row[$j];
								//	$y=trim($y);
							  
								if($this->filter)
								{
									
									$resultSet[$start][$fileds[$j]]	=	$this->removeFilter($row[$j]);	
								
								}
								else
								{
								$resultSet[$start][$fileds[$j]]	=	$row[$j];					
								}
								
							}
							$start++;
						}
					}
					mysqli_free_result($result);
				}
				
			/*}
			catch(Exception $c)
			{
				$this->setError($c);
			}*/
			return $resultSet;
		}
		
		/*
		 * mysqli Insert operations
		 * Paramms $fild->value pair , table name
		*/
		
		function insert($options,$table)
		{
			$queryString	=	"";
			$p				=	count($options);
			$start			=	0;
			$fieldString	=	null;
			$valueString	=	null;
			foreach($options as $key=>$val)
			{
				$fieldString.=" `{$key}`";
				$valueString.=" '{$val}' ";
				if($start<$p-1)
				{
					$fieldString.=",";
					$valueString.=",";
				}
				$start++;
			}			
			$queryString	=	"INSERT INTO `{$table}` ({$fieldString}) VALUES ({$valueString}) ";
	//print_r($queryString); exit;
			echo "<br>";
			//echo "db".$queryString; 
			//exit;
			
			/*try
			{*/
				//$conn=	mysqli_connect("localhost","wam_uk_db","qHEAoiiEgTiC","wam_uk_db");	
				$conn=	mysqli_connect("localhost","wamuk_vox_org","[YImVNO}=b([","wamuk_vox_org");
				$result	=	mysqli_query($conn,$queryString) or $this->setError("Insert".mysqli_error($conn));
			/*}
			catch(Exception $c)
			{
				$this->setError($c);
			}*/
		}
		
		
		function insertMulti($fields,$values,$table)
		{

			$queryString	=	"";
			$p				=	count($fields);
			$start			=	0;
			foreach($fields as $key=>$val){
				$fieldString.=" `{$val}`";				
				if($start<$p-1){
					$fieldString.=",";					
				}
				$start++;
			}
			
			
			
			for($i=0;$i<count($values);$i++){
				$p	=	count($values[$i]);
				$start			=	0;
				$valueString.="(";
				foreach($values[$i] as $key=>$val){
					$valueString.="'{$val}'";				
					if($start<$p-1){
						$valueString.=",";					
					}
					$start++;
				}
				$valueString.=")";
				if($i<count($values)-1){
					$valueString.=",";
				}
			}
			unset($fields);
			unset($values);
			$queryString	=	"INSERT INTO `{$table}` ({$fieldString}) VALUES {$valueString} ";
		//echo $queryString;
			/*try
			{*/
				//$conn=	mysqli_connect("localhost","wam_uk_db","qHEAoiiEgTiC","wam_uk_db");
				$conn=	mysqli_connect("localhost","wamuk_vox_org","[YImVNO}=b([","wamuk_vox_org");
				$result	=	mysqli_query($conn,$queryString);
			/*}
			catch(Exception $c)
			{
				$this->setError($c);
			}*/
		}
		
		
		/*
		 * mysqli Update
		 * Params - field->value pair,table name,update condition
		*/
		
		function update($options,$table,$condition)
		{
			$queryString	=	"";
			$fieldString	=	"";			
			$p				=	count($options);
			$start			=	0;
			foreach($options as $key=>$val){
				$fieldString.=" `{$key}`='{$val}'";
				if($start<$p-1){
					$fieldString.=",";
				}
				$start++;
			}			
			$queryString	=	"UPDATE `{$table}` SET {$fieldString} ";
	
		
			if(!empty($condition)){
		  $queryString.=" WHERE {$condition} ";
		  		//print_r($queryString);exit;
		
	
			}
			$this->query	=	$queryString;
						
			/*try
			{*/
				$conn=	mysqli_connect("localhost","wamuk_vox_org","[YImVNO}=b([","wamuk_vox_org");
				$result	=	mysqli_query($conn,$queryString) or $this->setError(mysqli_error($conn));
			/*}
			catch(Exception $c)
			{
				$this->setError($c);
			}*/
			 $this->query." <br/>";
	
			
		}
		
		/*
		 * mysqli Delete Operation
		 * Params - table name , condition
		*/
		
		function delete($table,$condition)
		{
			$queryString	=	"DELETE FROM `{$table}` ";
			if(!empty($condition))
			{
				$queryString.=" WHERE {$condition} ";
				
			}
			/*try
			{*/
				//$conn=	mysqli_connect("localhost","wam_uk_db","qHEAoiiEgTiC","wam_uk_db");
				$conn=	mysqli_connect("localhost","wamuk_vox_org","[YImVNO}=b([","wamuk_vox_org");
				$result	=	mysqli_query($conn,$queryString) or $this->setError(mysqli_error($conn));
			/*}
			catch(Exception $c)
			{
				$this->setError($c);
			}*/
		}
		
		function execute($query){
				//$conn=	mysqli_connect("localhost","wam_uk_db","qHEAoiiEgTiC","wam_uk_db");
				$conn=	mysqli_connect("localhost","wamuk_vox_org","[YImVNO}=b([","wamuk_vox_org");
			$result	=	mysqli_query($conn,$query) or $this->setError(mysqli_error($conn));
		}
		/*
		 * Returns last insert ID		 
		*/
		
		function lastInsertId()
		{
			return mysqli_insert_id();
		}
		
		function affectedRows($instance){
			return mysqli_affected_rows($instance);
		}
		
		/*
		 * Filter with Slash on special chars
		*/
		
		function addFilter($string){
			return addslashes($string);	
			//return $string;			
		}
		
		/*
		 * Remove added special chars on STring 
		*/
		
		function removeFilter($string){			
				return stripslashes($string);			
		}	
		
		
		function escapeHtml($text){
			return strip_tags($text);
		}
		
		
	}


?>