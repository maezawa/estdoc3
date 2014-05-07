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
<!-- parts --><?php include($_->parts_dir. '/parts/header.php'); ?><!-- /parts -->

<section class="container" id="Step1">
	<ul id="breadcrumb">
		<li><a href="/">トップ</a></li>
		<li>クチコミ投稿ページ</li>
	</ul>
	<br>

	<ol class="steps">
		<li class="done">入力</li>
		<li class="undone">確認</li>
		<li class="undone">完了</li>
	</ol>

	<form class="eval container">
		<h1>エスト内科クリニックの評価・クチコミを書く</h1>
		※「賛成」以上の評価を賛成票として加算いたします。<br>

		<dl class="radios">
			<dt>医師は信頼できる</dt>
			<dd>
				<input type="radio" id="r5" name="reliable" value="5" class="button">
				<label for="r5">大賛成</label>
				<input type="radio" id="r4" name="reliable" value="4" class="button">
				<label for="r4">賛成</label>
				<input type="radio" id="r3" name="reliable" value="3" class="button">
				<label for="r3">普通</label>
				<input type="radio" id="r2" name="reliable" value="2" class="button">
				<label for="r2">不満</label>
				<input type="radio" id="r1" name="reliable" value="1" class="button">
				<label for="r1">大いに不満</label>
			</dd>
			<dt>待ち時間は短かった</dt>
			<dd>
				<input type="radio" id="w5" name="wait" value="5" class="button">
				<label for="w5">大賛成</label>
				<input type="radio" id="w4" name="wait" value="4" class="button">
				<label for="w4">賛成</label>
				<input type="radio" id="w3" name="wait" value="3" class="button">
				<label for="w3">普通</label>
				<input type="radio" id="w2" name="wait" value="2" class="button">
				<label for="w2">不満</label>
				<input type="radio" id="w1" name="wait" value="1" class="button">
				<label for="w1">大いに不満</label>
			</dd>
			<dt>設備は充実していた</dt>
			<dd>
				<input type="radio" id="e5" name="equipment" value="5" class="button">
				<label for="e5">大賛成</label>
				<input type="radio" id="e4" name="equipment" value="4" class="button">
				<label for="e4">賛成</label>
				<input type="radio" id="e3" name="equipment" value="3" class="button">
				<label for="e3">普通</label>
				<input type="radio" id="e2" name="equipment" value="2" class="button">
				<label for="e2">不満</label>
				<input type="radio" id="e1" name="equipment" value="1" class="button">
				<label for="e1">大いに不満</label>
			</dd>
		</dl>
		<br>

		<h2>クチコミのコメント投稿</h2>
		<small>※誹謗中傷などの名誉毀損に該当しないかの検証後に全て表示されます。</small><br>
		<textarea name="comment" id="Comment"></textarea>
		<br>
		<button class="button send" id="toStep2">投稿内容を確認する</button>
	</form>
</section>



<section class="container" id="Step2">
	<ul id="breadcrumb">
		<li><a href="/">トップ</a></li>
		<li><a href="#Step1">クチコミ投稿ページ</a></li>
		<li>クチコミ投稿内容確認</li>
	</ul>
	<br>

	<ol class="steps">
		<li class="undone">入力</li>
		<li class="done">確認</li>
		<li class="undone">完了</li>
	</ol>

	<div class="eval container">
		<h1>エスト内科クリニックの評価・クチコミ 投稿内容確認</h1>
		以下の内容で承ります。

		<div class="flex">
			<dl class="radios">
				<dt>医師は信頼できる</dt>
				<dd class="confirm r"><span></span></dd>
				<dt>待ち時間は短かった</dt>
				<dd class="confirm w"><span></span></dd>
				<dt>設備は充実していた</dt>
				<dd class="confirm e"><span></span></dd>
			</dl>

			<div class="comment">
				<h2>コメント内容</h2>
				<div class="confirm_comment">e</div>
			</div>
		</div>



		<div class="txt_center">
			<button class="button back" id="toStep1">もどる</button>
			<button class="button send" id="toStep3">投稿内容を送信する</button>
		</div>
	</div>
</section>



<section class="container" id="Step3">
	<ul id="breadcrumb">
		<li><a href="/">トップ</a></li>
		<li><a href="#Step1">クチコミ投稿ページ</a></li>
		<li>クチコミ投稿内容確認</li>
		<li>クチコミ投稿完了</li>
	</ul>
	<br>

	<ol class="steps">
		<li class="undone">入力</li>
		<li class="undone">確認</li>
		<li class="done">完了</li>
	</ol>

	<div class="eval container">
		<h1>エスト内科クリニックの評価・クチコミ 投稿完了</h1>
	</div>

</section>
<!-- parts --><?php include($_->parts_dir. '/parts/footer.php'); ?><!-- /parts -->
<script src="/js/review.js"></script>
</body>
</html>