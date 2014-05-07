<?php
$prefs = array(
	'hokkaidou' => '北海道',
	'aomoriken' => '青森',
	'iwateken' => '岩手',
	'miyagiken' => '宮城',
	'akitaken' => '秋田',
	'yamagataken' => '山形',
	'fukushimaken' => '福島',
	'ibarakiken' => '茨城',
	'tochigiken' => '栃木',
	'gunmaken' => '群馬',
	'saitamaken' => '埼玉',
	'chibaken' => '千葉',
	'toukyouto' => '東京',
	'kanagawaken' => '神奈川',
	'niigataken' => '新潟',
	'toyamaken' => '富山',
	'ishikawaken' => '石川',
	'fukuiken' => '福井',
	'yamanashiken' => '山梨',
	'naganoken' => '長野',
	'gifuken' => '岐阜',
	'shizuokaken' => '静岡',
	'aichiken' => '愛知',
	'mieken' => '三重',
	'shigaken' => '滋賀',
	'kyoutofu' => '京都',
	'oosakafu' => '大阪',
	'hyougoken' => '兵庫',
	'naraken' => '奈良',
	'wakayamaken' => '和歌山',
	'tottoriken' => '鳥取',
	'shimaneken' => '島根',
	'okayamaken' => '岡山',
	'hiroshimaken' => '広島',
	'yamaguchiken' => '山口',
	'tokushimaken' => '徳島',
	'kagawaken' => '香川',
	'ehimeken' => '愛媛',
	'kouchiken' => '高知',
	'fukuokaken' => '福岡',
	'sagaken' => '佐賀',
	'nagasakiken' => '長崎',
	'kumamotoken' => '熊本',
	'ooitaken' => '大分',
	'miyazakiken' => '宮崎',
	'kagoshimaken' => '鹿児島',
	'okinawaken' => '沖縄'
);

echo '<ul id="Prefs">';

foreach ($prefs as $key => $value){
	echo '<a href="/japan/'. $key. '/"><li>'. $value . "</li></a>\n";
}

echo '</ul>';
?>