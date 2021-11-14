<?php
include( "./class_json_edit.php" );
ini_set('display_errors',1);
$st = "";
$flg = "";
$tag = "";
$val = "";
$id = "";
$result = "";
if ( isset( $_GET[ "st" ] ) ) {
    $st = $_GET[ "st" ];
    $fnm = $_GET[ "fnm" ];
    if ( $st == "upd" ) {
        $id = $_GET[ "id" ];
        $tag = $_GET[ "tag" ];
        $val = $_GET[ "val" ];
    } elseif( $st == "ged" ) {
        $id = $_GET[ "id" ];
    }
    $filename =pathinfo($fnm);
    $jsonedit = new JSONEDIT( $fnm);
    $jsonedit -> get_attributes( $id );

    if ( $st == "ini" ) {
        $flg=true;
    } elseif ( $st == "upd" ) {
        $flg = $jsonedit -> val_change( $val, $tag );
    } elseif ( $st == "ged" ) {
        $tags = $jsonedit -> get_tag();
        $flg = true;
    }elseif( $st == "cls" ){
        $flg = $jsonedit -> close();
    }
    usleep(10);
    if ( $flg ) {
        
        if($st=="ged"){
            echo json_encode($tags, JSON_PRETTY_PRINT| JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }else if ($st!="cls"){
            echo file_get_contents( "./tmp/".$filename['basename'] );
        }
        
    } else {
        echo "failed";
    }
}

?>