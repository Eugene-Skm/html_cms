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

    function __construct( $jname ) {
        $url = "./edited_json/" . $jname;
        $this->target_json = file_get_contents( $url );
        $this->assosiative_array = json_decode( $svgjsondata, true );

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
                    if($arraydata['@attributes']['id']===$id){
                        $this->target_attributes=& $arraydata['@attributes'];
                        $this->target_attributes_keys=& array_keys( $arraydata['@attributes'] );
                        $end_flg=true;
                    }
                }
                if(!$end_flg){
                    $this->tag_edit( $data[ $key ] );
                    $end_flg=false;
                }       
            }
        }
    }
    
    private function tag_exist() {
        $key=$this->target_tag; 
        $target_keys = & $this->target_attributes_keys;
        
        return in_array($key, $target_keys);
    }

    
    public function val_change( $value, $tag ) {
        $target = & $this->targe_attributes;
        $this->target_tag=$tag;
        if($this->tag_exist()){
            $target[ $tag ] = $value;
        }
    }
    public function tag_add( $value, $tag ) {
        $target = & $this->targe_attributes;
        $this->target_tag=$tag;
        
        $target[ $tag ] += array( $tag => $value );
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