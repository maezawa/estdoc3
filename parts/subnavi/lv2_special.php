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
if (!isset($path[3]) || preg_match('/\?.+/', $path[3])) return false;

$jsonPref	= json_decode(file_get_contents($_->api. "/address/roma?prefecture={$path[3]}"), true);
$param = "id={$jsonPref[0]['Id']}&level=1";
$jsonPlace	= json_decode(file_get_contents($_->api. "/addresss?{$param}"), true);

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

$contents['pref'] = $jsonPlace[0]['Prefecture'];
$contents['list'] = '';
foreach($jsonPlace as $j){
	$contents['list'] .= "<a href=\"/result/{$service}/{$path[2]}/{$j['CityRoma']}/{$q}\">{$j['City']}</a>";
}
?>
<li class="lv2">
	<?php echo $contents['pref']; ?>

	<div class="nav_submenu" style="display: none;">
		<?php echo $contents['list']; ?>
		<div class="button_area">
			<button class="button small close">閉じる</button>
		</div>
	</div>

</li>