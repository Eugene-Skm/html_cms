<?php
include("./upload_svg.php");


function svg_to_json($fname){
	$rdfile = './svg/'.$fname;
		
	$svg = file_get_contents($rdfile);
	
	$domDocument = new DOMDocument();
	$domDocument->loadXML($svg);
	$xmlString = $domDocument->saveXML();
	$xmlObject = simplexml_load_string($xmlString);
	//XML To Json   JSON_PRETTY_PRINT　空白成形　JSON_UNESCAPED_UNICODE　日本語文字を文字で出す　JSON_UNESCAPED_SLASHES　スラッシュそのまま
	$json = json_encode( $xmlObject , JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES ) ;
	
	var_dump($json);
	
	return $json;
}

?>