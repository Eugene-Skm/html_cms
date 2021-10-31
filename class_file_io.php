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
        return $this->tmpfp;
    }
    
    function tmpcopy(){
        $original_fp=$this->tmpfp;
        
        $pathData = pathinfo( $this->tmpfp );
        $this->tmpfp = $pathData["dirname"]."/tmp_".basename($this->tmpfp);
        $flg = copy($original_fp, $this->tmpfp );
        return $flg;
    }
    
    function replace($newpath){
        $flg = rename( $this->tmpfp, $newpath );
        return $flg;
    }
    
    function delete(){
        $flg = unlink($this->tmpfp);
        return $flg;
    }
    
    
}

?>