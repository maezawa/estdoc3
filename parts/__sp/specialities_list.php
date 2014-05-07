<?php
$json = json_decode(file_get_contents($_->api. '/service_master'), true);
$code = array_reduce($json,
	function($k, $v){
		$param = array(
			null,
			'&week%5B%5D=6&week%5B%5D=7&week%5B%5D=8',
			'&hourZone%5B%5D=5'
		);
		return "{$k}\n<a href=\"/result.php/?speciality_id={$v['Id']}{$param[$_GET['p']]}\"><li class=\"half_list\">{$v['Care']}</li></a>\n";
	}
);
?>
<ul class="menu_list">
	<?php echo $code; ?>
</ul>
