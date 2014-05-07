<?php
$d = '';
$service = 'all';
$myGET = $_GET;
unset($myGET['area']);
unset($myGET['Area']);
unset($myGET['pref']);
unset($myGET['city']);
unset($myGET['town']);
unset($myGET['lineR']);
unset($myGET['stationR']);
unset($myGET['speciality_id']);
$q = http_build_query($myGET);
$q = ($q) ? "railway/?". $q : "railway/";

// speciality変換
if (isset($_GET['speciality_id']) && $_GET['speciality_id'] != ''){
	// Get Json
	$serviceArr = array_filter($_->serviceMaster, function($v){
		return $v->Id == $_GET['speciality_id'];
	});
	$serviceArr = array_values($serviceArr);
	$service = (isset($serviceArr[0]->Url) && $serviceArr[0]->Url != '') ? $serviceArr[0]->Url : null;
}
$service = ($service)?: 'all';

$d = "/result/{$service}/";
?>
<li class="lv1">
	全国
	<div class="nav_submenu" style="display: none;">
		<dl>
			<dt>北海道・東北</dt>
			<dd>
				<a href="<?php echo "{$d}hokkaidou/{$q}"; ?>">北海道</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}aomoriken/{$q}"; ?>">青森</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}akitaken/{$q}"; ?>">秋田</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}iwateken/{$q}"; ?>">岩手</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}yamagataken/{$q}"; ?>">山形</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}miyagiken/{$q}"; ?>">宮城</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}fukushimaken/{$q}"; ?>">福島</a>
			</dd>
		</dl>

		<dl>
			<dt>関東</dt>
			<dd>
				<a href="<?php echo "{$d}toukyouto/{$q}"; ?>">東京</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}kanagawaken/{$q}"; ?>">神奈川</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}chibaken/{$q}"; ?>">千葉</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}saitamaken/{$q}"; ?>">埼玉</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}gunmaken/{$q}"; ?>">群馬</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}tochigiken/{$q}"; ?>">栃木</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}ibarakiken/{$q}"; ?>">茨城</a>
			</dd>
		</dl>

		<dl>
			<dt>中部</dt>
			<dd>
				<a href="<?php echo "{$d}aichiken/{$q}"; ?>">愛知</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}mieken/{$q}"; ?>">三重</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}gifuken/{$q}"; ?>">岐阜</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}shizuokaken/{$q}"; ?>">静岡</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}yamanashiken/{$q}"; ?>">山梨</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}naganoken/{$q}"; ?>">長野</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}niigataken/{$q}"; ?>">新潟</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}ishikawaken/{$q}"; ?>">石川</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}fukuiken/{$q}"; ?>">福井</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}toyamaken/{$q}"; ?>">富山</a>
			</dd>
		</dl>

		<dl>
			<dt>関西</dt>
			<dd>
				<a href="<?php echo "{$d}oosakafu/{$q}"; ?>">大阪</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}kyoutofu/{$q}"; ?>">京都</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}hyougoken/{$q}"; ?>">兵庫</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}shigaken/{$q}"; ?>">滋賀</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}naraken/{$q}"; ?>">奈良</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}wakayamaken/{$q}"; ?>">和歌山</a>
			</dd>
		</dl>

		<dl>
			<dt>中国・四国</dt>
			<dd>
				<a href="<?php echo "{$d}hiroshimaken/{$q}"; ?>">広島</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}okayamaken/{$q}"; ?>">岡山</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}yamaguchiken/{$q}"; ?>">山口</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}shimaneken/{$q}"; ?>">島根</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}tottoriken/{$q}"; ?>">鳥取</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}tokushimaken/{$q}"; ?>">徳島</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}kagawaken/{$q}"; ?>">香川</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}ehimeken/{$q}"; ?>">愛媛</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}kouchiken/{$q}"; ?>">高知</a>
			</dd>
		</dl>

		<dl>
			<dt>九州・沖縄</dt>
			<dd>
				<a href="<?php echo "{$d}fukuokaken/{$q}"; ?>">福岡</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}sagaken/{$q}"; ?>">佐賀</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}nagasakiken/{$q}"; ?>">長崎</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}kumamotoken/{$q}"; ?>">熊本</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}ooitaken/{$q}"; ?>">大分</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}miyazakiken/{$q}"; ?>">宮崎</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}kagoshimaken/{$q}"; ?>">鹿児島</a>&nbsp;|&nbsp;<a href="<?php echo "{$d}okinawaken/{$q}"; ?>">沖縄</a>
			</dd>
		</dl>
		<div class="button_area">
			<button class="button small close">閉じる</button>
		</div>
	</div>

</li>