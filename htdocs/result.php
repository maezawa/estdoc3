<!DOCTYPE html>
<html itemscope="itemscope" itemtype="http://schema.org/SearchResultsPage">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="<?php echo $templ['h2']; ?>「忙しいアナタ」のための診療予約サイト「エストドック」。病院、歯医者を24時間検索・予約！夜間診療、土曜・日曜診療も「時間を指定して」探すことが出来ます。">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title itemprop="about"><?php echo $templ['title']; ?></title>
	<?php echo $templ['prevPage']; ?>
	<?php echo $templ['nextPage']; ?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/subNavi.css">
	<link rel="stylesheet" href="/css/result.css">
	<!--[if IE]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
	<script src="//maps.google.com/maps/api/js?sensor=false"></script>
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

<section class="container">
	<ul id="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<li><a href="/" itemprop="url"><span itemprop="title">トップ</span></a></li>
		<?php echo $templ['breadcrumb']; ?>
	</ul>
	<br>

	<div class="container result">
		<nav class="sub box">
			<div id="sideArea" itemscope itemtype="http://schema.org/SiteNavigationElement">
				<?php if ($templ['requestURI'] != 'general'): ?>
				<h4><?php echo $templ['changeAreaTitle']; ?></h4>
				<ul id="selectArea">
					<?php include($_->parts_dir. "/subnavi/lv1_{$templ['requestURI']}.php"); ?>
					<?php include($_->parts_dir. "/subnavi/lv2_{$templ['requestURI']}.php"); ?>
					<?php include($_->parts_dir. "/subnavi/lv3_{$templ['requestURI']}.php"); ?>
				</ul>
				<?php endif; ?>

				<h4 <?php echo ($templ['requestURI'] != 'general') ? 'class="mt20"' : null; ?>>詳細条件</h4>
				<form action="<?php echo ($templ['requestURI'] != 'general') ? $_SERVER['REQUEST_URI'] : $_SERVER['SCRIPT_NAME']; ?>" id="formDetailSearch">
					<!-- 診療科目　プルダウン -->
					<h5>診療科目</h5>
					<?php include($_->parts_dir. '/form/specialities.php'); ?>
					<!-- /診療科目　プルダウン -->

					<!-- エリア名・駅名　テキスト -->
					<h5>エリア名・駅名</h5>
					<input type="hidden" name="Area" id="Area_" value="<?php echo @$_GET['Area']; ?>">
					<input type="text" id="Area" class="inputArea" name="area" value="<?php echo @$_GET['area']; ?>">

					<!-- 最寄り駅からの徒歩 -->
					<h5>最寄り駅からの徒歩</h5>
					<select id="Walk" name="walk">
						<option value="" selected>指定しない</option>
						<option value="1"<?php echo (@$_GET['walk'] != '') ? 'selected' : ''; ?>>徒歩5分以内</option>
					</select>
					<!-- /最寄り駅からの徒歩 -->

					<!-- エリア名・駅名　テキスト -->

					<!-- 曜日指定　チェックボックス＆リンク -->
					<h5>曜日指定　<small>（複数選択可能）</small></h5>
					<ul id="selectWeek">
						<label for="ws1"><li <?php echo (isset($_GET['week']) && in_array(1, $_GET['week'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="week[]" id="ws1" value="1" <?php echo (isset($_GET['week']) && in_array(1, $_GET['week'])) ? 'checked' : ''; ?>>月曜日</li></label>
						<label for="ws2"><li <?php echo (isset($_GET['week']) && in_array(2, $_GET['week'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="week[]" id="ws2" value="2" <?php echo (isset($_GET['week']) && in_array(2, $_GET['week'])) ? 'checked' : ''; ?>>火曜日<br></li></label>
						<label for="ws3"><li <?php echo (isset($_GET['week']) && in_array(3, $_GET['week'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="week[]" id="ws3" value="3" <?php echo (isset($_GET['week']) && in_array(3, $_GET['week'])) ? 'checked' : ''; ?>>水曜日</li></label>
						<label for="ws4"><li <?php echo (isset($_GET['week']) && in_array(4, $_GET['week'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="week[]" id="ws4" value="4" <?php echo (isset($_GET['week']) && in_array(4, $_GET['week'])) ? 'checked' : ''; ?>>木曜日<br></li></label>
						<label for="ws5"><li <?php echo (isset($_GET['week']) && in_array(5, $_GET['week'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="week[]" id="ws5" value="5" <?php echo (isset($_GET['week']) && in_array(5, $_GET['week'])) ? 'checked' : ''; ?>>金曜日</li></label>
						<label for="ws6"><li <?php echo (isset($_GET['week']) && in_array(6, $_GET['week'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="week[]" id="ws6" value="6" <?php echo (isset($_GET['week']) && in_array(6, $_GET['week'])) ? 'checked' : ''; ?>>土曜日<br></li></label>
						<label for="ws7"><li <?php echo (isset($_GET['week']) && in_array(7, $_GET['week'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="week[]" id="ws7" value="7" <?php echo (isset($_GET['week']) && in_array(7, $_GET['week'])) ? 'checked' : ''; ?>>日曜日</li></label>
						<label for="ws8"><li <?php echo (isset($_GET['week']) && in_array(8, $_GET['week'])) ? 'class="on"' : ''; ?>><input type="checkbox" name="week[]" id="ws8" value="8" <?php echo (isset($_GET['week']) && in_array(8, $_GET['week'])) ? 'checked' : ''; ?>>祝日<br></li></label>
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

					<button class="button detailSearch mt10" id="doDetailSearch">詳細条件で検索</button>
				</form>
			</div>
		</nav>

		<div class="main box">
			<section id="summary">
				<h2><?php echo $templ['h2']; ?></h2>
				<p><?php echo ($templ['condStr']) ? "{$templ['condStr']}で検索しました。" : null; ?>
					<button class="button small to_detail">詳細条件設定</button>
				</p>
				<strong><?php echo $templ['count']; ?></strong>件中、<?php echo $templ['currentPage']; ?>件を表示しています。
			</section>

			<?php if($templ['CondLat'] != '' && $templ['CondLng'] != ''): ?>
				<div id="map" data-lat="<?php echo $templ['CondLat']; ?>" data-lng="<?php echo $templ['CondLng']; ?>"></div>
			<?php endif; ?>

			<div id="result">

				<!--<nav id="tabArea">
					<ul class="tab">
						<li class="tabOn">Web・電話予約OK</li>
						<a href="#all"><li>全ての医療機関</li></a>
					</ul>
					<div class="flex"></div>
					<div class="btnArea">
						<a class="button small" href="">詳細条件設定</a>
					</div>
				</nav>-->

				<div id="content">
					<?php if($templ['hasEE']): ?>
						<nav id="sort">
							<h5>空き枠で絞り込み</h5>
							<ul>
								<a class="filter" data-date="0"><li>本日</li></a>
								<a class="filter" data-date="1"><li>明日</li></a>
								<a class="filter" data-date="2"><li>明後日</li></a>
								<a class="filter" data-date="7"><li>7日後</li></a>
								<!--							<a><li class="cal" id="date">その他の日付</li></a>-->
							</ul>
						</nav>
					<?php endif; ?>

					<!-- Loop -->
					<?php echo $templ['resultList']; ?>
					<!-- /Loop -->


					<!-- Pagenation -->
					<?php if ($templ['pagination'] != ''): ?>
						<nav id="Pagenation" itemscope itemtype="http://schema.org/SiteNavigationElement/Pagination">
							<ul>
								<?php echo $templ['pagination']; ?>
							</ul>
						</nav>
					<?php endif; ?>
					<!-- /Pagenation -->
				</div>

			</div>
		</div>
	</div>
</section>

<section id="Detail">
	<?php include($_->parts_dir. '/detailSearch.php'); ?>
</section>

<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script type="text/javascript">
	var markerData = <?php echo $templ['markerJson']; ?>;
</script>
<script src="/js/$ui.js"></script>
<script src="/js/result.js"></script>
</body>
</html>