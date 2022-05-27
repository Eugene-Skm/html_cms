<?php
include("class_file_io.php");
$fname="";
$htmlcode="";
$cpage="";
$psum="";
	if(isset($_GET["cont"])){
		$fname = $_GET["fname"];   //URL パラメータ内　ファイル名
		$htmlcode =$_GET["cont"];  //URL パラメータ内　HTMLコンテンツ
		$cpage = $_GET["cpage"];   //URL パラメータ内　現在ページ
		$psum = $_GET["psum"];     //URL パラメータ内　ページ総数
	}
	$path_parts = pathinfo($fname);
	$tmpfname = $psum."-".$cpage."-".$path_parts['filename'].".txt";
	$filesio=new file_io($tmpfname);
	$filesio->write_content($htmlcode); //コンテンツを一時的に保存

	if($cpage==$psum){				//現在ページがページ総数と同一の場合
		merge_call($fname, $psum);	//保存したファイル全てをマージ
	}

function merge_call($fn,$p){ //分割保存されているコンテンツ内容結合処理
	$path_parts = pathinfo($fn);
	$fnames=[];
	for($r=1; $r<=$p; $r++){
		$tmpfname = $p."-".$r."-".$path_parts['filename'].".txt";
		array_push($fnames,$tmpfname);
	}
	$hex_data="";
	foreach( $fnames as $f){
		$fs = new file_io($f);
		$hex_content = $fs->getcontent();
		$hex_data= $hex_data.$hex_content;
		$fs->delete();
	}

	$fgets=new file_io("./data/profile.csv");
	$html_fpath= $fgets->get_type_of_folder_path("html");
	
	//$html_fpath="";

	$binarydata=hex2bin($hex_data);
	$new_fp=$html_fpath[0].$fn;
	$new_html = new file_io($fn);
	$new_html->write_content($binarydata);
	$new_html->replace($new_fp);
}

?>
