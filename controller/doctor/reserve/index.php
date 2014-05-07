<?php // This is a controller of /doctor/reserve/index.php
/* Controller for PC and Global NameSpace */
namespace{
	class Controller extends \ControllerAbstract{
		public function __construct($_){
			$this->_ = $_;
			$this->week = array('日', '月', '火', '水', '木', '金', '土');
		}

		protected function getJSON(){
			// Parameter Check
			//var_dump($_GET);
			if (!isset($_GET['publicId']) || !isset($_GET['dt'])) throw new \Exception;
			if (!preg_match('/20[0-9]{2}\/[0-1][0-9]\/[0-3][0-9] [0-2][0-9]:[0-9]{2}/', $_GET['dt'])) throw new \Exception;

			// Get JSON
			if (1){
				$jsonHospital = json_decode(file_get_contents($this->_->api. "/hospital?publicId={$_GET['publicId']}"), true);//echo $this->_->api. "/hospital?id={$_GET['publicId']}";
				$hopitalName = $jsonHospital[0]['HospitalName'];
				$reserveUnixTime = strtotime($_GET['dt']);
				$formatedReserveDT  = date('Y年m月d日', $reserveUnixTime);
				$formatedReserveDT .= "(". $this->week[date('w', $reserveUnixTime)]. ")";
				$formatedReserveDT .= date(' H時i分', $reserveUnixTime);
			}
			$json = array(
				'hopitalName' => $hopitalName,
				'reserveDT'		=> $_GET['dt'],
				'reserveUnixTime'	=> $reserveUnixTime,
				'formatedReserveDT' => $formatedReserveDT
			);

			$json = array_merge($json, $jsonHospital[0]);
			return (object)$json;
		}

		protected function getHTML($json){
			function getAccessStr($line, $station, $from){
				$st = ($line. $station != '') ? "{$line}{$station}" : "";
				$fr = ($from != '') ? "から約{$from}分<br>" : "";
				return $st. $fr;
			}

			$json->access = array(
				getAccessStr($json->Line1, $json->Station1, $json->FromStation1),
				getAccessStr($json->Line2, $json->Station2, $json->FromStation2),
				getAccessStr($json->Line3, $json->Station3, $json->FromStation3),
				getAccessStr($json->Line4, $json->Station4, $json->FromStation4),
				getAccessStr($json->Line5, $json->Station5, $json->FromStation5)
			);
			return $json;
		}
	}

	session_start();
	$bytes = openssl_random_pseudo_bytes(16);
	$_SESSION['JETON'] = bin2hex($bytes);

	$class = $_->device. '\Controller';
	$Controller = new $class($_);
	$templ = $Controller->exec();
}


/* Controller for SmartPhone */
namespace sp{
	class Controller extends \Controller{}
}