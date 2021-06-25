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
	set_shapeid($svg_json);
}

function set_shapeid($svjsondata){
	
}


?>