<?php // viewModel/Rlist/index.php
/* Controller for PC and Global NameSpace */
namespace{
	class Controller extends ControllerAbstract{
		public function __construct($_){
			$this->_ = $_;
		}

		protected function getJSON(){
			if (!isset($_GET['pref'])) throw new Exception;
			$param = ($_GET['pref'] > 0) ? "prefecture={$_GET['pref']}" : "";

			// Get JSON
			$json = (isset($_GET['lineId'])) ?
				json_decode(file_get_contents($this->_->api. "/station?lineIds={$_GET['lineId']}"), true) :
				json_decode(file_get_contents($this->_->api. "/line?{$param}"), true);

			return array(isset($_GET['lineId']), $json);
		}

		protected function getHTML($json){
			$contents[0] = $json[0];
			$json = $json[1];

			$contents[1] = ($contents[0]) ?
				array_reduce($json, function($k, $v){
					return "{$k}<li><a href=\"/result/all/{$v['PrefectureR']}/railway/{$v['LineNameR']}/{$v['StationNameR']}/\">{$v['StationName']}駅</a></li>\n";
				}) :
				array_reduce($json, function($k, $v){
					return "{$k}<li><a href=\"./{$v['LineNameR']}/\">{$v['LineName']}</a></li>\n";
				});

			$contents[2] = $json[0]['LineName'];

			return $contents;
		}
	}

	$prefs = array('',
		'北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県',
		'茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県',
		'新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県',
		'滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県',
		'徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県'
	);

	$class = $_->device. '\Controller';
	$Controller = new $class($_);
	$contents = $Controller->exec();
	$templ = (object)'';
	$templ->pref = $prefs[(int)$_GET['pref']];
	$templ->list = $contents[1];
	$templ->isStations = $contents[0];
	$templ->LineName = $contents[2];
}


/* Controller for SmartPhone */
namespace sp{
	class Controller extends \Controller{
		protected function getHTML($json){
			$contents[0] = $json[0];
			$json = $json[1];

			$contents[1] = ($contents[0]) ?
				array_reduce($json, function($k, $v){
					return "{$k}<a href=\"/result/all/{$v['PrefectureR']}/railway/{$v['LineNameR']}/{$v['StationNameR']}/\"><li>{$v['StationName']}駅</li></a>\n";
				}) :
				array_reduce($json, function($k, $v){
					return "{$k}<a href=\"./{$v['LineNameR']}/\"><li>{$v['LineName']}</li></a>\n";
				});

			$contents[2] = $json[0]['LineName'];

			return $contents;
		}
	}
}
