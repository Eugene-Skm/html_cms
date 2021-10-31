<?php
include("./class_file_io.php");
$old_file="";
$new_file="";
$result="";
$name="";
if(isset($_GET["old_file_path"])){
    $old_file= $_GET["old_file_path"];    
    $new_file= $_GET["new_file_path"];
    
    $fio = new file_io($new_file);
    if($fio->tmpcopy()){
       $result= $fio->replace($old_file);
    }else{
        echo "error";
    }
}if(isset($_GET["del_file_path"])){
    $del_file= $_GET["del_file_path"];   
    $fio = new file_io($del_file);
    $result = $fio->delete($old_file);
}
if($result){
    echo "success!!";
}else{
    echo "uncompleted!";
}

?>
<!doctype html>
<html>
    <head>
        <script type="text/javascript" >
        
            setTimeout(function(){
                window.close();
            },1000);
        </script>

    </head>
    <body>
        
    </body>
</html>
