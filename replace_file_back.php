<?php
include("./class_file_io.php");
$old_file="";
$new_file="";

$name="";
if(isset($_GET["old_file_path"])){
    $old_file= $_GET["old_file_path"];    
    $new_file= $_GET["new_file_path"];
}
var_dump($new_file);
$fio = new file_io($new_file);
if($fio->tmpcopy()){
    $fio->replace($old_file);
}else{
    echo "error";
}

?>
