<?php

global $tag_count;
$tag_count=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];


function svg_to_json($fname){
	$rdfile = './svg/'.$fname;
		
	$svg = file_get_contents($rdfile);
	
	$domDocument = new DOMDocument();
	$domDocument->loadXML($svg);
	$xmlString = $domDocument->saveXML();
	$xmlObject = simplexml_load_string($xmlString);
	//XML To Json   JSON_PRETTY_PRINT　空白成形　JSON_UNESCAPED_UNICODE　日本語文字を文字で出す　JSON_UNESCAPED_SLASHES　スラッシュそのまま
	//Json扱い　https://syncer.jp/how-to-use-json
	$json = json_encode( $xmlObject , JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES ) ;
	
	
	//array_key使い方詳細　https://www.sejuku.net/blog/22704
	/*$x=json_to_array($json);
	var_dump($x[array_keys($x)]);
	
	var_dump(count($x[0]));*/
	
	return $json;
}

function json_to_array($svgjsondata){
	return json_decode( $svgjsondata , true ) ;
}
function is_vector(array $arr) {
  return array_values($arr) === $arr;
}

function set_atribute_tag($tag,&$parent,&$dataarray,&$root){
	var_dump($parent." 2 ewwe");
	$flg=false;
	//再起処理を扱う　無限ループにならないように慎重に
	//var_dump($dataarray);
	$array_keys=array_keys($dataarray);
	$roots=[$root];
	foreach($array_keys as $keys => $key){
		//var_dump(count($roots));
		$roots[count($roots)-1]=$key;
		echo("<pre>");
		//var_dump($key);
		if(is_array($dataarray[$key])){
			if(!is_int($key)){
				if(array_key_exists($tag,$dataarray[$key])){//var_dump($dataarray);
					list($elementname,$ele_count)=tag_judge($key,$parent);
					$dataarray[$key][$tag]=$elementname."-".$GLOBALS["tag_count"][$ele_count];	
				}else{
					list($elementname,$ele_count)=tag_judge($key,$parent);
					//先頭にあらたにタグ値を追加
					array_unshift($dataarray[$key], $elementname."-".$GLOBALS["tag_count"][$ele_count]);

					//先頭の要素のタグ値のキーを「0」から＄tag内容に変更
					$a=array_keys($dataarray[$key]);
					$a[0]=$tag;
					$b=array_values($dataarray[$key]);
					$dataarray[$key]=array_combine($a,$b);

				}
			}else{
				$flg=true;
			}
			$tmp_key="";
			foreach(array_keys($dataarray[$key]) as &$child_key){
				//var_dump($dataarray[$key][$child_key]);
				if(is_array($dataarray[$key][$child_key])){
					//var_dump($key);
					
					if($flg){
						$tmp_key=$parent;
						$flg=false;
					}else{
						$tmp_key=$key;
					}
					
					var_dump($parent." ewwe");
					set_atribute_tag($tag,$tmp_key,$dataarray[$key],$roots);
					
				}
			}
		}
		
	}
		//var_dump($dataarray);
		//var_dump($roots);
	echo("</pre>");
	return($dataarray);
}
function tag_judge($key1,$pare){
	var_dump($pare);
	$tag_info=["rect","circle","ellipse","line","polyline","polygon","path","text","image","text","a","g","defs","style","svg","pattern","mask","clipPath","ND","@attributes","top"];
	$nkey=$key1;
	if($pare=="svg"&&$key1!="@attributes"){
		$nkey="top";
	}elseif($pare=="svg"&&$key1=="@attributes"){
		$nkey="svg";
	}elseif(($pare!="svg"||ctype_digit($key1)&&$key1=="@attributes")){
		$nkey=$pare;
	}
	var_dump($pare." && ".$key1." = ".$nkey);
	
	$place=array_search($nkey,$tag_info);
	$GLOBALS["tag_count"][$place]++;
	
	return [$tag_info[$place],$place];
	
}


?>