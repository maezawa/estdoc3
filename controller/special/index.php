<?php // This is a controller of /special/index.php
/* Controller for PC and Global NameSpace */
namespace{
	class Controller extends ControllerAbstract{
		public function __construct($_){
			$this->_ = $_;
		}

		protected function getJSON(){
			if (!isset($_GET['id']) || $_GET['id'] == ''){
				header('Location:./list.php');
			}

			// Get JSON
			$featArr = json_decode(file_get_contents($this->_->class_dir. '/feat.json'), true);
			foreach ($featArr as $each){
				if ($each['id'] == $_GET['id']){
					break;
				}
			}

			$each['h1'] = "{$each['title']}の特集ページ";
			return $each;
		}

		protected function getHTML($json){
			return $json;
		}
	}

	$class = $_->device. '\Controller';
	$Controller = new $class($_);
	$templ = $Controller->exec();
}


/* Controller for SmartPhone */
namespace sp{
}
