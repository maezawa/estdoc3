<?php
foreach ($prefs as $key => $value){
	switch ($value){
	case '北海道':
		echo '<div>';
		echo '<dl class="tohoku"><dt>北海道・東北</dt><dd>';
		break;	
	case '茨城':
		echo '<dl class="kanto"><dt>関東</dt><dd>';
		break;
	case '新潟':
		echo '<dl class="chubu"><dt>北陸・中部</dt><dd>';
		break;
	case '滋賀':
		echo '<dl class="kinki"><dt>近畿</dt><dd>';
		break;
	case '鳥取':
		echo '<dl class="chugoku"><dt>中国</dt><dd>';
		break;
	case '徳島':
		echo '<dl class="shikoku"><dt>四国</dt><dd>';
		break;
	case '福岡':
		echo '<dl class="kyushu"><dt>九州・沖縄</dt><dd>';
		break;
	}
	
	echo '<a href="/railway/'. $key. '/">'. $value . "</a>　";

	switch ($value){
	case '福島':
	case '神奈川':
	case '三重':
	case '和歌山':
	case '山口':
	case '高知':
		echo '</dd></dl>';
	}

	switch ($value){
	case '和歌山':
		echo '</div><div>';
		break;
	case '沖縄':
		echo '</div>';
		break;
	}
}
?>