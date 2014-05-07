<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title></title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/feedback.css">
	<!--[if IE]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

<section class="container" id="Input">
	<ul id="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<li><a href="/" itemprop="url"><span itemprop="title">トップ</span></a></li>
		<li><span itemprop="title">お問い合わせ</span></li>
	</ul>
	<br>

	<div class="container block">
		<h1>お問い合わせ</h1>

		<form method="post" accept-charset="utf-8" id="Feedback">
			<label for="name" class="control-label">ご氏名</label>
			<input type="text" id="name" name="name">
			<br>

			<label for="email" class="control-label">メールアドレス</label>
			<input type="email" id="email" name="email">
			<br>

			<label for="subject" class="control-label">タイトル</label>
			<input type="text" id="subject" name="subject">
			<br>

			<label for="contents" class="control-label">内容</label>
			<textarea cols="40" rows="5" name="contents" id="contents"></textarea>

			<div class="caution">
				<h2 class="txt_center">個人情報の取り扱いについて</h2>
				<dl>
					<dt>事業者の氏名または名称</dt>
					<dd>株式会社EST corporation</dd>

					<dt>個人情報保護管理者</dt>
					<dd>前澤　光弘</dd>

					<dt>個人情報の利用目的</dt>
					<dd>取得した個人情報は、問合せ対応のために利用いたします。</dd>

					<dt>個人情報の第三者提供について</dt>
					<dd>本人の同意がある場合または法令に基づく場合を除き、取得した個人情報を第三者に提供することはありません。</dd>

					<dt>個人情報の取扱いの委託について</dt>
					<dd>取得した個人情報の全部または一部を委託する場合があります。その場合には、個人情報の管理水準が、当協会が設定する基準を満たす企業を選定し、適切な管理、監督を行います。</dd>

					<dt>開示対象個人情報の開示等および問合せ窓口について</dt>
					<dd>本人からの求めにより、当協会が本件により取得した開示対象個人情報の利用目的の通知・開示・内容の訂正・追加または削除・利用の停止・消去（「開示等」といいます。）に応じます。<br>
						　開示等に応じる窓口は、当該の問合せフォームになります。</dd>

					<dt>個人情報を入力するにあたっての注意事項</dt>
					<dd>ご氏名およびメールアドレスの入力は任意となっております。入力されなかった場合、メールを差し上げることができず、お問合せに対応できないことがあります。</dd>

					<dt>本人が容易に認識できない方法による個人情報の取得</dt>
					<dd>クッキーやウェブビーコン等を用いるなどして、本人が容易に認識できない方法による個人情報の取得は行っておりません。</dd>

					<dt>個人情報の安全管理措置について</dt>
					<dd>取得した個人情報については、漏えい、滅失またはき損の防止と是正、その他個人情報の安全管理のために必要かつ適切な措置を講じます。<br>
						　このサイトは、SSL（Secure Socket Layer）による暗号化措置を講じています。</dd>

					<dt>個人情報保護方針</dt>
					<dd><a href="/privacy.php">こちらの個人情報保護方針</a>をご覧ください。</dd>
				</dl>
			</div>
			<div class="txt_center">
				<input type="checkbox" name="agree" id="agree">　私は、<a href="/terms.php">利用規約</a>および<a href="/privacy.php">プライバシーポリシー</a>の個人情報保護方針に同意し、問い合わせます。
				<br>
				<br>
				<button type="button" class="button send" disabled>送信</button>
			</div>
		</form>
	</div>
</section>

<section class="container" id="Thanks">
	<ul id="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<li><a href="/" itemprop="url"><span itemprop="title">トップ</span></a></li>
		<li><span itemprop="title">お問い合わせ内容送信完了</span></li>
	</ul>
	<br>

	<div class="container block">
		<h1>以下の内容でメールを送信しました。</h1>

		<dl>
			<dt>ご氏名</dt>
			<dd id="InputedName"></dd>

			<dt>メールアドレス</dt>
			<dd id="InputedEmail"></dd>

			<dt>タイトル</dt>
			<dd id="InputedTitle"></dd>

			<dt>内容</dt>
			<dd id="InputedContents"></dd>
		</dl>
	</div>
</section>

<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script src="/js/feedback.js"></script>
</body>
</html>