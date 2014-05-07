<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title itemprop="about"></title>
	<link rel="prev" href="">
	<link rel="next" href="">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/doctor.css">
	<script src="//maps.google.com/maps/api/js?sensor=false"></script>
</head>
<body>
<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

<main>
	<div class="container">
		<div class="pic">
			<?php echo $templ->Img; ?>
		</div>

		<div class="titles">
			<h1><?php echo $templ->HospitalName; ?></h1>

			診療科目：
			<span itemscope itemtype="http://schema.org/MedicalSpecialty" itemprop="medicalSpecialty"><?php echo preg_replace('/,/', '、', $templ->Services); ?></span></dd>
		</div>
	</div>

	<?php if ($templ->Source): ?>
		<h2>予約情報</h2>
		<div id="RsvInfo">
			<?php if ($templ->PpcPhone): ?>
				<a href="tel:<?php echo $templ->PpcPhone; ?>" class="button tel navRsv">電話で予約する(<strong itemprop="telephone" class="tel"><?php echo $templ->PpcPhone; ?></strong>)・無料通話</a><br>
			<?php endif; ?>

			<aside class="schedule time a<?php echo $templ->PublicId; ?>" data-iid="<?php echo $templ->PublicId; ?>">
				<ul>
					<li><button class="button prev icon">&#xf053;</button></li>
					<li class="d"></li>
					<li class="d"></li>
					<li class="d"></li>
					<li class="d"></li>
					<li class="d"></li>
					<li class="d"></li>
					<li class="d"></li>
					<li><button class="button next icon">&#xf054;</button></li>
				</ul>
				<br>
				<div class="time_btns"></div>
			</aside>

			</div>
		</div>
	<?php endif; ?>

	<h2>住所・アクセス</h2>
	<div id="Address">
		<dl itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			<dt>住所</dt>
			<meta itemprop="addressRegion" content="<?php echo $templ->Prefecture; ?>">
			<meta itemprop="addressLocality" content="<?php echo $templ->City; ?>">
			<meta itemprop="streetAddress" content="<?php echo preg_replace("/{$templ->Prefecture}{$templ->City}/", '', $templ->Address); ?>">
			<dd>
				<span itemprop="address"><?php echo $templ->Address; ?></span>
				<button class="button green map">地図を表示</button>
			</dd>
			<?php
				$accessStr = array_reduce($templ->access, function($k, $v){ return "{$k}$v"; });
				if ($accessStr):
			?>
			<dt>アクセス</dt>
			<dd>
				<?php	echo $accessStr; ?>
			</dd>
			<?php endif; ?>
		</dl>
	</div>

	<h2>診療時間</h2>
	<div class="consultationHours">
		<dl>
			<dt>月</dt>
			<dd><?php echo $templ->HourMon; ?></dd>
		</dl>
		<dl>
			<dt>火</dt>
			<dd><?php echo $templ->HourTues; ?></dd>
		</dl>
		<dl>
			<dt>水</dt>
			<dd><?php echo $templ->HourWed; ?></dd>
		</dl>
		<dl>
			<dt>木</dt>
			<dd><?php echo $templ->HourThurs; ?></dd>
		</dl>
	</div>
	<div class="consultationHours">
		<dl>
			<dt>金</dt>
			<dd><?php echo $templ->HourFri; ?></dd>
		</dl>
		<dl>
			<dt class="sat">土</dt>
			<dd class="sat"><?php echo $templ->HourSat; ?></dd>
		</dl>
		<dl>
			<dt class="hol">日</dt>
			<dd class="hol"><?php echo $templ->HourSun; ?></dd>
		</dl>
		<dl>
			<dt class="hol">祝</dt>
			<dd class="hol"><?php echo $templ->HourHoliday; ?></dd>
		</dl>
	</div>

	<h2><?php echo $templ->HospitalName; ?>の特長</h2>
	<div id="Feature">
		<ul>
			<?php
			$arr = preg_split('/,/', $templ->Keyword1, -1, PREG_SPLIT_NO_EMPTY);
			echo (count($arr) > 0) ? array_reduce($arr, function($k, $v){ return "{$k}\r\n<li itemprop=\"availableService\">{$v}</li>"; }) : '';
			?>
			<?php
			$arr = preg_split('/,/', $templ->Keyword2, -1, PREG_SPLIT_NO_EMPTY);
			echo (count($arr) > 0) ? array_reduce($arr, function($k, $v){ return "{$k}\r\n<li itemprop=\"availableService\">{$v}</li>"; }) : '';
			?>
		</ul>
	</div>

	<h2>在籍医師</h2>
	<div id="Doctor">
		<ul id="doctorList">
			<?php
			$doctor[0]['Url'] = $_->api;
			echo array_reduce($doctor, function($k, $v){
				$imgJson = json_decode(file_get_contents("http://api.estdoc.jp/hospital/image?publicId={$v['PublicId']}&doctorId={$v['DoctorId']}"));
				$img = $imgJson[0]->Url;

				echo "<li><img src=\"{$img}\" width=\"100\" alt=\"{$v['DoctorName']}\"></li>";
				echo "<li>";
				echo "\t<strong>{$v['DoctorName']}先生</strong><br>";
				echo "\t<p class=\"comment\" data-num=\"50\">";
				echo "\t\t{$v['Introduction']}<br>{$v['SellingPoint']}";
				echo "\t</p>";
				echo (mb_strlen($v['Introduction'].$v['SellingPoint'], 'utf-8') > 50) ? "<button class=\"button small readMore moreDoctor\">もっと見る</button>" : "";
				echo "</li>";
			});
			?>
		</ul>
	</div>

	<h2>詳細情報</h2>
	<div id="Detail">
		<dl>
			<dt>診療科目</dt>
			<dd itemscope itemtype="http://schema.org/MedicalSpecialty" itemprop="medicalSpecialty">
				<?php echo preg_replace('/,/', '、', $templ->Services); ?>
			</dd>
		</dl>
		<dl>
			<dt>予約ダイヤル<br>(問い合わせ番号)</dt>
			<dd><?php
					echo ($templ->PpcPhone) ? "予約用ダイヤル<br>\n<div><strong itemprop=\"telephone\" class=\"ml10 span_tel\">{$templ->PpcPhone}</strong></div>" : "";
					echo ($templ->Phone)    ? "問い合わせ用ダイヤル<br>\n<div><strong itemprop=\"telephone\" class=\"ml10\">{$templ->Phone}</strong></div>" : "";
			?></dd>
		</dl>
		<dl>
			<dt>住所</dt>
			<dd><?php echo $templ->Address; ?></dd>
		</dl>
		<?php if ($accessStr): ?>
		<dl>
			<dt>アクセス</dt>
			<dd><?php echo array_reduce($templ->access, function($k, $v){ return "{$k}$v"; }); ?></dd>
		</dl>
		<?php endif; ?>
		<?php if ($templ->MedicalDirector): ?>
			<dl>
				<dt>院長名</dt>
				<dd><?php echo $templ->MedicalDirector; ?></dd>
			</dl>
		<?php endif; ?>
		<?php if ($templ->MdComment): ?>
			<dl>
				<dt>院長略歴</dt>
				<dd><?php echo $templ->MdComment; ?></dd>
			</dl>
		<?php endif; ?>
	</div>
</main>

<section id="HosMap">
	<button class="button close">地図を閉じる</button>
	<div id="map" data-lat="<?php echo $templ->Latitude; ?>" data-lng="<?php echo $templ->Longitude; ?>" data-title="<?php echo $templ->HospitalName; ?>" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates"></div>
</section>

<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
<script src="/js/$ui.js"></script>
<script src="/js/showTimeTable.js"></script>
<script src="/js/doctor.js"></script>
</body>
</html>