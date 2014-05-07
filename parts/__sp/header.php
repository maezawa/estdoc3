<header itemscope itemtype="http://schema.org/WPHeader">
	<div id="Logo">
		<a href="/"><img src="/img/common/logo.png" id="logo" alt="EST Doc"></a>
	</div>
	<div id="Menu">
		<?php
			echo (preg_match('/(result|special)/', $_SERVER['REQUEST_URI']) && $templ['CondLat'] != '' && $templ['CondLng'] != '') ? '<button class="button green map">地図を表示</button>' : null;
		?>
		<button class="button main_menu">MENU</button>
	</div>
</header>