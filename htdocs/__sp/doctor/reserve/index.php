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
	<script src="//maps.google.com/maps/api/js?sensor=false"></script>
	<script async src="/js/ga.js"></script>
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

<main class="container" id="Step1">
	<ol class="steps">
		<li class="done">診療内容入力</li>
		<li class="undone">確認</li>
		<li class="undone">予約完了</li>
	</ol>

	<h2>予約希望日時</h2>
	<div class="txt_center rsv_dt">
		<?php echo $templ->formatedReserveDT; ?>
	</div>

	<form id="Reserve1" class="rsv container">
		<dl>
			<dt class="required">姓名（フリガナ）</dt>
			<dd>
				<input name="last_name_kana" type="text" id="last_name_kana" placeholder="セイ"><span class="error last">セイ</span><br>
				<input name="first_name_kana" type="text" id="first_name_kana" placeholder="メイ"><span class="error first">メイ</span>
			</dd>
		</dl>
		<dl>
			<dt>メールアドレス</dt>
			<dd><input name="email" type="text" id="form_email"><span class="error email">メールアドレス</span></dd>
		</dl>
		<dl>
			<dt class="required">電話番号</dt>
			<dd><input name="tel" type="text" id="form_tel"><span class="error tel">電話番号</span></dd>
		</dl>
		<dl class="dl_block">
			<dt class="required">当院の利用は初めて、または1カ月以上前ですか？</dt>
			<dd>
				<label for="yes" class="check_on"><input type="radio" name="isFirst" id="yes" value="1" checked><span>はい</span></label>
				<label for="no"><input type="radio" name="isFirst" id="no" value="0"><span>いいえ</span></label>
			</dd>
		</dl>
		<dl class="dl_block">
			<dt>ご希望の診療／症状をご記入ください</dt>
			<dd><textarea name="memo" id="memo"></textarea></dd>
		</dl>

		<fieldset class="agree">
			<input type="checkbox" name="agree" id="agree">
			私は、<a href="/terms.php">利用規約</a>および<a href="/privacy.php">プライバシーポリシー</a>の個人情報保護方針に同意し予約します。
		</fieldset>
		※直前キャンセル・無断キャンセルは医療機関側に迷惑がかかりますので、行わないように気をつけてください。

		<div class="btns txt_center">
			<button class="button back" id="toBack">もどる</button>
			<button class="button send" id="toStep2" type="button" disabled>予約内容を確認する</button>
		</div>

		<h2><?php echo $templ->hopitalName; ?></h2>
		<div id="map" data-lat="<?php echo $templ->Latitude; ?>" data-lng="<?php echo $templ->Longitude; ?>"></div>
		<dl class="address">
			<dt>所在地</dt>
			<dd><?php echo $templ->City. $templ->Town. $templ->Building; ?></dd>
			<?php
			$access= array_reduce($templ->access, function($k, $v){ return "{$k}$v"; });
			if ($access != ''):
			?>
				<dt>アクセス</dt>
				<dd><?php	echo $access; ?></dd>
			<?php endif; ?>
		</dl>
	</form>
</main>


<section class="container" id="Step2">
	<div id="loading"><div id="loaderImage"></div></div>
	<ol class="steps">
		<li class="undone">診療内容入力</li>
		<li class="done">確認</li>
		<li class="undone">予約完了</li>
	</ol>

	<div class="rsv container">
		<h1><?php echo $templ->hopitalName; ?>への診療内容確認</h1>
		<h2>以下の内容で承ります。</h2>

		<dl class="radios">
			<dt>予約希望日時</dt>
			<dd><b><?php echo $templ->formatedReserveDT; ?></b></dd>
			<dt>姓名（フリガナ）</dt>
			<dd class="confirm n"><b></b></dd>
			<dt>メールアドレス</dt>
			<dd class="confirm e"><b></b></dd>
			<dt>電話番号</dt>
			<dd class="confirm t"><b></b></dd>
			<dt class="comfirm">当院の利用は初めて、または1カ月以上前ですか？</dt>
			<dd class="confirm r"><b></b></dd>
			<dt class="comfirm">ご希望の診療／症状</dt>
			<dd class="confirm w"><b></b></dd>
		</dl>

		<div class="btns txt_center">
			<button class="button back" id="toStep1">もどって書き直す</button>
			<button class="button send" id="Submit" type="button">この内容で予約する</button>
		</div>
	</div>
</section>


<section class="container" id="NG">
	<ol class="steps">
		<li class="undone">診療内容入力</li>
		<li class="undone">確認</li>
		<li class="ng">予約できませんでした</li>
	</ol>

	<div class="rsv container">
		<h1><?php echo $templ->hopitalName; ?>への診療予約</h1>
		<p>
			申し訳ございません。<br>
			システムエラーなどの原因でご予約手続きは完了しませんでした。<br>
			原因としては、同時に同じ日時で予約が入ってしまったなどのことが考えられます。お手数ですが、再度検索いただき、別の日時でご予約いただくか、しばらく経ってからご予約のお手続きを行ってください。
		</p>
		<div id="ErrorMsg">
			<h3>エラー内容</h3>
			<span></span>
		</div>
	</div>

</section>

<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script src="/js/$ui.js"></script>
<script src="/js/reserve.js"></script>
</body>
</html>