<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title></title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/hospital.css">
	<script async src="/js/ga.js"></script>
</head>
<body>
	<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

	<section class="container">
		<ul id="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<li><a href="/" itemprop="url"><span itemprop="title">トップ</span></a></li>
			<li><a href="../" itemprop="url"><span itemprop="title"><!--{{hospital.name}}-->スマイルデンタルクリニックサンシャインの詳細</span></a></li>
			<li><span itemprop="title">インタビュー</span></li>
		</ul>
		<br>

		<div class="drProf container">
			<div class="pic box">
				<ul class="thumb">
					<li><img src="" width="180" height="180" alt=""></li>
					<li><img src="" alt=""></li>
				</ul>
				<a href="" class="button vote">評価・クチコミを投稿</a>
				<a href="../" class="button interview">基本情報</a>
			</div>
			<div class="prof box">
				<h1>
					<!--{{hospital.name}}-->スマイルデンタルクリニックサンシャイン<br>
					<small>(診療科目：<!--{{hospital.specialities[]}}-->内科、皮膚科、産婦人科)</small>
				</h1>

				<p id="hospitalComment" data-num="160"><!--{{hospital.comment}}-->
					医療機関のコメントが入る場所。医療機関のコメントが入る場所。医療機関のコメントが入る場所。医療機関のコメントが入る場所。医療機関のコメントが入る場所。医療機関のコメントが入る場所。<br>
					医療機関のコメントが入る場所。医療機関のコメントが入る場所。医療機関のコメントが入る場所。医療機関のコメントが入る場所。医療機関のコメントが入る場所。医療機関のコメントが入る場所。医療機関のコメントが入る場所。
				</p>
				<button class="button small moreHospital">もっと見る</button>

				<dl class="evaluation">
					<dt>信頼できる</dt>
					<dd><strong>23</strong>人</dd><!--{{evalPoint.reliable}}-->
					<dt>充実した設備</dt>
					<dd><strong>12</strong>人</dd><!--{{evalPoint.facilities}}-->
					<dt>待ち時間なし</dt>
					<dd><strong>340</strong>人</dd><!--{{evalPoint.wait}}-->
				</dl>

				<ul id="feature"><!--{{hospital.features[]}}-->
					<li>夜間診療可</li>
					<li>夜間診療可</li>
					<li>キッズスペース有</li>
					<li>夜間診療可</li>
					<li>駐車場有</li>
					<li>人間ドック</li>
				</ul>
			</div>
			<div class="map box">
				<div id="map" data-lat="" data-lng="" data-title=""></div><!--{{hospital.lat}}{{hospital.lng}}-->
				<dl>
					<dt>住所</dt>
					<dd>東京都豊島区東池袋3-13-8 東池袋パークサイドビル4F</dd><!--{{hospital.pref}}{{hospital.addr1}}{{hospital.addr2}}{{hospital.addr3}}-->
					<dt>アクセス</dt>
					<dd>JR池袋駅西口より徒歩10分</dd><!--{{hospital.accesses[]}}-->
				</dl>
			</div>
		</div>

		<article class="mt10">
			<h2>インタビュー</h2>

			<div class="interview container">
				<img src="" width="120" height="160" alt="">

				<div>
					<h2>○○先生への一問一答</h2>
					<dl id="QandA"><!--{{hospital.interview[]}}-->
						<dt>氏名</dt>
						<dd>○○　太郎</dd>
						<dt>生年月日</dt>
						<dd>1964年12月21日</dd>
						<dt>出身地</dt>
						<dd>埼玉県さいたま市</dd>
						<dt>座右の銘</dt>
						<dd>明日は明日の風が吹く</dd>
						<dt>趣味</dt>
						<dd>写真撮影</dd>
						<dt>好きな本</dt>
						<dd>星の王子さま、不思議の国のアリス</dd>
						<dt>特技</dt>
						<dd>カラスの餌付け</dd>
					</dl>
				</div>
			</div>
		</article>
	</section>

<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script src="/js/$ui.js"></script>
<script src="/js/interview.js"></script>
</body>
</html>