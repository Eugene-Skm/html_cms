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

function set_atribute_tag($tag,&$parent,&$dataarray,$pointer){
	$flg=false;
	//再起処理を扱う　無限ループにならないように慎重に
	$array_keys=array_keys($dataarray);
	
	
	/*
	
	if($pointer!="null"){
		while($array_keys[0]==$pointer){
			array_shift($array_keys);
		}
	}
	
	
	echo("<pre>");
	var_dump($array_keys);
	echo("</pre>");
	*/
	foreach($array_keys as $keys => $key){
		//$roots[count($roots)-1]=$key;
		if(is_array($dataarray[$key])){
			//キーが数字でない場合 連想配列[0],[1]...避け
			if(!is_int($key)){
				if(array_key_exists($tag,$dataarray[$key])){
					//$tagに該当する属性が発見された場合
					list($elementname,$ele_count)=tag_judge($key,$parent);
					$dataarray[$key][$tag]=$elementname."-".$GLOBALS["tag_count"][$ele_count];	
				}elseif(!array_key_exists($tag,$dataarray[$key])){
					//$tagの属性が無い場合
					list($elementname,$ele_count)=tag_judge($key,$parent);
					//先頭にあらたにタグ値を追加
					array_unshift($dataarray[$key], $elementname."-".$GLOBALS["tag_count"][$ele_count]);
					
					//先頭の要素のタグ値のキーを「0」から＄tag内容に変更
					$a=array_keys($dataarray[$key]);
					$a[0]=$tag;
					$b=array_values($dataarray[$key]);
					$dataarray[$key]=array_combine($a,$b);
				}
				echo("<pre>");
				//var_dump($dataarray);
				echo("</pre>");
			}else{
				$flg=true;
			}
			$tmp_key="";
			$flg_for_roop_check=true;
			//子要素取得のための再起実行用ループ
			//foreach(array_keys($dataarray[$key]) as &$child_key){
				//下の階層が複数要素を持つ配列の場合
			//array_keys($dataarray[$key])
				if(is_array($dataarray[$key])){
					//自分の階層の親が数値配列の場合　親キーは一つ飛ばした上の階層になる。　
					//ただしこの処理はSVGでのみ有効 rect>0>@attributes rect>1>@attributes
					
					if($flg){
						$tmp_key=$parent;
						$flg=false;
					}else{//それ以外の場合渡すキーはそのままループ中のキー
						$tmp_key=$key;
					}
					//var_dump($key."=".$parent."#".$tmp_key);
					//キー値が「0」数値型複数配列の場合　同じ要素を何週もカウントしてしまう・　
					//それを避けるため、数値配列階層の場合は初回実行時のみ再起処理
					/*if(!is_int($child_key)){
						set_atribute_tag($tag,$tmp_key,$dataarray[$key],$child_key);	
					}if(is_int($child_key)){*/
						//if($flg_for_roop_check){
							set_atribute_tag($tag,$tmp_key,$dataarray[$key],"null");	
							//$flg_for_roop_check=false;
						//}
					//}
				}
			//}
		}
	}
	return($dataarray);
}
//タグ判定とカウント
function tag_judge($key1,$pare){
	$tag_info=["rect","circle","ellipse","line","polyline","polygon","path","text","image","text","a","g","defs","style","svg","pattern","mask","clipPath","ND","@attributes","top"];
	$nkey=$key1;
	
	if($pare=="svg"&&$key1!="@attributes"){
		//もっとも最上層に君臨している属性たちはTopに当たる
		$nkey="top";
	}elseif($pare=="svg"&&$key1=="@attributes"){
		//もっとも最上層の@attributesはSVGそのもののため
		$nkey="svg";
	}elseif($pare!="svg"){
		//それ以外の要素は親要素のキーがidに入る　rect>@attributesの場合＠attributesはrectなのでrect1
		$nkey=$pare;
	}
	var_dump($pare ." & ".$key1." = ".$nkey);
	//判定配列から位置検索
	$place=array_search($nkey,$tag_info);
	//タグの数を係数
	$GLOBALS["tag_count"][$place]++;
		
	return [$tag_info[$place],$place];
	
}


?>