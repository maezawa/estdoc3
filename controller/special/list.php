<?php // This is a controller of /special/index.php
/* Controller for PC and Global NameSpace */
namespace{
	class Controller extends ControllerAbstract{
		public function __construct($_){
			$this->_ = $_;
		}

		protected function getJSON(){
			return $this->_->featMaster;
		}

		protected function getHTML($json){
			return array_reduce($json, function($v, $w){
				return "{$v}<li><a href=\"{$w->url}/\">{$w->title}</a></li>\n";
			});
		}
	}

	$class = $_->device. '\Controller';
	$Controller = new $class($_);
	$templ = $Controller->exec();
}


/* Controller for SmartPhone */
namespace sp{
}
