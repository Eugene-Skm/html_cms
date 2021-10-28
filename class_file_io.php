<?php
class file_io{
    private $fp;
    private $tmpfp;
    function __construct($fpath){
        if(!file_exists($fpath)){
            echo "file not exists";
        }else{
            $this->tmpfp = $fpath;
        }
    }
    
    function tmpcopy(){
        $original_fp=$this->tmpfp;
        
        $pathData = pathinfo( $this->tmpfp );
        $this->tmpfp = $pathData["dirname"]."/tmp_".basename($this->tmpfp);
        $flg = copy($original_fp, $this->tmpfp );
          if ($flg) {
            return true;
          } else {
            return false;
          }
    }
    
    function replace($newpath){
        rename( $this->tmpfp, $newpath );
    }
    
    function delete(){
        unlink($this->tmpfp);
    }
    
    
}

?>