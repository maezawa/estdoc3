<?php
$json = json_decode(file_get_contents($_->api. '/service_master'), true);
$code = array_reduce($json,
	function($k, $v){
		return "{$k}<option value=\"{$v['Id']}\">{$v['Care']}</option>\n";
	}
);
?>
<select id="selectCategory" class="input-medium" name="speciality_id">
	<option	value="0">診療科目</option>
	<?php echo $code; ?>
</select>
