<?php
require_once('class_db_io.php');
require_once( "../script_svg_initialize.php" );

$tempfile="";
$filename="";
if(isset($_FILES[ 'file' ])){
    $tempfile = $_FILES[ 'file' ][ 'tmp_name' ];
    $Originalfilename = $_FILES[ 'file' ][ 'name' ]; //
    $filename=md5(uniqid(rand(),1)).".svg";
}

$furl = './original_svg/' . $filename;
if ( is_uploaded_file( $tempfile ) ) {
    if ( move_uploaded_file( $tempfile, $furl ) ) {
        echo $filename . "をアップロードしました。";
        initialize_svgcode( $filename );
    }
}

function initialize_svgcode( $fname ) {
    $svg_json = svg_to_json( $fname );
    //write_file($fname,$svg_json,"Ojson");
    
    $svg_array = json_to_array( $svg_json );
    $root = [ "ni" ];
    $tmpare = "svg";
    $id_seted_json = set_atribute_tag( "id", $tmpare, $svg_array );
    
    write_file($fname,json_to_svgstring($id_seted_json),"Esvg");
    write_file($fname,json_encode($id_seted_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),"Ejson");
    
    $connect= new connect();
    $connect->inset_svg( $fname, false, false);
}

function write_file($fname,$writedata,string $type){
    
    $ftype=["Esvg","Ejson","Ojson"];
    $fpath=["./edited_svg/","./edited_svg_json/","./original_svg_json/"];
    $fname = str_replace('.svg', '', str_replace('.json', '', $fname));
    
    if($type=="Esvg"){
        $fname.=".svg";
    }elseif($type=="Ejson"||$type=="Ojson"){
        $fname.=".json";
    }
    if($type=="Ejson"||$type=="Esvg"){
        $fname="E_".$fname;
    }
    $p=array_search($type,$ftype);
    
    ini_set('display_errors', 0);
    file_put_contents($fpath[$p].$fname, $writedata);
    ini_set('display_errors', 1);
    ob_start();  
}

?>