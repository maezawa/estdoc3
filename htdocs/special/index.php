<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title><?php echo $templ['title']; ?>の特集ページ【エストドック】</title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/prefs.css">
	<link rel="stylesheet" href="/css/features.css">
	<!--[if IE]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
	<script async src="/js/ga.js"></script>
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->
<section class="container">
	<ul id="breadcrumb">
		<li><a href="/">トップ</a></li>
		<li><?php echo $templ['title']; ?>の特集ページ</li>
	</ul>
	<br>
<!--	<div class="copy container">-->
<!--		<img src="" width="150" height="50" alt="">-->
<!--		<div>-->
<!--			<h1>全国の病院・クリニック夜間診療特集</h1>-->
<!--			夜間診療についての説明、○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○。<br>-->
<!--			夜間診療についての説明、○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○。<br>-->
<!--			夜間診療についての説明、○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○。<br>-->
<!--			夜間診療についての説明、○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○○。-->
<!---->
<!--		</div>-->
<!--	</div>-->
<!--	<br>-->

	<h2>クイックサーチで病院・歯医者を探す</h2>
	<div class="form container">
		<!-- parts --><?php include($_->parts_dir. '/special/Quick_search.php'); ?><!-- /parts -->
	</div>
	<br>

	<h2>診療科目から<?php echo $templ['title']; ?>クリニックを探す</h2>
	<nav class="copy container">
		<ul id="List">
			<!-- parts --><?php include($_->parts_dir. '/special/speciality.php'); ?>
		</ul>
	</nav>
	<br>

	<h2>エリア名から<?php echo $templ['title']; ?>クリニックを探す</h2>
	<nav class="copy container">
		<!-- parts --><?php include($_->parts_dir. '/special/prefs.php'); ?><!-- /parts -->
	</nav>
</section>
<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script src="/js/$ui.js"></script>
<script src="/js/special.js"></script>

</body>
</html>