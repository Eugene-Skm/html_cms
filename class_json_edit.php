<?php
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
    private $target_attributes_keys;
    private $target_tag;
    private $tname;

    function __construct( $jname ) {
        $this->tname=$jname;
        $url = "./tmp/" . $jname;
        $this->target_json = file_get_contents( $url );
        $this->assosiative_array = json_decode( $this->target_json, true );
         $this->target_attributes=& $this->assosiative_array;
    }
    public function get_attributes( $id, & $ef=null) {
        //各Attributes編集保存時に毎回呼び出される
        //返り値保存先は$target_attributes_key;
        if($ef!=null){
            $end_flg=& $ef;
        }else{
            $end_flg=false;    
        }
        
        $arraydata = & $this->target_attributes;
        $arraykeys = array_keys( $arraydata );

        foreach ( $arraykeys as $keys => $key ) {
            if ( is_array( $arraydata[ $key ] ) ) {
                if ( $key === "@attributes" ) {                    
                    if($arraydata['@attributes']['id']==$id){
                        var_dump($arraydata['@attributes']);
                        $this->target_attributes=& $arraydata['@attributes'];
                        $this->target_attributes_keys= array_keys( $arraydata['@attributes'] );
                        $end_flg=true;
                        var_dump($end_flg);
                    }
                }
                if($end_flg===false){
                    var_dump($end_flg);
                    $this->target_attributes=& $arraydata[$key];
                    $this->get_attributes( $id,$end_flg );
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
        $key=$this->target_tag; 
        $target_keys = & $this->target_attributes_keys;
        
        return in_array($key, $target_keys);
    }

    
    public function val_change( $value, $tag ) {
        $target = & $this->target_attributes;
        var_dump($target );
        $this->target_tag=$tag;
        if($this->tag_exist()){
            $target[ $tag ] = $value;
        }else{
            $this->tag_add($value);
        }
       //var_dump($this->assosiative_array);
        
        
             
    }
    public function tag_add($value) {
        $target = & $this->target_attributes;
        $tag=$this->target_tag;
        $target += array( $tag => $value );
    }
    
    public function tag_del( $tag ) {
        $target = & $this->targe_attributes;
        $this->target_tag=$tag;
        
        if($this->tag_exist()){
            unset($target[$tag]);
        }
    }

    public function close() {
        
    }
}



?>