<?php
$myGET = $_GET;
$service = 'all';
unset($myGET['area']);
unset($myGET['Area']);
unset($myGET['pref']);
unset($myGET['city']);
unset($myGET['town']);
unset($myGET['lineR']);
unset($myGET['stationR']);
unset($myGET['speciality_id']);
$q = http_build_query($myGET);
$q = ($q) ? "?". $q : null;

$path = explode("/", preg_replace("/^\/|\/$/","", $_SERVER['REQUEST_URI']));
if (!isset($path[4])) return false;
$lineR = $path[4];
foreach ($jsonLine as $l) {
	if ($l['LineNameR'] == $lineR){
		$lineId = $l['LineId'];
		$lineName = $l['LineName'];
		break;
	}
}

$jsonStation = json_decode(file_get_contents($_->api. "/station?lineIds={$lineId}"), true);

// speciality変換
if (isset($_GET['speciality_id']) && $_GET['speciality_id'] != ''){
	// Get Json
	$serviceArr = array_filter($_->serviceMaster, function($v){
		return $v->Id == $_GET['speciality_id'];
	});
	$serviceArr = array_values($serviceArr);
	$service = (isset($serviceArr[0]->Url) && $serviceArr[0]->Url != '') ? $serviceArr[0]->Url : null;
}
$service = ($service)?: null;
$contents['list'] = '';

foreach($jsonStation as $j){
	$contents['list'] .= "<a href=\"/result/{$service}/{$path[2]}/railway/{$j['LineNameR']}/{$j['StationNameR']}/{$q}\">{$j['StationName']}</a>";
}
?>
<li class="lv3">
	<?php echo $lineName; ?>
	<div class="nav_submenu" style="display: none;">
		<?php echo $contents['list']; ?>
		<div class="button_area">
			<button class="button small close">閉じる</button>
		</div>
	</div>

</li>