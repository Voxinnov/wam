<?php

#[\AllowDynamicProperties]
class Crypt {

	public $keys = array();
		
	public function crypt_key($ckey){
		$this->keys = array();
		if (empty($ckey)) {
			return;
		}
		$c_key = base64_encode(sha1(md5($ckey)));
		$c_key = substr($c_key, 0, (int)round(ord($ckey[0]) / 5));
		
		$c2_key = base64_encode(md5(sha1($ckey)));
		$last = strlen($ckey) - 1;
		$c2_key = substr($c2_key, 1, (int)round(ord($ckey[$last]) / 7));
		
		$c3_key = base64_encode(sha1(md5($c_key) . md5($c2_key)));
		$mid = (int)round($last / 2);
		$c3_key = substr($c3_key, 1, (int)round(ord($ckey[$mid]) / 9));
		
		$c_key = $c_key . $c2_key . $c3_key;
		$c_key = base64_encode($c_key);
		
		for($i = 0; $i < strlen($c_key); $i++){
			$this->keys[] = $c_key[$i];
		}
	}
	
	public function encrypt($string){
		return base64_encode((string)$string);
	}
	
	public function decrypt($string){
		return base64_decode((string)$string);
	}
}

?>