<?php
echo array_reduce($_->serviceMaster,
	function($k, $v){
		return "{$k}<a class=\"button service_index\" href=\"/result/{$v->Url}/\">{$v->Care}</a>\n";
	}
);
?>