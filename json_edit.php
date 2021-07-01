<?php
class JSONEDIT{
    var $target_json;
    var $assosiative_array;
    var $targe_attributes;    //参照渡し出来るか
    var $target_attributes_key;
    
    function jsonedit($jname){
        $url = "./edited_json/".$jname;
        $this->target_json = file_get_contents($url);
        $this->assosiative_array= json_decode( $svgjsondata, true );
        
    }
    public function get_attributes($id){
        //idに当たるアトリビュートキーデータをゲット（再起？）
        //各Attributes編集保存時に毎回呼び出される
        //返り値保存先は$target_attributes_key;
        $this->targe_attributes = & $data[key];
        $this->target_attributes_key = array_keys(& $data[key]);
    }
    public function tag_exist($tag){
        //各Attributesにタグが存在するか確認
        //各Attributes編集保存時、各詳細設定保存時に存在確認のため呼び出される
    }
    
    
    
    function tag_edit(){
        //再起
        $targe_attributes= & $data[key];
     
    }
    
    
    
    
    private function val_change(){
        $target =  & $this->targe_attributes;
       
    }
    private function tag_add(){
        $target =  & $this->targe_attributes;
    }
    private function tag_del(){
        $target =  & $this->targe_attributes;
    }
    
    
    public function close(){
        
    }
}

?>