<?php
$json = json_decode(file_get_contents($_->api. '/keywords'), true);
$code = array_reduce($json,
	function($k, $v){
		return "{$k}<label for=\"det{$v['Id']}\"><li><input type=\"checkbox\" name=\"feat[]\" Id=\"det{$v['Id']}\" value=\"{$v['Id']}\">{$v['Item']}</li></label>\n";
	}
);
?>
<?php echo $code; ?>