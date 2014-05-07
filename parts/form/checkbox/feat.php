<?php
$json = array_filter($_->featMaster, function($v){ return preg_match('/^E/', $v->id); });
$code = array_reduce($json,
	function($k, $v){
		$selected = (isset($_GET['feat']) && in_array($v->id, $_GET['feat'])) ? ' checked' : '';
		$on = (isset($_GET['feat']) && in_array($v->id, $_GET['feat'])) ? ' class="on"' : '';
		return "{$k}<label for=\"det{$v->id}\"><li{$on}><input type=\"checkbox\" name=\"feat[]\" Id=\"det{$v->id}\" value=\"{$v->id}\"{$selected}>{$v->title}</li></label>\n";
	}
);
echo $code;
?>