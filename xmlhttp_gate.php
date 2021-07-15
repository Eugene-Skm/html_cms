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

    $jsonedit = new JSONEDIT( $fnm . '.json' );
    $jsonedit->get_attributes( $id );

    if ( $st == "ini" ) {
       /* $flg = copy( './edited_svg_json/E_' . $fnm . '.json', './tmp/' . $fnm . '.json' );
        $flg = copy( './edited_svg/E_' . $fnm . '.svg', './tmp/' . $fnm . '.svg' );*/
        $flg=true;
    } elseif ( $st == "upd" ) {
        $flg=$jsonedit->val_change( $val, $tag );
        
    } elseif ( $st == "ged" ) {
        $tags = $jsonedit->get_tag();
        $flg = true;
    }elseif( $st=="cls" ){
        $flg=$jsonedit->close();
    }
    if ( $flg ) {
        if($st=="ged"){
            //echo $st;
            echo json_encode($tags, JSON_PRETTY_PRINT| JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }else{
            //echo $st;
            echo  file_get_contents( './tmp/' . $fnm . '.svg' );
        }
        
    } else {
        echo "failed";
    }
}

?>