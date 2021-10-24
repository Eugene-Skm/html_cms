<?php
class file_io{
    private $fp;
    
    function __confirm($fpath){
        if(!file_exists($fpath)){
            echo "file not exists";
        }else{
            $this->fp = $fpath;
        }
    }
    
    function replace($resoucefp){
        rename( $this->fp$resoucefp, "file-new.txt" )
    }
    
    function delete(){
        unlink($this->fp);
    }
    
    
}

?>