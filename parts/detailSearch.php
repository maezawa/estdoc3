<div class="win">
	<form action="/result.php" id="formDetailSearch">
		<h1>詳細検索</h1>
		<button class="button small close">閉じる</button>

	<!-- 診療科目　プルダウン -->
	<h5>診療科目</h5>
	<?php include($_->parts_dir. '/form/specialities.php'); ?>
	<!-- /診療科目　プルダウン -->

	<!-- エリア名・駅名　テキスト -->
	<h5>エリア名・駅名</h5>
	<input type="text" id="Area" class="inputArea" name="area">
	<input type="hidden" name="Area" id="Area_" value="<?php echo @$_GET['Area']; ?>">

	<!-- 最寄り駅からの徒歩 -->
	<h5>最寄り駅からの徒歩</h5>
	<select id="Walk" name="walk">
		<option value="" selected>指定しない</option>
		<option value="1">徒歩5分以内</option>
	</select>
	<!-- /最寄り駅からの徒歩 -->

	<!-- エリア名・駅名　テキスト -->

	<!-- 曜日指定　チェックボックス＆リンク -->
	<h5>曜日指定　<small>（複数選択可能）</small></h5>
	<ul id="selectWeek">
		<label for="ws1"><li><input type="checkbox" name="week[]" id="ws1" value="1">月曜日</li></label>
		<label for="ws2"><li><input type="checkbox" name="week[]" id="ws2" value="2">火曜日<br></li></label>
		<label for="ws3"><li><input type="checkbox" name="week[]" id="ws3" value="3">水曜日</li></label>
		<label for="ws4"><li><input type="checkbox" name="week[]" id="ws4" value="4">木曜日<br></li></label>
		<label for="ws5"><li><input type="checkbox" name="week[]" id="ws5" value="5">金曜日</li></label>
		<label for="ws6"><li><input type="checkbox" name="week[]" id="ws6" value="6">土曜日<br></li></label>
		<label for="ws7"><li><input type="checkbox" name="week[]" id="ws7" value="7">日曜日</li></label>
		<label for="ws8"><li><input type="checkbox" name="week[]" id="ws8" value="8">祝日<br></li></label>
	</ul>
	<!-- /曜日指定　チェックボックス＆リンク -->

	<!-- 時間指定　チェックボックス＆リンク -->
	<h5>時間指定　<small>（複数選択可能）</small></h5>
	<?php include($_->parts_dir. '/form/checkbox/hourzone.php'); ?>
	<!-- /時間指定　チェックボックス＆リンク -->

	<br>

	<!-- こだわり条件 -->
	<h5>こだわり条件</h5>
	<ul id="selectDetail">
		<?php include($_->parts_dir. '/form/checkbox/feat.php'); ?>
	</ul>
	<!-- /こだわり条件 -->

	<button type="button" class="button detailSearch mt10" id="doDetailSearch">詳細条件で検索</button>
	</form></div>