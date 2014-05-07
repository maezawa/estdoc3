<form action="/result.php" method="get" id="searchQuick">
	<label for="Speciality">診療科目</label>
	<?php include($_->parts_dir. '/form/specialities.php'); ?>
	×

	<label for="QArea">エリア名・駅名</label>
	<input id="QArea" name="area" value="" type="text" placeholder="例：渋谷、新宿駅" autocomplete="off">
	<input type="hidden" name="Area" id="QArea_" value="<?php echo (isset($_GET['Area'])) ? $_GET['Area'] : ''; ?>">
	×

	<label for="Time">行きたい時間</label>
	<?php include($_->parts_dir. '/form/select/hourzone.php'); ?>

	<button type="button" class="button qresearch">検　索</button>
</form>