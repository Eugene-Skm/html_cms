<?php
include("./script_svg_initialize.php");
/**
* 1$jsonedit = new JSONEDIT("ファイル名(拡張子付き)")
* 2$jsonedit->get_attributes($id);
* 3jsonedit->val_change($value, $tag); 
* 3jsonedit->tag_del( $tag );
* 
* 三項演算子　今度試し
* $jsonedit->tag_exist($tag) ? jsonedit->val_change($value) : jsonedit->tag_add($value)
* $jsonedit->tag_exist($tag) ? jsonedit->tag_del()
*/
class JSONEDIT {
    private $target_json;
    private $assosiative_array;
    private $target_attributes; //参照渡し出来るか
    private $target_tag;
    private $target;
    private $target_keys;
    private $tname;
    private $filename;
    function __construct( $jname ) {
        //var_dump($jname);
        $this->filename =pathinfo($jname);
        $this->tname=$this->filename['filename'] . '.json';
        $url = "./tmp/" . $this->tname;
        $this->target_json = file_get_contents( $url );
        $this->assosiative_array = json_decode( $this->target_json, true );
         $this->target_attributes=& $this->assosiative_array;
    }
    public function get_attributes( $id ) {
        //各Attributes編集保存時に毎回呼び出される
        //返り値保存先は$target_attributes_key;

            $end_flg=false;    
        
        $arraydata = & $this->target_attributes;
        $arraykeys = array_keys( $arraydata );

        foreach ( $arraykeys as $keys => $key ) {
            if ( is_array( $arraydata[ $key ] ) ) {
                if ( $key === "@attributes" ) {                    
                    if($arraydata['@attributes']['id']==$id){
                        //var_dump($id);
                        $this->target=& $arraydata['@attributes'];
                        $this->target_keys= array_keys( $arraydata['@attributes'] );
                        $end_flg=true;
                    }
                }
                if($end_flg===false){
                    $this->target_attributes=& $arraydata[$key];
                    $this->get_attributes( $id );
                }       
            }
        }
    }
    private $idlist=array();
    public function get_allid() {
        //各Attributes編集保存時に毎回呼び出される
        //返り値保存先は$target_attributes_key;
        $arraydata = & $this->target_attributes;
        $arraykeys = array_keys( $arraydata );

        foreach ( $arraykeys as $keys => $key ) {
            if ( is_array( $arraydata[ $key ] ) ) {
                if ( $key === "@attributes" ) {                    
                    array_push($this->idlist,$arraydata[ $key ]["id"]); 
                }
                $this->target_attributes=& $arraydata[$key];
                $this->get_allid();
                        
            }
        }
        
        return $this->idlist;
    }
    
    
    private function tag_exist() {
       /* $key=$this->target_tag; 
        $target_keys = & $this->target_keys;*/
        return in_array($this->target_tag, $this->target_keys);
    }

    public function get_tag() {
        return $this->target;
    }
    
    public function val_change( $value, $tag ) {
        if($tag=="fill"||$tag=="stroke"){
            if($value!="none"){
                $value="#".$value;
            }
        }
        $target = & $this->target;
        $this->target_tag=$tag;
        if($this->tag_exist()){
            $target[ $tag ] = $value;
        }else{
            $this->tag_add($value);
        }
        $result=$this->update_json();
        return $result;
    }
    private function tag_add($value) {
        $target = & $this->target;
        $tag=$this->target_tag;
        $target += array( $tag => $value );
    }
    
    public function tag_del( $tag ) {
        $target = & $this->target;
        $this->target_tag=$tag;
        
        if($this->tag_exist()){
            unset($target[$tag]);
        }
    }
    
    private function update_json(){
        //var_dump("CC");
        $fname=strstr($this->tname,".",true);
        file_put_contents("./tmp/".$this->filename["filename"].".json", json_encode($this->assosiative_array));
        ini_set('display_errors', 0);
        file_put_contents("./tmp/".$this->filename["basename"], json_to_svgstring($this->assosiative_array));
        ini_set('display_errors', 1);
        
        
        
        return true;
    }

    public function close() {
        $fname=strstr($this->tname,".",true);
        var_dump($this->filename["dirname"] ."/". $this->filename["basename"]);
        copy( './tmp/' . $this->filename["basename"] , $this->filename["dirname"] ."/". $this->filename["basename"] );
        unlink('./tmp/' . $this->filename["basename"]);
        unlink('./tmp/' . $this->filename["filename"] . '.json');
        return true;
    }
}



?>