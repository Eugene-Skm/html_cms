<?php
include("class_file_io.php");
$fname="";
$htmlcode="";
$cpage="";
$psum="";
	if(isset($_GET["cont"])){
		$fname = $_GET["fname"];
		$htmlcode =$_GET["cont"];
		$cpage = $_GET["cpage"];
		$psum = $_GET["psum"];
	}
	$path_parts = pathinfo($fname);
	$tmpfname = $psum."-".$cpage."-".$path_parts['filename'].".txt";
	$hex =hex2bin($_GET["cont"]);
	var_dump($_GET["cont"], $hex);
	$filesio=new file_io($tmpfname);
	$filesio->write_content($htmlcode);
	if($cpage==$psum){
		merge_call($fname, $psum);
	}

function merge_call($fn,$p){
	//$filesset=new file_io(str_replace($fn,"html",".text"));
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
	$binarydata=hex2bin($hex_data);
	$new_fp='./testHTML/test-' .$fn;
	$new_html = new file_io($fn);
	$new_html->write_content($binarydata);
	$new_html->replace($new_fp);
}

?>