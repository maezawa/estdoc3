<!-- Main Menu -->
<menu>
	<ul>
		<a href="/"><li>トップページ</li></a>
		<?php
			echo (preg_match('/^\/index.php$/', $_SERVER['REQUEST_URI'])) ? '<a href="#Detail" class="to_detail"><li>詳細検索</li></a>' : '<a class="detailSearch"><li>詳細検索</li></a>';
		?>
		<a href="/feedback.php"><li>お問い合わせ</li></a>
		<a href="/about_us.php"><li>運営会社について</li></a>
	</ul>
</menu>
<!-- /Main Menu -->
<footer itemscope itemtype="http://schema.org/WPFooter">
	Copyright© 2014 EST Doc Ltd. All right reserved.
</footer>
<script src="//cdnjs.cloudflare.com/ajax/libs/zepto/1.1.3/zepto.min.js"></script>
<script src="/js/common.js"></script>
<script src="/js/jquery.ajaxComboBox.min.js"></script>
<script src="/js/pref.js"></script>