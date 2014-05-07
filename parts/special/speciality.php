<?php
$html ='';
$templ['id'] = preg_replace('/E/', '', $templ['id']);
foreach($_->serviceMaster as $v){
	$html .= "<li><a href=\"/special/{$templ['url']}/{$v->Url}/\">{$v->Care}</a></li>\n";
}
echo $html;
?>