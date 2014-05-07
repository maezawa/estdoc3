<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title></title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/reserve.css">
	<!--[if IE]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
	<script src="//maps.google.com/maps/api/js?sensor=false"></script>
	<script async src="/js/ga.js"></script>
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

<section class="container" id="OK">
	<ol class="steps">
		<li class="undone">診療内容入力</li>
		<li class="undone">確認</li>
		<li class="done">予約完了</li>
	</ol>

	<div class="rsv container">
		<h1>診療予約が完了しました</h1>
		<p>
		予約の手続きを完了しました。<br>
		<strong>万一、時間変更やキャンセルをされる場合は、直接医院にご連絡ください。</strong><br>
		このたびは、ご利用ありがとうございました。
		</p>
	</div>

</section>

<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script src="/js/$ui.js"></script>
<script src="/js/reserve.js"></script>
</body>
</html>