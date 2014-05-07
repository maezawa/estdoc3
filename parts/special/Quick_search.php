<form action="/result.php" method="get" id="searchQuick">
	<input type="hidden" name="feat[]" value="<?php echo $templ['id']; ?>">
	<label for="Speciality">診療科目</label>
	<?php include($_->parts_dir. '/form/specialities.php'); ?>
	×

	<label for="Area">エリア名・駅名</label>
	<input id="Area" name="area" value="" type="text" placeholder="例：渋谷、新宿駅" autocomplete="off">
	×

	<label for="Time">行きたい時間</label>
	<?php include($_->parts_dir. '/form/select/hourzone.php'); ?>

	<button type="button" class="button qresearch">検　索</button>
</form>