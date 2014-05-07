<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MGMK84" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MGMK84');</script>
<!-- End Google Tag Manager -->
<header itemscope itemtype="http://schema.org/WPHeader">
	<?php if (isset($templ) && is_array($templ) && isset($templ['h1']) && $templ['h1'] != ''): ?>
	<h1 id="title"><span><?php echo $templ['h1']; ?></span></h1>
	<?php else: ?>
	<div id="title"></div>
	<?php endif; ?>
	<div class="container">
		<div class="col1">
			<a href="/"><img src="/img/common/logo.png" id="logo" alt="EST Doc"></a>
			&nbsp;<small>病院・歯医者の<br>24時間受付サイト</small>
		</div>
		<div class="col2">
<!--			<a href="/login/" class="button">ログイン</a>-->
			<form action="/result.php" method="get" id="searchFree">
				<label for="selectCategory">診療科目</label>
				<?php include($_->parts_dir. '/form/specialities.php'); ?>
				×

				<label for="Aplacerea">エリア名・駅名</label>
				<input id="Aplacerea" class="inputArea" name="area" value="<?php echo (isset($_GET['area'])) ? $_GET['area'] : ''; ?>" type="text" placeholder="例：渋谷、新宿駅" autocomplete="off">
				<input type="hidden" name="Area" id="Aplacerea_" value="<?php echo (isset($_GET['Area'])) ? $_GET['Area'] : ''; ?>">
				×

				<label for="time">行きたい時間</label>
				<?php include($_->parts_dir. '/form/select/hourzone.php'); ?>

				<button type="button" class="button research">検　索</button>
			</form>
		</div>
		<div id="fixedHeader"></div>
		<div id="fixedHeader" style="z-index: 8"></div>
	</div>
</header>