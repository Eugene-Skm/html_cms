<?php
include( "./svg_editor.php" );
$tempfile="";
$filename="";
if(isset($_FILES[ 'file' ])){
    $tempfile = $_FILES[ 'file' ][ 'tmp_name' ];
    $filename = $_FILES[ 'file' ][ 'name' ];
}

$furl = './svg/' . $filename;
if ( is_uploaded_file( $tempfile ) ) {
    if ( move_uploaded_file( $tempfile, $furl ) ) {
        echo $filename . "をアップロードしました。";

        initialize_svgcode( $filename );
    }
}

function initialize_svgcode( $fname ) {
    $svg_json = svg_to_json( $fname );
    $svg_array = json_to_array( $svg_json );
    $root = [ "ni" ];
    $tmpare = "svg";
    $id_seted_json = set_atribute_tag( "id", $tmpare, $svg_array );
    $res_seted_json = set_atribute_tag( "res", $tmpare, $id_seted_json , "hello" );
    
    //echo( "<pre>" );
    //var_dump( json_encode( $res_seted_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) );
    write_file(json_to_svgstring($res_seted_json),"svg");
   var_dump(json_to_svgstring($res_seted_json));
    //echo( "</pre>" );
    
}

function write_file($writedata,string $type){
    $fname=md5(uniqid(rand(),1));
    $fpath="./edited_svg/";
    file_put_contents($fpath.$fname.".svg", $writedata);
}



?>