<?php	 	

class Uploader
{
    private string $destinationPath;
    private string $errorMessage = '';
    private array $extensions = [];
    private bool $allowAll = false;
    private int|float $maxSize = 0;
    private string $uploadName = '';
    private string $sequence = '';
    private string $imageSeq = '';
    private string $random = '';
    private bool $sameFileName = false;
    private bool $sameName = false;
    
    function __construct($path)
    {
        $this->destinationPath  =   $path;
        $this->allowAll =   false;
    }
        
        function allowAllFormats()
        {
            $this->allowAll =   true;
        }
        
        function setMaxSize($sizeMB)
        {
            $this->maxSize  =   $sizeMB * (1024*1024);
        }
        
        function setExtensions($options)
        {
            $this->extensions   =   $options;
        }
        
		function setSameFileName()
        {
			$this->sameFileName	=	true;
			$this->sameName	=	true;
		}
        function getExtension($string)
        {
            $ext	=	"";
            try
            {
                    $parts	=	explode(".",$string);
                    $ext	=	strtolower($parts[count($parts)-1]);
            }
            catch(Exception $c)
            {
                    $ext	=	"";
            }
            return $ext;
	    }
        
        function setMessage($message)
        {
            $this->errorMessage =   $message;
        }
        
        function getMessage()
        {
            return $this->errorMessage;
        }
        
        function getUploadName()
        {
            return $this->uploadName;
        }
		function getRandom()
        {
            return $this->random;
        }
        function setSequence($seq)
        {
			$this->imageSeq	=	$seq;
	   }
    	function sameName($true)
        {
    		$this->sameName	=	$true;
    	}
        function uploadFile($fileBrowse)
        {
			
            $result =   false;
            $size   =   $_FILES[$fileBrowse]["size"];
            $name   =   $_FILES[$fileBrowse]["name"];
            $ext    =   $this->getExtension($name); 
		  
            if(!is_dir($this->destinationPath))
            {
                $this->setMessage("Destination folder is not a directory ");
            }
            else if(!is_writable($this->destinationPath))
            {
                $this->setMessage("Destination is not writable !");
            }
            else if(empty($name))
            {
                $this->setMessage("File not selected ");
            }
            else if($size>$this->maxSize)
            {
                $this->setMessage("Too large file !");
            }
            else if($this->allowAll || (!$this->allowAll && in_array($ext,$this->extensions)))
            {
		        if($this->sameName==false)
                {
                    if($this->imageSeq!='')
                    {
                        $this->uploadName   =  $this->imageSeq."-".rand(1111,9999).".".$ext;
                    }
                    else
                    {
                        $this->uploadName   =  substr(md5((string)rand(1111,9999)),0,8).$this->getRandom().rand(1111,1000).".".$ext;
                    }
                }
                else
                {
                    $this->uploadName = $name;
                }
                
                if(move_uploaded_file($_FILES[$fileBrowse]["tmp_name"],$this->destinationPath.$this->uploadName))
                {
    				$result =   true;
                }
                else
                {
                    $this->setMessage("Upload failed , try later !");
                }
            }
            else
            {
                $this->setMessage("Invalid file format !");
            }
            return $result;
        }
        
        function deleteUploaded()
        {
            unlink($this->destinationPath.$this->uploadName);
        }
        
    }

?>