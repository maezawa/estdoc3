<?php // This is a controller of /feedback.php
/* Controller for PC and Global NameSpace */
namespace{

	class Controller extends \ControllerAbstract{

		public function __construct($_){
			$this->_ = $_;
		}

		protected function getJSON(){
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Send Mail
				mb_language("Japanese");
				mb_internal_encoding("UTF-8");

				$to = 'help@estdoc.jp';
				$name = mb_encode_mimeheader(htmlspecialchars($_POST['name'], ENT_QUOTES), "ISO-2022-JP");
				$fromAddress = $_POST['email'];
				$subject = mb_encode_mimeheader(htmlspecialchars($_POST['subject'], ENT_QUOTES), "ISO-2022-JP");
				$body = htmlspecialchars($_POST['contents'], ENT_QUOTES);
				$addHeader = "From: <{$name}>{$fromAddress}\n";
				$addHeader.= "Reply-To: help@estdoc.jp\n";
				$addHeader.= "X-Mailer: estdoc mail\n";
				$addHeader.= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";

				mail($to, $subject, $body, $addHeader);
				return true;
			}else{
				return false;
			}
		}


		protected function getHTML($isPost){
			return $isPost;
		}

	}

	$class = $_->device. '\Controller';
	$Controller = new $class($_);
	$templ = $Controller->exec();
}


/* Controller for SmartPhone */
namespace sp{

	class Controller extends \Controller{
	}
}