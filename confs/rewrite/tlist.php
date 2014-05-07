#!/usr/bin/php
<?php
$func = "tlist";
$api  = "/address/roma?";

	/*
	 *  format of '$fin' is '/pref(/city)(/town)'
	 */

	function tlist($api, $paths){
		$_api = 'http://api.estdoc.jp'. $api;
		$path = array_fill(0, 3, '');

		list($path[0], $path[1], $path[2]) = explode("/", preg_replace("/^\/|\/$/","", $paths));
		$level = array_reduce($path, function($v, $w){
			$v += ($w != '') ? 1 : 0;
			return $v;
		});

		// Get from Json
		$_api .= ($path[0]) ? "prefecture={$path[0]}" : '';
		$_api .= ($path[1]) ? "&city={$path[1]}" : '';
		$_api .= ($path[2]) ? "&town={$path[2]}" : '';
		$json = json_decode(file_get_contents($_api), true);

		$param = array(
			'id'		=> $json[0]['Id'],
			'level'	=> $level
		);
		$params = "id={$param['id']}&level={$param['level']}";

		return $params;
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