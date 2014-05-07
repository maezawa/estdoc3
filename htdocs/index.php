<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title>病院・歯医者の24時間検索/予約サイト - エストドック</title>
	<meta name="keywords" content="予約, 歯医者,  病院, 検索, 休日, 土曜日, 祝日, 日曜日,夜間診療,時間指定,エストドック,ESTDoc">
	<meta name="description" content="「アナタの都合に合わせた」病院、歯医者を24時間検索・予約！待ち時間だって減少！夜間診療、土曜・日曜診療も「時間を指定して」探すことが出来ます。">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/prefs.css">
	<link rel="stylesheet" href="/css/index.css">
	<!--[if IE]>
	<link rel="stylesheet" href="/css/ie.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

<section>
	<!-- Main Contents -->
	<div id="A">
		<img src="/img/top.png" width="700" height="350" alt="">

		<div id="counter">
			<h2>掲載医院数</h2>
			<div class="txt_center">
				<strong>155,600件</strong><br>
			</div>
			<dl>
				<dt>土曜診療</dt>
				<dd><strong>142,374</strong>件</dd>
				<dt>夜間（20時以降）</dt>
				<dd><strong>11,588</strong>件</dd>
			</dl>

			<div class="txt_center">
				<small><?php echo date('Y年m月'); ?>現在</small>
			</div>
		</div>
	</div>

	<div class="p">
		<h2 class="quick"><span>クイックサーチで病院・歯医者を探す</span></h2>
		<div id="quick">
			<!-- parts --><?php include($_->parts_dir. '/form/Quick_search.php'); ?><!-- /parts -->
			<button class="button green" id="toggleDetail">詳しく条件指定して検索</button>
		</div>

		<div id="detail">
			<form action="/result.php" id="formDetailSearch">
				<dl>
					<!-- 診療科目　プルダウン -->
					<dt>診療科目</dt>
					<dd><?php include($_->parts_dir. '/form/specialities.php'); ?></dd>
					<!-- /診療科目　プルダウン -->

					<!-- エリア名・駅名　テキスト -->
					<dt>エリア名・駅名</dt>
					<dd><input type="text" id="DArea" class="inputArea" name="area"><input type="hidden" name="Area" id="DArea_" value="<?php echo (isset($_GET['Area'])) ? $_GET['Area'] : ''; ?>"></dd>
					<!-- /エリア名・駅名　テキスト -->

					<!-- 曜日指定　チェックボックス＆リンク -->
					<dt>曜日指定　<small>（複数選択可能）</small></dt>
					<dd class="day">
						<label for="ws1"><input type="checkbox" name="week[]" id="ws1" value="1">月曜日</label>
						<label for="ws2"><input type="checkbox" name="week[]" id="ws2" value="2">火曜日</label>
						<label for="ws3"><input type="checkbox" name="week[]" id="ws3" value="3">水曜日</label>
						<label for="ws4"><input type="checkbox" name="week[]" id="ws4" value="4">木曜日</label>
						<label for="ws5"><input type="checkbox" name="week[]" id="ws5" value="5">金曜日</label><br>
						<label for="ws6"><input type="checkbox" name="week[]" id="ws6" value="6">土曜日</label>
						<label for="ws7"><input type="checkbox" name="week[]" id="ws7" value="7">日曜日</label>
						<label for="ws8"><input type="checkbox" name="week[]" id="ws8" value="8">祝日</label>
					</dd>
					<!-- /曜日指定　チェックボックス＆リンク -->

					<!-- 時間指定　チェックボックス＆リンク -->
					<dt>時間指定　<small>（複数選択可能）</small></dt>
					<dd class="time"><?php include($_->parts_dir. '/form/checkbox/hourzone_index.php'); ?></dd>
					<!-- /時間指定　チェックボックス＆リンク -->

					<!-- こだわり条件 -->
					<dt>こだわり条件</dt>
					<dd class="detail">
						<ul id="selectDetail">
							<?php include($_->parts_dir. '/form/checkbox/feat.php'); ?>
						</ul>
					</dd>
					<!-- /こだわり条件 -->
				</dl>
				<button type="button" class="button detailSearch" id="doDetailSearch">詳細条件で検索</button>
			</form>
		</div>
	</div>

	<div class="p service">
		<h2 class="ser"><span>診療科目から病院・歯医者探す</span></h2>
		<div class="service_links">
			<!-- parts --><?php include($_->parts_dir. '/index/services.php'); ?><!-- /parts -->
		</div>
		<button class="button green serviceMore">もっと見る</button>
	</div>

	<div class="p">
		<h2 class="area"><span>エリアから病院・歯医者を探す</span></h2>
		<!-- parts --><?php include($_->parts_dir. '/prefs.php'); ?><!-- /parts -->
		<div class="areas">
			<h3>頻出検索エリア</h3>
			<dl>
				<dt>関東エリア</dt>
				<dd>
					<a href="/result/all/toukyouto/railway/yamanotesen/shinnjuku/">新宿</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/shibuya/">渋谷</a>／
					<a href="/result/all/toukyouto/railway/toukaidouhonsen/yokohama/">横浜</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/tokyou/">東京駅／
					<a href="/result/all/toukyouto/railway/yamanotesen/tokyo/">浅草</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/ueno/">上野</a>／
					<a href="/result/all/toukyouto/railway/toukaidouhonsen/nakameguro/">中目黒</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/ebisu/">恵比寿</a>／
					<a href="/result/all/toukyouto/railway/hibiyasen/ropponngi/">六本木</a>／
					<a href="/result/all/toukyouto/railway/ginzasen/omotesanndou/">表参道</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/akihabara/">秋葉原</a>／
					<a href="/result/all/toukyouto/railway/touzaisen/kagurazaka/">神楽坂</a>／
					<a href="/result/all/toukyouto/railway/toeiooedosen/azabujuubann/">麻布十番</a>／
					<a href="/result/all/toukyouto/railway/soubuhonsen/kinnshichou/">錦糸町</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/shinagawa/">品川</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/gotanda/">五反田</a>／
					<a href="/result/all/toukyouto/railway/hibiyasen/tsukiji/">築地</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/ikebukuro/">池袋</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/shinnjuku/">人形町</a>／
					<a href="/result/all/toukyouto/railway/tyuuousen/kichijoji/">吉祥寺</a>／
					<a href="/result/all/toukyouto/railway/hibiyasen/kitasennju/">北千住</a>／
					<a href="/result/all/toukyouto/railway/saikyousen/kawagoe/">川越</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/takadanobaba/">高田馬場</a>／
					<a href="/result/all/toukyouto/railway/touzaisen/monnzennnakachou/">門前仲町</a>／
					<a href="/result/all/toukyouto/railway/toeishinzyukusen/jinnbouchou/">神保町</a>／
					<a href="/result/all/toukyouto/railway/tyuuousen/nakano/">中野</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/shinnbashi/">新橋</a>／
					<a href="/result/all/toukyouto/railway/yamanotesen/hamamatsuchou/">浜松町</a>／
					<a href="/result/all/toukyouto/railway/toukyuutouyokosen/jiyuugaoka/">自由が丘</a>
				</dd>

				<dt>東海エリア</dt>
				<dd><a href="/result/all/aichiken/railway/toukaidoushinkansen/Nagoya/">名古屋</a></dd>

				<dt>関西エリア</dt>
				<dd>
					<a href="/result/all/oosakafu/railway/hanshinhonsen/umeda/">梅田</a>／
					<a href="/result/all/hyougoken/railway/koubesen/koube/">神戸</a>／
					<a href="/result/all/hyougoken/railway/koubeshieichikatetuyamatesen/sannnomiya/">三宮</a>
				</dd>
			</dl>
		</div>
		<br>
	</div>

	<!-- こだわり条件 -->
	<div class="p">
		<h2 class="detail"><span>こだわり条件から探す</span></h2>
		<div class="container">
			<div class="h3"><h3>夜間診療医院</h3></div>
			<div class="special_services">
				<a href="/special/night/shika/">歯科</a>&nbsp;／&nbsp;
				<a href="/special/night/shouni-shika/">小児歯科</a>&nbsp;／&nbsp;
				<a href="/special/night/naika/">内科</a>&nbsp;／&nbsp;
				<a href="/special/night/shounika/">小児科</a>&nbsp;／&nbsp;
				<a href="/special/night/hifuka/">皮膚科</a>&nbsp;／&nbsp;
				<a href="/special/night/seikei-geka/">整形外科</a>&nbsp;／&nbsp;
				<a href="/special/night/seishinka/">精神科</a>&nbsp;／&nbsp;
				<a href="/special/night/shinryou-naika/">心療内科</a>&nbsp;／&nbsp;
				<a href="/special/night/ganka/">眼科</a>
			</div>
			<div class="to_special">
				<a href="/special/night/"><strong>夜間診療特集</strong> トップ</a>
			</div>
		</div>

		<div class="container">
			<div class="h3"><h3>休日診療医院</h3></div>
			<div class="special_services">
				<a href="/special/holidays/shika/">歯科</a>&nbsp;／&nbsp;
				<a href="/special/holidays/shouni-shika/">小児歯科</a>&nbsp;／&nbsp;
				<a href="/special/holidays/naika/">内科</a>&nbsp;／&nbsp;
				<a href="/special/holidays/shounika/">小児科</a>&nbsp;／&nbsp;
				<a href="/special/holidays/hifuka/">皮膚科</a>&nbsp;／&nbsp;
				<a href="/special/holidays/seikei-geka/">整形外科</a>&nbsp;／&nbsp;
				<a href="/special/holidays/seishinka/">精神科</a>&nbsp;／&nbsp;
				<a href="/special/holidays/shinryou-naika/">心療内科</a>&nbsp;／&nbsp;
				<a href="/special/holidays/ganka/">眼科</a>
			</div>
			<div class="to_special">
				<a href="/special/holidays/"><strong>休日診療特集</strong> トップ</a>
			</div>
		</div>

		<div class="container">
			<div class="h3"><h3>土曜日診療医院</h3></div>
			<div class="special_services">
				<a href="/special/saturday/shika/">歯科</a>&nbsp;／&nbsp;
				<a href="/special/saturday/shouni-shika/">小児歯科</a>&nbsp;／&nbsp;
				<a href="/special/saturday/naika/">内科</a>&nbsp;／&nbsp;
				<a href="/special/saturday/shounika/">小児科</a>&nbsp;／&nbsp;
				<a href="/special/saturday/hifuka/">皮膚科</a>&nbsp;／&nbsp;
				<a href="/special/saturday/seikei-geka/">整形外科</a>&nbsp;／&nbsp;
				<a href="/special/saturday/seishinka/">精神科</a>&nbsp;／&nbsp;
				<a href="/special/saturday/shinryou-naika/">心療内科</a>&nbsp;／&nbsp;
				<a href="/special/saturday/ganka/">眼科</a>
			</div>
			<div class="to_special">
				<a href="/special/saturday/"><strong>土曜日診療特集</strong> トップ</a>
			</div>
		</div>

		<div class="container">
			<div class="h3"><h3>日曜日診療医院</h3></div>
			<div class="special_services">
				<a href="/special/sunday/shika/">歯科</a>&nbsp;／&nbsp;
				<a href="/special/sunday/shouni-shika/">小児歯科</a>&nbsp;／&nbsp;
				<a href="/special/sunday/naika/">内科</a>&nbsp;／&nbsp;
				<a href="/special/sunday/shounika/">小児科</a>&nbsp;／&nbsp;
				<a href="/special/sunday/hifuka/">皮膚科</a>&nbsp;／&nbsp;
				<a href="/special/sunday/seikei-geka/">整形外科</a>&nbsp;／&nbsp;
				<a href="/special/sunday/seishinka/">精神科</a>&nbsp;／&nbsp;
				<a href="/special/sunday/shinryou-naika/">心療内科</a>&nbsp;／&nbsp;
				<a href="/special/sunday/ganka/">眼科</a>
			</div>
			<div class="to_special">
				<a href="/special/sunday/"><strong>日曜日診療特集</strong> トップ</a>
			</div>
		</div>

		<div class="container">
			<div class="h3"><h3>その他のこだわり条件</h3></div>
			<div class="special_services">
				<a href="/result.php?walk=1">徒歩5分</a>&nbsp;／&nbsp;
				<a href="/special/web-reservation/">WEB予約可</a>&nbsp;／&nbsp;
				<a href="/special/kids_room/">託児所あり</a>&nbsp;／&nbsp;
				<a href="/special/whitening/">ホワイトニング</a>&nbsp;／&nbsp;
				<a href="/special/shisyuubyou/">歯周病</a>&nbsp;／&nbsp;
				<a href="/special/kousyuu/">口臭治療</a>
			</div>
			<div class="to_special">
				<a href="/special/"><strong>こだわり特集一覧</strong></a>
			</div>
		</div>
	</div>

		<!-- Misc. -->
		<div class="container misc">
			<div><img src="/img/howto.png"></div>
			<div><img src="/img/free.png"></div>
			<div><img src="/img/15m.png"></div>
		</div>


	<!-- /Main Contents -->
</section>

<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script src="/js/index.js"></script>
<script src="/js/special.js"></script>
</body>
</html>