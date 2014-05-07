#!/usr/bin/php
<?php
$func = "rlist";
$api  = "/line?";

	/*
	 *  format of '$fin' is '/pref(/city)(/town)'
	 */

	function rlist($api, $path){
		$path = explode("/", preg_replace("/^\/|\/$/","", $path));

		$_api  = 'http://api.estdoc.jp'. $api;
		$_api .= "nameroma={$path[0]}";
		$json = json_decode(file_get_contents($_api), true);

		return $json[0]['LineId'];
	}

	// Main processing
	//	 $read = 'hyougoken';
	//	 $params = $func($api, $read);
	//	 echo $params; exit;
	$fin = fopen("php://stdin", "r");
	while(!feof($fin)){
		$read = fgets($fin);
		$params = $func($api, trim($read));
		$fout = fopen("php://stdout", "w");
		fwrite($fout, $params. "\n");
		fclose($fout);
	}
	fclose($fin);
?>