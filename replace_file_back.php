<?php
include("./class_file_io.php");
$old_file="";
$new_file="";

$name="";
if(isset($_GET["old_file_path"])){
    $old_file= $_GET["old_file_path"];    
    $new_file= $_GET["new_file_path"];
    
    $fio = new file_io($new_file);
    if($fio->tmpcopy()){
        $fio->replace($old_file);
    }else{
        echo "error";
    }
}if(isset($_GET["del_file_path"])){
    $del_file= $_GET["del_file_path"];   
    $fio = new file_io($del_file);
    $fio->delete($old_file);
}



?>
