<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/MedicalClinic">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title><?php echo $templ->HospitalName; ?>の詳細【エストドック】</title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/doctor.css">
	<!--[if IE]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
	<script src="//maps.google.com/maps/api/js?sensor=false"></script>
</head>
<body>
	<!-- parts --><?php include($_->parts_dir. '/header.php'); ?><!-- /parts -->

	<section class="container">
		<ul id="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<li><a href="/" itemprop="url"><span itemprop="title">トップ</span></a></li>
			<li><span itemprop="title"><?php echo $templ->HospitalName; ?></span></li>
		</ul>
		<br>
		<div class="title">
			<h1>
				<span itemprop="name"><?php echo $templ->HospitalName; ?></span><br>
				<small>(診療科目：<span itemscope itemtype="http://schema.org/MedicalSpecialty" itemprop="medicalSpecialty"><?php echo preg_replace('/,/', '、', $templ->Services); ?></span>)</small>
			</h1>
			<div class="on_foot">
				<?php
					$templ->access = array_filter($templ->access);
					echo array_reduce($templ->access, function($k, $v){
						return "{$k}<span>". str_replace('<br>', '', $v). "</span>";
					});
				?>
			</div>
		</div>

		<!-- show below, and has reservation data -->
		<?php if ($templ->Source): ?>
		<div class="drProf container">
			<div class="pic box">
				<ul class="thumb">
					<?php echo $templ->Img; ?>
				</ul>
			</div>
			<div class="prof box">
				<?php echo ($templ->SellingPoint) ? "<strong>{$templ->SellingPoint}</strong>": ''; ?>

				<p class="comment" data-num="160" itemprpo="description">
					<?php echo $templ->Introduction; ?>
				</p>
				<?php echo (mb_strlen($templ->Introduction, 'utf-8') > 160) ? '<button class="button small readMore moreHospital">もっと見る</button>' : ''; ?>

				<ul id="feature">
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
			<div class="map box">
				<div id="map" data-lat="<?php echo $templ->Latitude; ?>" data-lng="<?php echo $templ->Longitude; ?>" data-title="<?php echo $templ->HospitalName; ?>" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
					<meta itemprop="latitude" content="<?php echo $templ->Latitude; ?>">
					<meta itemprop="longitude" content="<?php echo $templ->Longitude; ?>">
				</div>
				<dl itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
					<dt>住所</dt>
					<meta itemprop="addressRegion" content="<?php echo $templ->Prefecture; ?>">
					<meta itemprop="addressLocality" content="<?php echo $templ->City; ?>">
						<meta itemprop="streetAddress" content="<?php echo preg_replace("/{$templ->Prefecture}{$templ->City}/", '', $templ->Address); ?>">
						<dd><span itemprop="address"><?php echo $templ->Address; ?></span></dd>
						<dt>アクセス</dt>
						<dd>
							<?php	echo array_reduce($templ->access, function($k, $v){ return "{$k}$v"; }); ?>
						</dd>
				</dl>
			</div>
		</div>
		<?php endif; ?>
		<!-- /show below, and has reservation data -->

		<!-- show below, and has reservation data -->
		<?php if ($templ->Source): ?>
		<article class="mt10">
			<h2>予約情報</h2>

			<div class="info container">
				<div class="div_tel">
					<?php
					echo ($templ->PpcPhone) ?
						"<a href=\"tel:{$templ->PpcPhone}\" class=\"button navRsv doctor\">予約専用ダイヤル（無料）<br><strong itemprop=\"telephone\" class=\"tel\">{$templ->PpcPhone}</strong></a>" : "";
					?>
				</div>

				<div class="div_tt">
					<?php echo $templ->consultationHours; ?>
				</div>
			</div>

			<table id="schedule" data-iid="<?php echo $templ->PublicId; ?>">
				<caption><h2>予約可能日時<small>（時刻をクリックすると予約手続きができます）</small></h2></caption>
				<tbody>
				<tr>
					<th rowspan="2"><button class="button prev move_week"></button></th>
					<th class="d"></th>
					<th class="d"></th>
					<th class="d"></th>
					<th class="d"></th>
					<th class="d"></th>
					<th class="d"></th>
					<th class="d"></th>
					<th rowspan="2"><button class="button next move_week"></button></th>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				</tbody>
			</table>

			<?php if (count($doctor) > 0): ?>
			<h2>在籍医師一覧</h2>
			<ul id="doctorList">
				<?php
					$doctor[0]['Url'] = $_->api;
					echo array_reduce($doctor, function($k, $v){
						$imgJson = json_decode(file_get_contents("http://api.estdoc.jp/hospital/image?publicId={$v['PublicId']}&doctorId={$v['DoctorId']}"));
						$img = (isset($imgJson[0])) ? $imgJson[0]->Url : '/img/noimg.png';

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
			<br/>
			<?php endif; ?>
		</article>
		<?php endif; ?>
		<!-- /show below, and has reservation data -->


		<article <?php echo ($templ->Source) ? 'class="mt10"' : ''; ?>>
			<h2<?php echo (!$templ->Source) ? ' style="border: none;"' : ''; ?>>詳細情報</h2>

			<?php if (!$templ->Source){ echo $templ->consultationHours; } ?>
			<div class="info container">
				<table id="detail">
					<tbody>
					<tr>
						<th>診療科目</th>
						<td itemscope itemtype="http://schema.org/MedicalSpecialty" itemprop="medicalSpecialty">
							<?php echo preg_replace('/,/', '、', $templ->Services); ?>
						</td>
					</tr>
					<?php
						$arr1 = preg_split('/,/', $templ->Keyword1, -1, PREG_SPLIT_NO_EMPTY);
						$arr2 = preg_split('/,/', $templ->Keyword2, -1, PREG_SPLIT_NO_EMPTY);
						$arr = array_merge($arr1, $arr2);
					echo (count($arr) > 0) ? "<tr>\n<th>特徴</th>\n<td>". array_reduce($arr, function($k, $v){ return "{$k}\r\n<li itemprop=\"availableService\">{$v}</li>"; }). "</td>\n</tr>" : '';
					?>
					<tr>
						<th>予約ダイヤル<br>（問い合わせ番号）</th>
						<td>
							<?php
								echo ($templ->PpcPhone) ? "予約用ダイヤル<br>\n<div><strong itemprop=\"telephone\" class=\"ml10 span_tel\">{$templ->PpcPhone}</strong></div>" : "";
								//echo ($templ->Phone)    ? "問い合わせ用ダイヤル<br>\n<div><strong itemprop=\"telephone\" class=\"ml10\">{$templ->Phone}</strong></div>" : "";
							?>
						</td>
					</tr>
					<tr>
						<th>住所</th>
						<td><?php echo $templ->Address; ?></td>
					</tr>
					<tr>
						<th>アクセス</th>
						<td><?php
							echo array_reduce($templ->access, function($k, $v){
								return "{$k}$v";
							});
						?></td>
					</tr>
					<?php if ($templ->MedicalDirector) { ?><tr>
						<th>院長名</th>
						<td><?php echo $templ->MedicalDirector; ?></td>
					</tr><?php } ?>
					<?php if ($templ->MdComment) { ?><tr>
						<th>院長略歴</th>
						<td><?php echo $templ->MdComment; ?></td>
					</tr><?php } ?>
					</tbody>
				</table>

				<?php if (!$templ->Source): ?>
				<div class="map box">
					<div id="map" data-lat="<?php echo $templ->Latitude; ?>" data-lng="<?php echo $templ->Longitude; ?>" data-title="<?php echo $templ->HospitalName; ?>" itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
						<meta itemprop="latitude" content="<?php echo $templ->Latitude; ?>">
						<meta itemprop="longitude" content="<?php echo $templ->Longitude; ?>">
					</div>
					<dl itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
						<dt>住所</dt>
						<meta itemprop="addressRegion" content="<?php echo $templ->Prefecture; ?>">
						<meta itemprop="addressLocality" content="<?php echo $templ->City; ?>">
						<meta itemprop="streetAddress" content="<?php echo preg_replace("/{$templ->Prefecture}{$templ->City}/", '', $templ->Address); ?>">
						<dd><span itemprop="address"><?php echo $templ->Address; ?></span></dd>
						<dt>アクセス</dt>
						<dd>
							<?php	echo array_reduce($templ->access, function($k, $v){ return "{$k}$v"; }); ?>
						</dd>
					</dl>
				</div>
				<?php endif; ?>

				<!--
				<ul id="reviews" itemprop="review" itemscope itemtype="http://schema.org/Review">
					<h3>この医院のクチコミ</h3>
					<li>
						<aside itemprop="reviewBody">
							先生の処置はいつも丁寧で信頼できます。<br>
							先生の処置はいつも丁寧で信頼できます。
						</aside>
						<dl>
							<dt>医師信頼</dt>
							<dd>○</dd>
							<dt>待ち時間</dt>
							<dd>ー</dd>
							<dt>設備充実</dt>
							<dd>ー</dd>
						</dl>
					</li>
				</ul>
				-->
			</div>

		</article>

	</section>

	<!-- parts --><?php include($_->parts_dir. '/footer.php'); ?><!-- /parts -->
	<script src="/js/$ui.js"></script>
	<script src="/js/doctor.js"></script>
</body>
</html>