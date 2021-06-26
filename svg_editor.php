<?php

global $tag_count;
$tag_count = [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ];


function svg_to_json( $fname ) {
    $rdfile = './svg/' . $fname;

    $svg = file_get_contents( $rdfile );

    $domDocument = new DOMDocument();
    $domDocument->loadXML( $svg );
    $xmlString = $domDocument->saveXML();
    $xmlObject = simplexml_load_string( $xmlString );
    //XML To Json   JSON_PRETTY_PRINT　空白成形　JSON_UNESCAPED_UNICODE　日本語文字を文字で出す　JSON_UNESCAPED_SLASHES　スラッシュそのまま
    //Json扱い　https://syncer.jp/how-to-use-json
    $json = json_encode( $xmlObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
    return $json;
}

function json_to_array( $svgjsondata ) {
    return json_decode( $svgjsondata, true );
}

function is_vector( array $arr ) {
    return array_values( $arr ) === $arr;
}

function set_atribute_tag( $tag, & $parent, & $dataarray ) {
    $flg = false;
    //再起処理を扱う　無限ループにならないように慎重に
    $array_keys = array_keys( $dataarray );

    foreach ( $array_keys as $keys => $key ) {
        if ( is_array( $dataarray[ $key ] ) ) {
            //キーが数字でない場合 連想配列[0],[1]...避け
            if ( !is_int( $key ) ) {
                if ( array_key_exists( $tag, $dataarray[ $key ] ) ) {
                    //$tagに該当する属性が発見された場合
                    list( $elementname, $ele_count ) = tag_judge( $key, $parent );
                    $dataarray[ $key ][ $tag ] = $elementname . "-" . $GLOBALS[ "tag_count" ][ $ele_count ];
                } elseif ( !array_key_exists( $tag, $dataarray[ $key ] ) ) {
                    //var_dump($dataarray);
                    if ( !array_key_exists( 0, $dataarray[ $key ] ) ) {
                        if ( !array_key_exists( "@attributes", $dataarray[ $key ] ) ) {
                            //$tagの属性が無い場合
                            list( $elementname, $ele_count ) = tag_judge( $key, $parent );
                            //先頭にあらたにタグ値を追加
                            array_unshift( $dataarray[ $key ], $elementname . "-" . $GLOBALS[ "tag_count" ][ $ele_count ] );

                            //先頭の要素のタグ値のキーを「0」から＄tag内容に変更
                            $a = array_keys( $dataarray[ $key ] );
                            $a[ 0 ] = $tag;
                            $b = array_values( $dataarray[ $key ] );
                            $dataarray[ $key ] = array_combine( $a, $b );
                        }
                    }
                }
            } else {
                $flg = true;
            }
            $tmp_key = "";
            $flg_for_roop_check = true;
            //下の階層が複数要素を持つ配列の場合
            if ( is_array( $dataarray[ $key ] ) ) {
                //自分の階層の親が数値配列の場合　親キーは一つ飛ばした上の階層になる。　
                //ただしこの処理はSVGでのみ有効 rect>0>@attributes rect>1>@attributes
                if ( $flg ) {
                    $tmp_key = $parent;
                    $flg = false;
                } else { //それ以外の場合渡すキーはそのままループ中のキー
                    $tmp_key = $key;
                }
                set_atribute_tag( $tag, $tmp_key, $dataarray[ $key ] );
            }
        }
    }
    return ( $dataarray );
}
//タグ判定とカウント
function tag_judge( $key1, $pare ) {
    $tag_info = [ "rect", "circle", "ellipse", "line", "polyline", "polygon", "path", "text", "image", "text", "a", "g", "defs", "style", "svg", "pattern", "mask", "clipPath", "ND", "@attributes", "top" ];
    $nkey = $key1;

    if ( $pare == "svg" && $key1 != "@attributes" ) {
        //もっとも最上層に君臨している属性たちはTopに当たる
        $nkey = "top";
    } elseif ( $pare == "svg" && $key1 == "@attributes" ) {
        //もっとも最上層の@attributesはSVGそのもののため
        $nkey = "svg";
    } elseif ( $pare != "svg" ) {
            //それ以外の要素は親要素のキーがidに入る　rect>@attributesの場合＠attributesはrectなのでrect1
            $nkey = $pare;
        }
        //判定配列から位置検索
    $place = array_search( $nkey, $tag_info );
    //タグの数を係数
    $GLOBALS[ "tag_count" ][ $place ]++;

    return [ $tag_info[ $place ], $place ];

}

?>