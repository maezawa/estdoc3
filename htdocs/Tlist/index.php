<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title></title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
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
		<?php echo $templ['li_lv2']; ?>
	</ul>
	<br>

	<h2>クイックサーチで<?php echo $templ['prefecture']; ?>の病院・歯科を探す</h2>
	<div class="form container">
		<!-- parts --><?php include($_->parts_dir. '/form/Quick_search.php'); ?><!-- /parts -->
	</div>
	<br>

	<h2><?php echo $templ['prefecture']; ?>の市区町村で病院・クリニックを探す</h2>
	<nav class="copy container">
		<ul id="List">
			<?php echo $templ['list']; ?>
		</ul>
	</nav>

</section>
<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script src="/js/special.js"></script>
</body>
</html>