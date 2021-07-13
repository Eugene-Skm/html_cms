<?php
//header("Content-Type: text/javascript; charset=utf-8");
include("./class_json_edit.php");
$st = "";
$flg="";
$tag="";
$val="";
$result="";
if ( isset( $_GET[ "st" ] ) ) {
    
    $st = $_GET[ "st" ];
    $fnm = $_GET[ "fnm" ];
    if($st=="upd"){
        $tag = $_GET[ "tag" ];
        $val = $_GET[ "val" ];    
        $id = $_GET[ "id" ];    
    }
    
    
    file_put_contents("./logfile.txt", $st . PHP_EOL, FILE_APPEND);
    if($st=="ini"){
        
       file_put_contents("./logfile.txt", "value" . PHP_EOL, FILE_APPEND);
       $flg= copy( './edited_svg_json/E_'.$fnm.'.json', './tmp/'.$fnm.'.json' );
    }elseif($st=="upd"){
        file_put_contents("./logfile.txt", "upd" . PHP_EOL, FILE_APPEND);
        $jsonedit = new JSONEDIT($fnm.'.json');
        $jsonedit->get_attributes($id);
        $jsonedit->val_change($val, $tag);
        $flg=true;
    }
       
    if ( $flg ) {
        var_dump("A");
            echo file_get_contents( './tmp/'.$fnm.'.svg' );
        } else {
            echo "failed";
        }
}

?>