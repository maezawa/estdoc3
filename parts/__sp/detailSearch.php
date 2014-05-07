	<form action="/result.php" id="formDetailSearch">
		<!-- 診療科目　プルダウン -->
		<h3>診療科目</h3>
		<?php include($_->parts_dir. '/form/specialities.php'); ?>

		<!-- エリア名・駅名　テキスト -->
		<h3>エリア名・駅名</h3>
		<div class="area_form">
			<input type="text" id="Area" class="inputArea" name="area">
			<a class="reset" title="リセット">&#xf057;</a>
		</div>

		<!-- 曜日指定　チェックボックス＆リンク -->
		<h3>曜日指定　<small>（複数選択可能）</small></h3>
		<ul id="selectWeek">
			<label for="ws1"><li><input type="checkbox" name="week[]" id="ws1" value="1"><span>月曜日</span></li></label>
			<label for="ws2"><li><input type="checkbox" name="week[]" id="ws2" value="2"><span>火曜日</span></li></label>
			<label for="ws3"><li><input type="checkbox" name="week[]" id="ws3" value="3"><span>水曜日</span></li></label>
			<label for="ws4"><li><input type="checkbox" name="week[]" id="ws4" value="4"><span>木曜日</span></li></label>
			<label for="ws5"><li><input type="checkbox" name="week[]" id="ws5" value="5"><span>金曜日</span></li></label>
			<label for="ws6"><li><input type="checkbox" name="week[]" id="ws6" value="6"><span>土曜日</span></li></label>
			<label for="ws7"><li><input type="checkbox" name="week[]" id="ws7" value="7"><span>日曜日</span></li></label>
			<label for="ws8"><li><input type="checkbox" name="week[]" id="ws8" value="8"><span>祝日</span></li></label>
		</ul>
		<!-- /曜日指定　チェックボックス＆リンク -->

		<!-- 時間指定　チェックボックス＆リンク -->
		<h3>時間指定　<small>（複数選択可能）</small></h3>
		<?php include($_->parts_dir. '/form/checkbox/hourzone.php'); ?>
		<!-- /時間指定　チェックボックス＆リンク -->

		<!-- こだわり条件 -->
		<h3>こだわり条件</h3>
		<ul id="selectDetail">
			<?php include($_->parts_dir. '/form/checkbox/feat.php'); ?>
		</ul>
		<!-- /こだわり条件 -->

		<button class="button navRsv" id="doDetailSearch">詳細検索</button>
	</form>
