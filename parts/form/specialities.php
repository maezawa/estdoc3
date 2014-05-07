<select id="selectCategory" name="speciality_id">
	<option value="" selected="">指定しない</option>
	<?php echo array_reduce($_->serviceMaster, function($k, $v){
		$selected = ($v->Id == @$_GET['speciality_id']) ? ' selected' : '';
		return "{$k}<option value=\"{$v->Id}\"{$selected}>{$v->Care}</option>\n";
	}); ?>
</select>
