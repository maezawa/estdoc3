<form action="/result.php" method="get" id="searchFree">
	<label for="selectCategory">診療科目</label>
	<?php $templ->display($_->template_dir. '/form/specialities.php'); ?>
	×

	<label for="Aplacerea">エリア名・駅名</label>
	<input id="Aplacerea" class="inputArea" name="area" value="" type="text" placeholder="例：渋谷、新宿駅" autocomplete="off">
	<input type="hidden" name="Area" id="Aplacerea_" value="<?php echo (isset($_GET['Area'])) ? $_GET['Area'] : ''; ?>">
	×

	<label for="time">行きたい時間</label>
	<?php $templ->display($_->template_dir. '/form/select/hourzone.php'); ?>

	<input type="submit" class="button research" value="検　索">
</form>