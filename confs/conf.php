<?php
abstract class ControllerAbstract{
	protected $_;

	abstract protected function getJSON();
	abstract protected function getHTML($json);

	public function __construct($_){
		$this->_ = $_;
	}

	public function exec(){
		try{
			return $this->getHTML($this->getJSON());
		}catch(Exception $e){
			header("HTTP/1.1 404 Not Found");
			echo "お探しのURLは存在しません。<br>\r\n";
			echo $_SERVER['SCRIPT_FILENAME'];
			exit;
		}
	}
}

$device				= (preg_match('/iPhone|iPod|Android|Windows.*Phone/', $_SERVER['HTTP_USER_AGENT'])) ? 'sp' : '';
$postfix			= (preg_match('/iPhone|iPod|Android|Windows.*Phone/', $_SERVER['HTTP_USER_AGENT'])) ? '/__sp' : '';
$postfix_doc	= (preg_match('/iPhone|iPod|Android|Windows.*Phone/', $_SERVER['HTTP_USER_AGENT'])) ? '/__sp' : '/htdocs';
$conf = array(
	'develop' => array(
		'http'	=>	'http://localhost',
		'api'		=> 'http://api.estdoc.jp',
		'base_dir'	=>	'/Users/estdocuser/estdoc2',
		'class_dir'	=>	'/Users/estdocuser/estdoc2/confs',
		'parts_dir'	=>	'/Users/estdocuser/estdoc2/parts'. $postfix,
		'htdocs'				=>	'/Users/estdocuser/estdoc2/htdocs',
		'controller'		=>	'/Users/estdocuser/estdoc2/controller',
		'device'				=> $device
	),
	'product' => array(
		'http'	=> 'http://estdoc.jp',
		'api'		=> 'http://api.estdoc.jp',
		'base_dir'	=>	'/home/est',
		'class_dir'	=>	'/home/est/confs',
		'parts_dir'	=>	'/home/est/parts'. $postfix,
		'htdocs'				=>	'/home/est/htdocs',
		'controller'		=>	'/home/est/controller',
		'device'				=> $device
	)
);

$_ = (object)$conf['develop'];
//$_ = (object)$conf['product'];


// API Server Connection Check
//$fp = @fsockopen($_->api, 80, $errno, $errmsg, 50);
//if (!$fp){
//	header("HTTP/1.1 503 Service Temporarily Unavailable");
//	echo "API Server doesn't response.";
//	exit;
//}
//fclose($fp);

$file = preg_replace("#{$_->htdocs}|__sp/#", '', $_SERVER['SCRIPT_FILENAME']);
$_->serviceMaster = json_decode(file_get_contents($_->class_dir. '/services.json'));
$_->featMaster		= json_decode(file_get_contents($_->class_dir. '/feat.json'));
if (file_exists($_->controller. $file)) require_once($_->controller. $file);

