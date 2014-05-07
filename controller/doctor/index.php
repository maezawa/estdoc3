<?php // This is a controller of /doctor/index.php
/* Controller for PC and Global NameSpace */
namespace{
	class Controller extends \ControllerAbstract{
		public function __construct($_){
			$this->_ = $_;
		}

		protected function getJSON(){
			if (!isset($_GET['id'])) throw new Exception;
			$param = $_GET['id'];

			// Get JSON And Return as JSON
			$json	  = json_decode(file_get_contents($this->_->api. "/hospital_union?id={$param}"), false);	// Todo: change refer id to Public_Id
			//echo $this->_->api. "/hospital_union/?id={$param}";
			$jsonDr = json_decode(file_get_contents($this->_->api. "/doctor?hospitalId={$param}"), true);
			//echo $this->_->api. "/doctor?hospitalId={$param}";

			if (count($json) == 1){
				return array($json[0], $jsonDr);
			}else{
				throw new Exception;
			}
		}

		protected function getHTML($json){
			list($templ, $doctor) = $json;

			function getAccessStr($line, $station, $from){
				$st = ($line. $station != '') ? "{$line}{$station}" : "";
				$fr = ($from != '') ? "から約{$from}分<br>" : "";
				return $st. $fr;
			}

			$days = array(
				preg_split('/,/', $templ->HourMon, -1, PREG_SPLIT_NO_EMPTY),
				preg_split('/,/', $templ->HourTues, -1, PREG_SPLIT_NO_EMPTY),
				preg_split('/,/', $templ->HourWed, -1, PREG_SPLIT_NO_EMPTY),
				preg_split('/,/', $templ->HourThurs, -1, PREG_SPLIT_NO_EMPTY),
				preg_split('/,/', $templ->HourFri, -1, PREG_SPLIT_NO_EMPTY),
				preg_split('/,/', $templ->HourSat, -1, PREG_SPLIT_NO_EMPTY),
				preg_split('/,/', $templ->HourSun, -1, PREG_SPLIT_NO_EMPTY),
				preg_split('/,/', $templ->HourHoliday, -1, PREG_SPLIT_NO_EMPTY)
			);

			// 半角カナ→全角カナ変換
			$templ->Keyword2 = mb_convert_kana($templ->Keyword2, 'KV', 'utf-8');

			// 画像
			$templ->Img = $this->func_Img($json);

			// 診療時間の、表示のためのデータ変換
			$templ->q = array_map(function($a, $b, $c, $d, $e, $f, $g, $h){
					return array($a, $b, $c, $d, $e, $f, $g, $h);
				},
				$days[0], $days[1], $days[2], $days[3], $days[4], $days[5], $days[6], $days[7]
			);

			$templ->access = array(
				getAccessStr($templ->Line1, $templ->Station1, $templ->FromStation1),
				getAccessStr($templ->Line2, $templ->Station2, $templ->FromStation2),
				getAccessStr($templ->Line3, $templ->Station3, $templ->FromStation3),
				getAccessStr($templ->Line4, $templ->Station4, $templ->FromStation4),
				getAccessStr($templ->Line5, $templ->Station5, $templ->FromStation5)
			);

			// 診療時間のhtmlコード生成
			$templ->consultationHours = <<<EOF
<table id="consultationHours">
<caption><h3>基本診療時間</h3></caption>
<thead>
<tr>
	<th>月</th>
	<th>火</th>
	<th>水</th>
	<th>木</th>
	<th>金</th>
	<th>土</th>
	<th>日</th>
	<th>祝</th>
</tr>
</thead>
<tbody>

EOF;

			$templ->consultationHours .=
				array_reduce($templ->q, function($v, $w){
					return $v. '<tr itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification">'.
					array_reduce($w, function($k, $v){
						$a = "{$k}\n\t<td>";

						try{
							if ($v){
								if (!preg_match('/[^0-9:]/', $v)) throw new Exception;
								list($open, $close) = preg_split('/[^0-9:]/', $v, -1, PREG_SPLIT_NO_EMPTY);
								$a .= "<time itemprop=\"opens\" datetime=\"{$open}\">{$open}</time>〜<time itemprop=\"closes\" datetime=\"{$close}\">{$close}</time>";
							}else{
								$a .= "休診";
							}
						}catch (Exception $e){
							$a .= "<!-- invalid format -->";
						}

						$a .= "</td>";
						return $a;
					}). "</tr>\n";
				});

			$templ->consultationHours .= <<<EOF
</tbody>
</table>
EOF;
			return array($templ, $doctor);
		}


		public function func_Img($j){
			$imgHtml = '';

			// Get JSON
			$context = stream_context_create(array(
				'http' => array('ignore_errors' => true)
			));
			if (isset($j[0]->PublicId) && $j[0]->PublicId != ''){
				$jsonImg = json_decode(file_get_contents($this->_->api. "/hospital/image?publicId={$j[0]->PublicId}", false, $context), true);
				if (count($jsonImg) > 0){
					$imgHtml = array_reduce($jsonImg, function($v, $w){
						return "{$v}\n<li><img src=\"{$w['Url']}\" width=\"180\" height=\"180\" alt=\"{$w['HospitalName']}の画像です\" itemprop=\"image\"></li>";
					});
				}
			}

			return ($imgHtml) ?: "<img src=\"/img/noimg.png\" width=\"180\" height=\"180\" alt=\"\">";
		}
	}


	$class = $_->device. '\Controller';
	$Controller = new $class($_);
	list($templ, $doctor) = $Controller->exec();
}


/* Controller for SmartPhone */
namespace sp{
	class Controller extends \Controller{
		public function func_Img($j){
			// Get JSON
			$context = stream_context_create(array(
				'http' => array('ignore_errors' => true)
			));

			if (isset($j[0]->PublicId) && $j[0]->PublicId != ''){
				$jsonImg = json_decode(file_get_contents($this->_->api. "/hospital/image?publicId={$j[0]->PublicId}", false, $context), true);
				if (count($jsonImg) > 0){
						return "<img src=\"{$jsonImg[0]['Url']}\" width=\"90\" height=\"90\" alt=\"{$jsonImg[0]['HospitalName']}の画像です\" itemprop=\"image\">";
				}
			}
		}
	}
}