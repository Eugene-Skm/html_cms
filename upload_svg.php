<?php
include("./svg_editor.php");

$tempfile = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];
$furl='./svg/'.$filename;

if (is_uploaded_file($tempfile)) {
    if (move_uploaded_file($tempfile, $furl)) {
        echo $filename . "をアップロードしました。";
		
		initialize_svgcode($filename);
    }
}

function initialize_svgcode($fname){
	$svg_json=svg_to_json($fname);
	$svg_array=json_to_array($svg_json);
	
	var_dump($svg_array);
	$root=["ni"];
	$tmpare="svg";
	$id_seted_json=set_atribute_tag("id",$tmpare, $svg_array,$root);
	echo("<pre>");
	var_dump(json_encode( $id_seted_json , true ));
	echo("</pre>");
}



?>