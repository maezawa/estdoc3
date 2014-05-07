<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<script async src="/js/ga.js"></script>
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

<main>
	<h2>クイックサーチで<?php echo $templ['prefecture']; ?>の歯科を探す</h2>
	<div class="form container">
		<!-- parts --><?php include($_->parts_dir. '/form/Quick_search.php'); ?><!-- /parts -->
	</div>
	<br>

	<h2><?php echo $templ['prefecture']; ?>の市区町村でリニックを探す</h2>
	<nav class="copy container">
		<ul id="List" class="menu_list">
			<?php echo $templ['list']; ?>
		</ul>
	</nav>
</main>

<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
</body>
</html>