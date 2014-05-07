<?php // This is a controller of /doctor/reserve/complete.php
/* Controller for PC and Global NameSpace */
namespace{
	class Controller extends \ControllerAbstract{
		public function __construct($_){
			$this->_ = $_;
		}

		protected function getJSON(){
			session_start();
			// Parameter Check
			if (!isset($_POST['jeton']) || !isset($_SESSION['JETON']) || $_POST['jeton'] != $_SESSION['JETON']) throw new \Exception;
			session_destroy();

			// Mailを送る情報を取得
			return $json;
		}

		protected function getHTML($json){
			// Mailを送るよ
		}
	}


	$class = $_->device. '\Controller';
	$Controller = new $class($_);
	$templ = $Controller->exec();
}


/* Controller for SmartPhone */
namespace sp{
	class Controller extends \Controller{}
}