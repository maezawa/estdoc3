<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/prefs.css">
	<link rel="stylesheet" href="/css/result.css">
	<link rel="stylesheet" href="/css/review.css">
	<script async src="/js/ga.js"></script>
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

<section class="container">
	<ul id="breadcrumb">
		<li><a href="/">トップ</a></li>
		<li>クチコミ投稿ページ</li>
	</ul>
	<br>

	<h2>医療機関名、地名、診療科目など思いつく内容を入力してください</h2>
	<div class="form container">
		<!-- parts --><?php include($_->parts_dir. '/form/Keyword_search.php'); ?><!-- /parts -->
	</div>
	<br>

	<div class="result">
		<section class="hospital">
				<div class="pic">
					<a href="/hospital"><img src="" width="150" height="150" alt="スマイルデンタルクリニックサンシャイン"></a><br>
				</div>

				<div class="profile">
					<div class="title_container">
						<div class="title">
							<a href="/hospital"><h3>スマイルデンタルクリニックサンシャイン</h3></a>
							<h4>山田太郎先生</h4>
							<small>(歯科、矯正歯科)</small>
						</div>
						<div class="vote">
							<a class="button vote smallfont" href="">評価・クチコミする</a>
						</div>
					</div>

					<hr>

					<dl class="evaluation">
						<dt>信頼できる</dt>
						<dd><strong>23</strong>人</dd>
						<dt>充実した設備</dt>
						<dd><strong>12</strong>人</dd>
						<dt>待ち時間なし</dt>
						<dd><strong>340</strong>人</dd>
					</dl>

					<br class="c_both">

					<ul>
						<li>先生の処置はいつでも丁寧で信頼できます（by ○○○さん）　　【口コミ：<strong>8</strong>件】</li>
					</ul>

					<dl class="feature">
						<dt>アクセス</dt>
						<dd>小田急線、井の頭線下北沢駅から北口より徒歩3分</dd>
						<dt>特徴</dt>
						<dd>キッズルームあり、駐車場あり</dd>
					</dl>

				</div>
			</section>
		<section class="hospital">
			<div class="pic">
				<a href="/hospital"><img src="" width="150" height="150" alt="スマイルデンタルクリニックサンシャイン"></a><br>
			</div>

			<div class="profile">
				<div class="title_container">
					<div class="title">
						<a href="/hospital"><h3>スマイルデンタルクリニックサンシャイン</h3></a>
						<h4>山田太郎先生</h4>
						<small>(歯科、矯正歯科)</small>
					</div>
					<div class="vote">
						<a class="button vote smallfont" href="">評価・クチコミする</a>
					</div>
				</div>

				<hr>

				<dl class="evaluation">
					<dt>信頼できる</dt>
					<dd><strong>23</strong>人</dd>
					<dt>充実した設備</dt>
					<dd><strong>12</strong>人</dd>
					<dt>待ち時間なし</dt>
					<dd><strong>340</strong>人</dd>
				</dl>

				<br class="c_both">

				<ul>
					<li>先生の処置はいつでも丁寧で信頼できます（by ○○○さん）　　【口コミ：<strong>8</strong>件】</li>
				</ul>

				<dl class="feature">
					<dt>アクセス</dt>
					<dd>小田急線、井の頭線下北沢駅から北口より徒歩3分</dd>
					<dt>特徴</dt>
					<dd>キッズルームあり、駐車場あり</dd>
				</dl>

			</div>
		</section>
	</div>



</section>
<!-- parts --><?php include($_->parts_dir. '/parts/footer.php'); ?><!-- /parts -->
<script src="/js/$ui.js"></script>
</body>
</html>