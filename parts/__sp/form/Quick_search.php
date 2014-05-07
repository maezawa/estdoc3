<form action="/result.php" method="get" id="searchQuick">
	<?php include($_->parts_dir. '/form/specialities.php'); ?>
	<span>×</span>
	<input id="Area"name="area" value="" type="text" placeholder="エリア名・駅名　例：渋谷、新宿駅" autocomplete="off">
	<span>×</span>
	<?php include($_->parts_dir. '/form/select/hourzone.php'); ?>
	<input type="submit" class="button research" value="検　索">
</form>