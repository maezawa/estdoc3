<?php // This is a controller of /result.php
/* Controller for PC and Global NameSpace */
namespace{
	require_once $_->class_dir. "/Pagenator.php";

	class Controller extends \ControllerAbstract{
		protected $params, $jwords, $code, $place, $conv, $uri, $H1str, $hasEE;

		public function __construct($_){
			$this->_ = $_;
			$this->uri = $this->getURI();
		}

		protected function getJSON(){
			// Parameters check
			// This script recieves below parameters -
			//
			// speciality_id{1}(診療科目)... throws the api "services"
			// Area{1}(緯度経度)... throws the api "latitude" and "longitude"
			// area{1}(地名)
			// week{1...}(曜日)... throws the api "day"
			// hourZone{1...}(時間帯)... throws the api "hour"
			// feat{1...}(こだわり)... throws the api ""
			$param  = '';
			$context = stream_context_create(array(
				'http' => array('ignore_errors' => true)
			));

			list($lat, $lng, $week, $hour) = array('', '', '', '');
			$offset = (!isset($_GET['page']) || $_GET['page'] == '') ? 1 : $_GET['page'];
			if (!isset($_GET['hourZone'])) $_GET['hourZone'] = null;
			if (isset($_GET['speciality_id']) && $_GET['speciality_id'] == '') unset($_GET['speciality_id']);
			if (isset($_GET['Area']) && $_GET['Area'] != '') list($lat, $lng) = explode(',', $_GET['Area']);
			if (isset($_GET['week']) && $_GET['week'] != '') $week = rtrim(array_reduce($_GET['week'], function($v, $w){ return "{$w},{$v}";}), ',');
			$hour = (is_array($_GET['hourZone'])) ?
				rtrim(array_reduce($_GET['hourZone'], function($v, $w){ return "{$w},{$v}"; }), ',') :
				$_GET['hourZone'];

			if ($this->uri == 'japan' || $this->uri == 'special'){	// case of /japan/...
				$this->jwords['bread_Path'] = array(@$_GET['pref'], @$_GET['city'], @$_GET['town']);
				$param .= "&cityR=". @$_GET['city']. "&townR=". @$_GET['town'];

				$jsonLatLng = @json_decode(file_get_contents($this->_->api. "/geo?prefectureR={$_GET['pref']}". $param, false, $context), true);
				list($lat, $lng) = array(@$jsonLatLng[0]['Latitude'], @$jsonLatLng[0]['Longitude']);
				$this->jwords['bread_Str']  = @explode(',', $jsonLatLng[0]['Word']);

			}elseif ($this->uri == 'railway'){	// case of /railway/...
				if (isset($_GET['lineR']) && $_GET['lineR'] != ''){
					$param .= "&lineR={$_GET['lineR']}";
					$this->jwords['bread_Path'][0] = $_GET['lineR'];
				}

				if (isset($_GET['stationR']) && $_GET['stationR'] != ''){
					$param .= "&stationR={$_GET['stationR']}";
					$this->jwords['bread_Path'][1] = $_GET['stationR'];
				}

				$jsonLatLng = json_decode(file_get_contents($this->_->api. "/geo?". $param, false, $context), true);
				list($lat, $lng) = array($jsonLatLng[0]['Latitude'], $jsonLatLng[0]['Longitude']);

				$this->jwords['bread_Str']  = explode(',', $jsonLatLng[0]['Word']);
			}

			if (isset($_GET['feat'])){
				$estFeat  = array_filter($_GET['feat'], function($v){ return preg_match('/^E.+/', $v); });
				$hourFeat = array_filter($_GET['feat'], function($v){ return preg_match('/^H.+/', $v); });
				$dayFeat  = array_filter($_GET['feat'], function($v){ return preg_match('/^D.+/', $v); });
				$tpecFeat = array_filter($_GET['feat'], function($v){ return preg_match('/^[0-9].+/', $v); });
				$estFeatCSV = implode(',', $estFeat);
				$hour .= str_replace('H', '', implode(',', $hourFeat));
				$week .= str_replace('D', '', implode(',', $dayFeat));
				$tpecFeatCSV = implode(',', $tpecFeat);
			}

			$this->params = array(
				'services'		=> (isset($_GET['speciality_id']) && $_GET['speciality_id'] != '') ? $_GET['speciality_id'] : null,
				'prefecture'	=> @$_GET['pref'],
				'city'				=> @$_GET['city'],
				'town'				=> @$_GET['town'],
				'latitude'		=> $lat,
				'longitude'		=> $lng,
				'day'					=> $week,
				'hour'				=> $hour,
				'estKey'			=> @$estFeatCSV,
				'tpecKey'			=> @$tpecFeatCSV,
				'walk'				=> (isset($_GET['walk']) && $_GET['walk'] != '') ? 1 : null,
				'limit'				=> 30,
				'page'			=> $offset
			);

			$this->params = array_filter($this->params, 'strlen');
			$query = http_build_query($this->params);
			$query = ($this->uri == 'japan' || $this->uri == 'special') ? preg_replace('/latitude=.+&|longitude.+&/', '', $query) : $query;

//			var_dump($_GET);
			// Get JSON
			$context = stream_context_create(array(
				'http' => array('ignore_errors' => true)
			));
			$json	= json_decode(file_get_contents($this->_->api. "/t_hospital/search?{$query}", false, $context), true);
			//echo "<br>". $this->_->api. "/t_hospital/search?{$query}";
			return $json;
		}


		protected function getHTML($json){
			$result = array();
			$this->code = $this->func_ConvertCodes();
			$changeAreaTitle = array(
				'japan'		=> 'エリアを変更する',
				'service'	=> 'エリアを変更する',
				'special'		=> 'エリアを変更する',
				'railway'	=> '路線・駅を変更する',
				'general' => null
			);

			// 検索緯度経度の取得
			$CondLat = @$this->params['latitude'];
			$CondLng = @$this->params['longitude'];

			$template = file_get_contents($this->_->parts_dir. '/result.php', false);

			/*
			 * 検索条件に該当する医療機関情報のリストを取得する
			 */
			$resultList = function($template, $json){
				$html = '';
				$markerLatLng = array();

				// 該当件数
				$query = http_build_query($this->params);
				$query = ($this->uri == 'japan' || $this->uri == 'special') ? preg_replace('/latitude=.+&|longitude.+&/', '', $query) : $query;
				$context = stream_context_create(array(
					'http' => array('ignore_errors' => true)
				));
				$jsonCount = json_decode(file_get_contents($this->_->api. "/t_hospital/search?{$query}&count=1", false, $context), true);


				$this->hasEE = false;
				for($i = 0, $length = count($json); $i < $length; $i++){
					$this->hasEE |= ($json[$i]['Source'] != '');
					$templ = $template;
					list($keys, $vals, $f) = array(array(), array(), array());

					// 関数を通して文字列の置換する
					$templ = str_replace('{{{func_Count}}}', $i * 21, $templ);
					preg_match_all('/{{{(func_[a-zA-Z0-9]+)}}}/', $templ, $f);
					if ($f[0] != ''){
						foreach($f[1] as $ef){
							$templ = str_replace('{{{'. $ef. '}}}', $this->$ef($json[$i]), $templ);
						}
					}

					// 文字列の置換
					foreach($json[$i] as $key => $val){
						$keys[] = '{{'. $key. '}}';
						$vals[] = $val;
					}

					$html .= str_replace($keys, $vals, $templ);

					// マップ上のマーカーで使用する緯度経度JSON生成
					$markerLatLng[] = array(
						'no' => ($i + 1),
						'lat' => $json[$i]['Latitude'],
						'lng' => $json[$i]['Longitude'],
						'flg' => $json[$i]['Source'],
						'id' => $json[$i]['PublicId']
					);
				}
 				return array($html, $markerLatLng, $jsonCount[0]);
			};

			// 検索結果リストの生成
			$result = $resultList($template, $json);

			// Pagenation
			$pages = new \Paginator();
			$pages->items_total = $result[2];
			$pages->paginate();

			// rel="prev/next"
			$prevPage = ($pages->current_page >= 0) ? ($pages->current_page - 1) : null;
			$nextPage = ($pages->current_page < $pages->num_pages) ? ($pages->current_page + 1) : null;
			$uri = preg_replace('/(&|\?)page=[0-9]+/', '', $_SERVER['REQUEST_URI']);
			$uri = (preg_match('/\?/', $uri)) ? $uri.'&' : $uri.'?';

			$prevPage = ($prevPage != '') ? "<link rel=\"prev\" href=\"{$uri}page={$prevPage}\">" : null;
			$nextPage = ($nextPage != '') ? "<link rel=\"next\" href=\"{$uri}page={$nextPage}\">" : null;
			$condStr = (isset($this->code['str'])) ? array_reduce($this->code['str'], function($v, $w){ return "{$v}「{$w}」"; }) : null;

			// HTMLに書き出す要素の設定
			$content = array(
				'count' => number_format($result[2]),
				'CondLat' => $CondLat,
				'CondLng' => $CondLng,
				'resultList' => $result[0],
				'hasEE' => $this->hasEE,
				'markerJson' => json_encode($result[1]),
				'breadcrumb' => $this->func_breadcrumb(),
				'condStr' => $condStr,
				'pagination' => $pages->display_pages(),
				'currentPage' => $pages->getCurrent(),
				'prevPage' => $prevPage,
				'nextPage' => $nextPage,
				'h2' => $this->getH2(),
				'requestURI' => $this->uri,
				'changeAreaTitle' => $changeAreaTitle[$this->uri],
				'h1' => $this->getH1(),
				'title' => $this->getTitle()
			);
			//echo "<br>Result kind ". $this->uri;


			return $content;
		}

		public function getURI(){
			$pureUri = preg_replace('/\?.+/', '', $_SERVER['REQUEST_URI']);
			if (preg_match('/railway/', $_SERVER['REQUEST_URI'])){ return 'railway'; }
			elseif (preg_match('/result\/[^\/]+\/$/', $pureUri)){ return 'service'; }
			elseif (preg_match('/result\.php/', $_SERVER['REQUEST_URI'])){ return 'general'; }
			elseif (preg_match('/special\//', $_SERVER['REQUEST_URI'])){ return 'special'; }
			else{ return 'japan'; }
		}

		public function func_Ppc($j){	// PPCの有無判定を通じたHTMLの生成
			return ($j['PpcPhone'] != '') ? "<a href=\"tel:{$j['PpcPhone']}\" class=\"button navRsv ppc\">予約専用TEL(無料)<br>{$j['PpcPhone']}</a>" : null;
		}

		public function func_Pin($j){
			return ($j['Source'] != '') ? 'verde' : 'bleu';
		}

		public function func_TimeTable($j){	// 空き枠へのボタンHTML生成
			switch ($j['Source']){
			case 'EST':
				return "<button class=\"button show_timeTable\" data-iid=\"{$j['PublicId']}\">本日空き枠あり<br><small>（空き枠を表示する）</small></button><br>";
				break;
			case 'EPARK':
				return "<a href=\"\" class=\"button navRsv\">ネット予約する<br><small>(別サイトに移動します)</small></a>";
			}
		}

		public function func_Service($j){	// 診療科目のHTML生成
			$str = str_replace(',', '、', $j['Services']);
			return ($str != '') ? "(診療科目：<span itemscope itemtype=\"http://schema.org/MedicalSpecialty\" itemprop=\"medicalSpecialty\">{$str}</span>)" : null;
		}

		public function func_Access($j){	// 医院へのアクセス情報HTML生成
			$str = '';
			for ($i = 1; $i < 6; $i++){
				$str .= $j["Line{$i}"]. $j["Station{$i}"];
				$str .= ($j["Exit{$i}"] != '') ? "　". $j["Exit{$i}"]. "から" : null;
				$str .= ($j["FromStation{$i}"] != '') ? "徒歩約". $j["FromStation{$i}"]. "分、" : null;
			}
			return ($str != '') ? "<dt>アクセス</dt>\n<dd>". rtrim($str, '、'). "</dd>" : null;
		}

		public function func_Access1($j){	// 医院へのアクセス情報(1個だけ)HTML生成
			$str = $j['Line1']. $j['Station1'];
			$str.= ($j['Exit1'] != '') ? "　{$j['Exit1']}から" : null;
			$str.= ($j['FromStation1'] != '') ? "徒歩約{$j['FromStation1']}分" : null;
			return ($str != '') ? "<div class=\"access\"><span>{$str}</span></div>" : null;
		}

			public function func_Feature($j){	// 医院の特徴HTML生成
			$feats = $j['Keyword1']. ",". $j['Keyword2'];
			$feats = preg_replace('/-(,*)|^,|,$/', '', $feats);
			$str = str_replace(',', '、', $feats);
			return ($str != '') ? "<dt>特徴</dt>\n<dd>". mb_convert_kana($str, 'KV'). "</dd>" : null;
		}

		public function func_ConsultationT($j){	// 診療時間HTML生成
			$html = '';
			$weeks = array($j['HourMon'], $j['HourTues'], $j['HourWed'], $j['HourThurs'], $j['HourFri'], $j['HourSat'], $j['HourSun'], $j['HourHoliday']);
			$week = array_map(function($day){
				return explode(',', $day);
			}, $weeks);
			$desc = array('午前診療時間', '午後診療時間', '午後診療時間');

			$isSkip = call_user_func_array('array_map', array_merge(array(null), $week));

			for ($i = 0; $i < 3; $i++){
				if (!isset($isSkip[$i])) continue;
				$html .= "<tr itemprop=\"openingHoursSpecification\" itemscope itemtype=\"http://schema.org/OpeningHoursSpecification\">\n";
				$html .= "<meta itemprop=\"description\" content=\"{$desc[$i]}\">\n";
				$html .= "<link itemprop=\"dayOfWeek\" href=\"http://purl.org/goodrelations/v1#Monday\">\n";
				$html .= "<link itemprop=\"dayOfWeek\" href=\"http://purl.org/goodrelations/v1#Tuesday\">\n";
				$html .= "<link itemprop=\"dayOfWeek\" href=\"http://purl.org/goodrelations/v1#Wednesday\">\n";
				$html .= "<link itemprop=\"dayOfWeek\" href=\"http://purl.org/goodrelations/v1#Thursday\">\n";
				$html .= "<link itemprop=\"dayOfWeek\" href=\"http://purl.org/goodrelations/v1#Friday\">\n";
				$html .= "<link itemprop=\"dayOfWeek\" href=\"http://purl.org/goodrelations/v1#Saturday\">\n";

				for ($j = 0; $j < 8; $j++){
					$html .= (isset($week[$j][$i]) && $week[$j][$i] != '') ? "<td>{$week[$j][$i]}</td>\n" : "<td>休診</td>\n";
				}

				$html .= "</tr>\n";
			}
			return $html;
		}

		public function func_ConvertCodes(){
			$conv = array();

			// 駅名・地名
			if ($this->uri == 'railway' || $this->uri == 'japan'){	// case of /railway/...
				$area = array_filter($this->jwords['bread_Str']);
				$area = array_reverse($area);
				$conv['str']['area'] = $area[0];
			}

			// こだわり検索
			if (isset($_GET['feat']) && count($_GET['feat']) > 0){
				$_GET['feat'] = array_filter($_GET['feat'], 'strlen');

				// Get JSON
				$featArr = json_decode(file_get_contents($this->_->class_dir. '/feat.json'), true);
				for ($i = 0; $i < count($_GET['feat']); $i++){
					foreach ($featArr as $each){
						if ($each['id'] == $_GET['feat'][$i]){
							$feat[$i] = $each['title'];
							break;
						}
					}
				}

				$conv['str']['feat'] = array_reduce($feat, function($v, $w){
					return "{$v}「{$w}」";
				});
				$conv['str']['feat'] = preg_replace('/^「/', '', $conv['str']['feat']);
				$conv['str']['feat'] = preg_replace('/」$/', '', $conv['str']['feat']);
			}
			// 診療科目
			if (isset($_GET['speciality_id']) && $_GET['speciality_id'] != ''){
				// Get Json
				$filter = array_merge(array_filter($this->_->serviceMaster, function($v){
					return $v->Id == $_GET['speciality_id'];
				}), array());

				$conv['str']['services'] = $filter[0]->Care;
				$conv['services'] = array(
					'path' => $filter[0]->Url,
					'str'  => $filter[0]->Care
				);
			}

			// 時間帯
			if (isset($_GET['hourZone'])){
				$_GET['hourZone'] = array_filter($_GET['hourZone'], 'strlen');
			}

			if (count($_GET['hourZone']) > 0){
				$conv['str']['time'] = array_reduce($_GET['hourZone'], function($v, $w){
					$codes = array('', '早朝', '午前', '午後', '夕方', '夜間');
					return "{$v}{$codes[$w]}・";
				});
				$conv['str']['time'] = rtrim($conv['str']['time'], '・');
			}

			// 曜日
			if (isset($_GET['week']) && count($_GET['week']) > 0){
				$_GET['week'] = array_filter($_GET['week'], 'strlen');
				$conv['str']['week'] = array_reduce($_GET['week'], function($v, $w){
					$codes = array('', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日', '日曜日', '祝日');
					return "{$v}{$codes[$w]}・";
				});
				$conv['str']['week'] = rtrim($conv['str']['week'], '・');
			}

			// 地名
			if (isset($_GET['area']) && $_GET['area'] != ''){
				$conv['str']['area'] = $_GET['area'];
			}

			// 徒歩
			if (isset($_GET['walk']) && $_GET['walk'] == 1){
				$conv['str']['walk'] = '徒歩5分以内';
			}

			// var_dump($conv);

			$this->conv = $conv;
			return $conv;
		}

		public function func_breadcrumb(){	// パンくずリストHTML生成 (ToDo Add more
			$list = '';
			$service = (isset($this->code['services']) && $this->code['services'] != '') ? $this->code['services'] : null;
			$list .= ($service) ? "<li><a href=\"/result/{$service['path']}/\">{$service['str']}</a></li>\n" : null;

			if ($this->uri == 'railway' || $this->uri == 'japan'){	// case of /railway/...
				$rel = ($this->uri == 'railway') ? '../../' : '../../../';
				$this->jwords['bread_Path'] = array_filter($this->jwords['bread_Path']);
				for($i = 0; $i < count($this->jwords['bread_Path']); $i++){
					$list .= "<li><a href=\"{$rel}{$this->jwords['bread_Path'][$i]}/\">{$this->jwords['bread_Str'][$i]}";
					$list .= ($this->uri == 'railway' && $i == 1) ? "駅" : null;
					$list .= "</a></li>\n";
					$rel = preg_replace('/^\.\.\//', '', $rel);
				}
				return $list;
			}
			elseif ($this->uri == 'general'){
				return "<li>検索結果</li>";
			}elseif ($this->uri == 'service'){
				return "<li><a href=\"/result/{$service['path']}/\">{$service['str']}</a></li>\n";
			}

		}

		public function getTitle(){	// titleタグの生成
			$service	= ($this->H1str[2] != '病院・クリニック') ? str_replace('病院・クリニック', '', $this->H1str[2]) : $this->H1str[2];
			$place		= (isset($this->H1str[1])) ? $this->H1str[1] : '';
			$feat			= (isset($this->H1str[0])) ? $this->H1str[0] : '';
			return $feat.$place.$service.'【エストドック】';
		}

		public function getH1(){	// h1タグの生成
			$place = '';
			if ($this->uri != 'general'){
				$featArr = json_decode(file_get_contents($this->_->class_dir. '/feat.json'), true);
				foreach ($featArr as $each){
					if ($each['id'] == @$_GET['feat'][0]){
						$this->H1str[0] = $each['parts'];
						break;
					}
				}

				$this->jwords['bread_Path'] = @array_filter($this->jwords['bread_Path']);
				for ($i = 0; $i < count($this->jwords['bread_Path']); $i++){
					$place .= $this->jwords['bread_Str'][$i];
					$place .= ($this->uri == 'railway' && $i == 1) ? "駅" : null;
				}

				if (count(@$this->jwords['bread_Str']) > 0){
					$p = array_filter($this->jwords['bread_Str']);
					$p = array_reverse($p);
					$this->place = @$p[0];
				}

				if ($this->uri == 'railway'){
					$this->place .= '駅の';
				}elseif ($this->place != ''){
					$this->place .= 'の';
				}

			}
			$this->H1str[1] = $this->place; //($this->place) ? $this->place. "の" : '';
			$this->H1str[2] = (isset($this->conv['str']['services'])) ? "{$this->conv['str']['services']}病院・クリニック" : '病院・クリニック';
			$this->H1str[2] = str_replace('歯科病院・クリニック', '歯科・歯医者', $this->H1str[2]);

			return array_reduce($this->H1str, function($v, $w){
				return "{$v}{$w}";
			});
		}

		public function getH2(){	// h2タイトルの生成
			return $this->getH1(). "を探す";
		}

		public function func_Img($j){
			// Get JSON
			$context = stream_context_create(array(
				'http' => array('ignore_errors' => true)
			));
			$jsonImg = json_decode(file_get_contents($this->_->api. "/hospital/image?publicId={$j['PublicId']}", false, $context), true);
			return (count($jsonImg) > 0) ?
				"<img src=\"{$jsonImg[0]['Url']}\" alt=\"{$j['HospitalName']}の画像です\" itemprop=\"image\">" :
				"<img src=\"/img/noimg.png\" alt=\"\">";
		}

	}

	$class = $_->device. '\Controller';
	$Controller = new $class($_);
	$templ = $Controller->exec();
}


/* Controller for SmartPhone */
namespace sp{
	require_once $_->class_dir. "/Pagenator.php";

	class Controller extends \Controller{

		protected function getHTML($json){
			// 検索緯度経度の取得
			$CondLat = $this->params['latitude'];
			$CondLng = $this->params['longitude'];

			$template = file_get_contents($this->_->parts_dir. '/result.php', false);

			/*
			 * 検索条件に該当する医療機関情報のリストを取得する
			 */
			$resultList = function($template, $json){
				$html = '';
				$markerLatLng = array();

				// 該当件数
				$query = http_build_query($this->params);
				$context = stream_context_create(array(
					'http' => array('ignore_errors' => true)
				));
				$jsonCount = json_decode(file_get_contents($this->_->api. "/t_hospital/search?{$query}&count=1", false, $context), true);


				for($i = 0, $length = count($json); $i < $length; $i++){
					$templ = $template;
					list($keys, $vals, $f) = array(array(), array(), array());

					// 関数を通して文字列の置換する
					$templ = str_replace('{{{func_Count}}}', ($i + 1), $templ);
					preg_match_all('/{{{(func_[a-zA-Z0-9]+)}}}/', $templ, $f);
					if ($f[0] != ''){
						foreach($f[1] as $ef){
							$templ = str_replace('{{{'. $ef. '}}}', $this->$ef($json[$i]), $templ);
						}
					}

					// 文字列の置換
					foreach($json[$i] as $key => $val){
						$keys[] = '{{'. $key. '}}';
						$vals[] = $val;
					}

					$html .= str_replace($keys, $vals, $templ);

					// マップ上のマーカーで使用する緯度経度JSON生成
					$markerLatLng[] = array(
						'no' => ($i + 1),
						'lat' => $json[$i]['Latitude'],
						'lng' => $json[$i]['Longitude'],
						'flg' => $json[$i]['Source']
					);
				}
				return array($html, $markerLatLng, $jsonCount[0]);
			};

			// 検索結果リストの生成
			$result = $resultList($template, $json);

			// Pagenation
			$pages = new Paginator();
			$pages->items_total = $result[2];
			$pages->paginate();

			// rel="prev/next"
			$prevPage = ($pages->current_page >= 0) ? ($pages->current_page - 1) : null;
			$nextPage = ($pages->current_page < $pages->num_pages) ? ($pages->current_page + 1) : null;
			$uri = $_SERVER['PHP_SELF'];
			$queryString = preg_replace('/offset=[0-9]+/', '', $_SERVER['QUERY_STRING']);
			$prevPage = ($prevPage != '') ? "<link rel=\"prev\" href=\"{$uri}?{$queryString}&offset={$prevPage}\">" : null;
			$nextPage = ($nextPage != '') ? "<link rel=\"next\" href=\"{$uri}?{$queryString}&offset={$nextPage}\">" : null;
			$condStr = (isset($this->code['str'])) ? array_reduce($this->code['str'], function($v, $w){ return "{$v}「{$w}」"; }) : null;


			// HTMLに書き出す要素の設定
			$content = array(
				'count' => number_format($result[2]),
				'CondLat' => $CondLat,
				'CondLng' => $CondLng,
				'resultList' => $result[0],
				'markerJson' => json_encode($result[1]),
				'breadcrumb' => $this->func_breadcrumb(),
				'condStr' => $condStr,
				'pagination' => $pages->display_pages(),
				'currentPage' => $pages->getCurrent(),
				'prevPage' => $prevPage,
				'nextPage' => $nextPage,
				'h2' => $this->getH2()
			);

			return $content;
		}

		public function func_Ppc($j){	// PPCの有無判定を通じたHTMLの生成
			return ($j['PpcPhone'] != '') ? "<button class=\"button navRsv ppc\">電話予約：{$j['PpcPhone']}（通話料無料）</button>" : null;
		}

		public function func_TimeTable($j){	// 空き枠へのボタンHTML生成
			switch ($j['Source']){
				case 'EST':
					return "<button class=\"button show_timeTable\" data-iid=\"{$j['PublicId']}\">本日空き枠あり<small>（空き枠を表示する）</small></button><br>";
					break;
				case 'EPARK':
					return "<a href=\"\" class=\"button navRsv\">ネット予約する<br><small>(別サイトに移動します)</small></a>";
			}
		}

		public function func_Service($j){	// 診療科目のHTML生成
			$str = str_replace(',', '、', $j['Services']);
			return ($str != '') ? "<dt>診療科目</dt><dd><span itemscope itemtype=\"http://schema.org/MedicalSpecialty\" itemprop=\"medicalSpecialty\">{$str}</span></dd>" : null;
		}

		public function func_Feature($j){	// 医院の特徴HTML生成
			$j['Keyword2'] = preg_replace('/-(,*)/', '', $j['Keyword2']);
			$str = str_replace(',', '、', $j['Keyword1']);
			$str.= str_replace(',', '、', $j['Keyword2']);
			$btn_readMore = (mb_strlen($str, 'utf-8') > 50) ? '<button class="button small readMore">もっと見る</button>' : null;
			return ($str != '') ? "<dt>特徴</dt>\n<dd class=\"comment\" data-num=\"50\">". mb_convert_kana($str, 'KV'). "</dd>$btn_readMore" : null;
		}

		public function func_Img($j){
			// Get JSON
			$context = stream_context_create(array(
				'http' => array('ignore_errors' => true)
			));
			$jsonImg = json_decode(file_get_contents($this->_->api. "/hospital/image?publicId={$j['PublicId']}", false, $context), true);
			return (count($jsonImg) > 0) ?
				"<img src=\"{$jsonImg[0]['Url']}\" width=\"90\" height=\"90\" class=\"hos_pic\" alt=\"{$j['HospitalName']}の画像です\" itemprop=\"image\">" :
				"<img src=\"/img/noimg.png\" width=\"90\" height=\"90\" class=\"hos_pic\" alt=\"\">";
		}
	}
}