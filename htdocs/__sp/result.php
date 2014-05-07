<!DOCTYPE html>
<html itemscope="itemscope" itemtype="http://schema.org/SearchResultsPage">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title itemprop="about"></title>
	<link rel="prev" href="">
	<link rel="next" href="">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/doctor.css">
	<link rel="stylesheet" href="/css/detailSearch.css">
	<link rel="stylesheet" href="/css/result.css">
	<script src="//maps.google.com/maps/api/js?sensor=true"></script>
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->
<main id="result">
	<section id="summary">
		<?php echo ($templ['h2']) ? "<h2>{$templ['h2']}</h2>" : ""; ?>
		<?php echo ($templ['condStr']) ? "<p>{$templ['condStr']}で検索しました。</p>" : null; ?>
		<strong><?php echo $templ['count']; ?></strong>件中、<?php echo $templ['currentPage']; ?>件を表示しています。

		<div id="Research">
			<button class="button green icon_reduce">絞り込み検索</button>
			<a href="/" class="button icon_re">検索し直す</a>
			<button class="button detailSearch">詳細検索</button>
		</div>
	</section>

	<!-- Filter Search -->
	<section id="Filter">
		<div class="title">
			<div>
				<button class="button small close mb10">閉じる</button>
			</div>
			<h2>絞り込み検索</h2>
		</div>

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="formDetailSearch">
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

			<button class="button navRsv" id="doDetailSearch">絞り込み検索</button>
		</form>

	</section>
	<!-- /Filter Search -->

	<!-- Detail Search -->
	<section id="Detail">
		<div class="title">
			<div>
				<button class="button small close mb10">閉じる</button>
			</div>
			<h2>詳細条件</h2>
		</div>
		<?php include($_->parts_dir. '/detailSearch.php'); ?>
	</section>
	<!-- /Detail Search -->

	<!-- Loop -->
	<?php echo $templ['resultList']; ?>
	<!-- /Loop -->

	<!-- Pagenation -->
	<?php if ($templ['pagination'] != ''): ?>
	<nav id="Pagenation" itemscope itemtype="http://schema.org/SiteNavigationElement/Pagination">
		<?php echo $templ['pagination']; ?>
	</nav>
	<?php endif; ?>
	<!-- /Pagenation -->
</main>

<?php if($templ['CondLat'] != '' && $templ['CondLng'] != ''): ?>
<section id="TMap">
	<div id="totalmap" data-lat="<?php echo $templ['CondLat']; ?>" data-lng="<?php echo $templ['CondLng']; ?>"></div>
</section>
<?php endif; ?>

<section id="EMap">
	<button class="button close">地図を閉じる</button>
	<div id="eachmap"></div>
</section>

<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script type="text/javascript">
	var markerData = <?php echo $templ['markerJson']; ?>;
</script>
<script src="/js/$ui.js"></script>
<script src="/js/result.js"></script>
<script src="/js/showTimeTable.js"></script>
</body>
</html>