<?php // viewModel/Tlist/index.php
/* Controller for PC and Global NameSpace */
namespace{
	class Controller extends ControllerAbstract{
		public function __construct($_){
			$this->_ = $_;
		}

		protected function getJSON(){
			if (!isset($_GET['id'])) throw new Exception;
			$param = "id={$_GET['id']}&level=1";

			// Get JSON
			$json	= json_decode(file_get_contents($this->_->api. "/addresss?{$param}"), true);//echo $this->_->api. "/addresss?{$param}";
			return $json;
		}

		protected function getHTML($json){
			$contents['prefecture']	= $json[0]['Prefecture'];
			$contents['li_lv2']			= "<li>{$contents['prefecture']}　市区町村一覧</li>";
			$contents['list']				=
				array_reduce($json, function($k, $v){
						return "{$k}<li><a href=\"/result/all/{$v['PrefectureRoma']}/{$v['CityRoma']}/\">{$v['City']}</a></li>\n";
					}
				);

			return $contents;
		}
	}

	$class = $_->device. '\Controller';
	$Controller = new $class($_);
	$templ = $Controller->exec();
}


/* Controller for SmartPhone */
namespace sp{
	class Controller extends \Controller{
		protected function getHTML($json){
			$contents['prefecture']	= $json[0]['Prefecture'];
			$contents['li_lv2']			= "<li>{$contents['prefecture']}　市区町村一覧</li>";
			$contents['list']				=
				array_reduce($json, function($k, $v){
						return "{$k}<a href=\"/result/all/{$v['PrefectureRoma']}/{$v['CityRoma']}/\"><li>{$v['City']}</li></a>\n";
					}
				);

			return $contents;
		}
	}
}