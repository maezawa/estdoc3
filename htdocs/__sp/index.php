<?php $i = 0; ?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title itemprop="about"></title>
	<link rel="prev" href="">
	<link rel="next" href="">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/detailSearch.css">
	<link rel="stylesheet" href="/css/index.css">
</head>
<body>
	<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->
	<main id="Main">
		<form action="/result.php" method="get">
			<?php include($_->parts_dir. '/form/specialities.php'); ?>
			<span>×</span>
			<input type="text" id="Area" class="inputArea" name="area" placeholder="例：渋谷、新宿駅">
			<button class="button navRsv" id="Search">検索</button>
		</form>
		<a href="#Detail" class="block txt_right to_detail">詳細条件を設定して検索</a>

		<h2>全国の病院・歯医者を探す</h2>
		<ul class="menu_list main">
			<a href="#Cat"><li class="icon_cat"><strong>診療科目</strong>から探す</li></a>
			<a href="#Pref"><li class="icon_com"><strong>都道府県</strong>から探す</li></a>
			<a href="#Tlist"><li class="icon_tra"><strong>沿線・路線</strong>から探す</li></a>
			<a href="#Holiday"><li class="icon_hol"><strong>休日に行ける</strong>病院から探す</li></a>
			<a href="#Night"><li class="icon_nig"><strong>夜間に行ける</strong>病院から探す</li></a>
		</ul>

		<h2>エストドックとは？</h2>
	</main>

	<section id="Cat">
		<h2 class="top_border_none">診療科目を選択する</h2>
		<!-- parts--><?php $_GET['p'] = $i; include($_->parts_dir. '/specialities_list.php'); ?><!-- /parts -->
		<br>
		<div class="mt20 txt_center">
			<a href="#Main" class="button back">もどる</a>
		</div>
	</section>

	<section id="Pref">
		<h2 class="top_border_none">都道府県を選択する</h2>
		<!-- parts--><?php include($_->parts_dir. '/pref_list.php'); ?><!-- /parts -->
		<br>
		<div class="mt20 txt_center">
			<a href="#Main" class="button back">もどる</a>
		</div>
	</section>

	<section id="Tlist">
		<h2 class="top_border_none">路線を選択する</h2>
		<!-- parts--><?php include($_->parts_dir. '/rails_pref_list.php'); ?><!-- /parts -->
		<br>
		<div class="mt20 txt_center">
			<a href="#Main" class="button back">もどる</a>
		</div>
	</section>

	<section id="Holiday">
		<h2 class="top_border_none">診療科目を選択する</h2>
		<!-- parts--><?php $_GET['p'] = ++$i; include($_->parts_dir. '/specialities_list.php'); ?><!-- /parts -->
		<br>
		<div class="mt20 txt_center">
			<a href="#Main" class="button back">もどる</a>
		</div>
	</section>

	<section id="Night">
		<h2 class="top_border_none">診療科目を選択する</h2>
		<!-- parts--><?php $_GET['p'] = ++$i; include($_->parts_dir. '/specialities_list.php'); ?><!-- /parts -->
		<br>
		<div class="mt20 txt_center">
			<a href="#Main" class="button back">もどる</a>
		</div>
	</section>

	<!-- Detail Search -->
	<section id="Detail">
		<h2 class="top_border_none">詳細条件</h2>
		<?php include($_->parts_dir. '/detailSearch.php'); ?>
		<br>
		<div class="mt20 txt_center">
			<a href="#Main" class="button back">もどる</a>
		</div>
	</section>
	<!-- /Detail Search -->

	<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
	<script src="/js/index.js"></script>
</body>
</html>