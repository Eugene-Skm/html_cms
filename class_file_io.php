<?php
class file_io{
    private $fp;
    private $tmpfp;
    function __construct($fpath){
        if(!file_exists($fpath)){
            $this->tmpfp = "./tmp/".basename($fpath);
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
    
    function write_content($contents){
        $contents = mb_convert_encoding($contents, "UTF-8");
        $filename=$this->tmpfp;

        $handle = fopen( $filename, 'w');
        fwrite( $handle, $contents);
        fclose( $handle );
    }
    function getcontent(){
        $filename = $this->tmpfp;
        $fp = fopen($filename, "r");
        $data = fread($fp, filesize($filename) );
        fclose($fp);

        return $data;
    }
    function merge(array $filelist){
        $data = "";
        $outpath =$this->tmpfp;
        foreach ($filelist as $file) {
            $filedata = file_get_contents($file);
            $data .= $filedata;
        }
        $flg= file_put_contents($outpath,$data);
        return $flg;
    }
}

?>