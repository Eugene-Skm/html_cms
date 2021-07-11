<?php
//header("Content-Type: text/javascript; charset=utf-8");
$st = "";
$st = "";
$flg="";
$result="";
if ( isset( $_GET[ "st" ] ) ) {
    $st = $_GET[ "st" ];
    $fnm = $_GET[ "fnm" ];

    $flg = copy( './edited_svg/E_'.$fnm.'.svg', './tmp/'.$fnm.'.svg' );
    copy( './edited_svg_json/E_'.$fnm.'.json', './tmp/'.$fnm.'.json' );
       
    if ( $flg ) {
            echo file_get_contents( './tmp/'.$fnm.'.svg' );
        } else {
            echo "failed";
        }
}

?>