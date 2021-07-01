<?php
class JSONEDIT{
    var $target_json;
    var $assosiative_array;
    
    function jsonedit($name){
        $url = "./edited_json/".$name;
        $this->target_json = file_get_contents($url);
        $this->assosiative_array= json_decode( $svgjsondata, true );
    }
    
    
    
    
    function tag_edit(){
        
    }
    function tag_exist(){
        
    }
    function tag_add(){
        
    }
    
}

?>