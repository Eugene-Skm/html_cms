<?php
//header("Content-Type: text/javascript; charset=utf-8");
$st = "";
$st = "";
$flg="";
if ( isset( $_GET[ "st" ] ) ) {
    $st = $_GET[ "st" ];
    $fnm = $_GET[ "fnm" ];

    if ( $st == "initialized" ) {
        $flg = copy( './original_svg/'.$fnm.'.svg', './tmp/'.$fnm.'.svg' );
        
    } else {
        $flg = copy( './edited_svg/'.$fnm.'.svg', './tmp/'.$fnm.'.svg' );
    }
    if ( $flg ) {
            echo "succcess";
        } else {
            echo "failed";
        }


}

?>