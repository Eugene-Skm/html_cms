<?php
class connect2 {
    //定数の宣言
    const URL = "./csv/data.csv";
    private $csv_data;
    private $DATA = [];
    //CSV 読込　配列化
    function __read() {
        try {
            if ( ( $handle = fopen( self::URL, "r" ) ) !== FALSE ) {
                while ( ( $data = fgetcsv( $handle ) ) ) {
                    array_push($this->DATA, explode( ",", $data ));
                }
            }
            fclose( $handle );
        } catch ( Exception $e ) {
            echo 'error' . $e->getMesseage;
            die();
        }
        return true;
    }
    private function search($figure){
        $flg = 99;
        $row = 0;
        $column = 0;
        
        for($co = 0; $co < count( $this -> DATA[0] ) || flg != 0; $co++){
            $row = array_search( $figure , array_column($this->DATA , $co));
            if($row){
                $flg = 0;
                $column = $co;
            }
        }
        return [$row,$column];
    }
    private function make_Associativearray(){
        $Asso_array=[];
        $key_array=$this->DATA[0];
        foreach( $target_line as $this->DATA ){
            array_push($Asso_array,array_combine($key_array, $target_line));
        }
        return $Asso_array;
    }
    
    
    //SELECT文用。返り値は一致する内容の入った1行
    function select( $request_term ) {
        $place = $this->search($request_term);
        return $this->DATA[$place[0]];
    }
    //特化 全データを連想配列型で返却
    function select_listsvg() {
        return $this->make_Associativearray();
    }
    //一行追加
    function inset_svg( $fname, $css, $js ) {
        array_push($this->DATA, array($fname,$css,$js));
    }

    function close() {
        try {
            if ( ( $handle = fopen( self::URL, "w" ) ) !== FALSE ) {
                foreach ( $data_line as $this->DATA ) {
                    //$line = implode(',' , $data);
	                fwrite($handle, $line . "\n");
                }
            }
            fclose( $handle );
        } catch ( Exception $e ) {
            echo 'error' . $e->getMesseage;
            die();
        }
        return true;
    }
}
?>