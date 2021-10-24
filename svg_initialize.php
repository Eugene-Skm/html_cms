<?php
/**
 * @var array global $tag_count SVG内に出てくるタグ計数用配列
 */
global $tag_count;
$tag_count = [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ];
global $tag_info;
$tag_info = [ "rect", "circle", "ellipse", "line", "polyline", "polygon", "path", "text", "image", "text", "a", "g", "defs", "style", "svg", "pattern", "mask", "clipPath", "ND", "@attributes", "top" ];
/**
 * SVG画像をJsonへ
 * @param $fname SVGファイル名
 * @return 返還後のJSON
 */
function svg_to_json( $fname ) {
    $rdfile = './testSVG/' . $fname.".svg";
    $svg = file_get_contents( $rdfile );

    $domDocument = new DOMDocument();
    $domDocument->loadXML( $svg );
    $xmlString = $domDocument->saveXML();
    $xmlObject = simplexml_load_string( $xmlString );
    //XML To Json　空白成形　J　日本語文字 スラッシュそのまま https://syncer.jp/how-to-use-json
    $json = json_encode( $xmlObject, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
    return $json;
}

/**
 * Json形式を連想配列に変換
 * @param $svgjsondata Json形式
 * @return 返還後の連想配列
 */
function json_to_array( $svgjsondata ) {
    return json_decode( $svgjsondata, true );
}

/**
 * SVG全要素に一括でタグと値を追加するメソッド
 * idは先頭に、その他タグは最後方
 *
 * @param string $tag 追加するタグ（キー値id等）
 * @param string $parent 親要素名　通常は"svg"を設定
 * @param array & $dataarray SVG情報連想配列 svg_to_jsonの返り値を推奨
 * @param string $keyvalue  id以外の場合追加する値　null（指定なし）OK
 * @return array 指定したタグの追加された連想配列
 */
function set_atribute_tag( string $tag, string $parent, array & $dataarray, string $keyvalue = null ) {
    $flg = false;
    $array_keys = array_keys( $dataarray );

    foreach ( $array_keys as $keys => $key ) {
        if ( is_array( $dataarray[ $key ] ) ) {
            //キーが数字でない場合 連想配列[0],[1]...避け
            if ( !is_int( $key ) ) {
                //$tagに該当する属性が発見された場合
                if ( array_key_exists( $tag, $dataarray[ $key ] ) ) {
                    if ( $tag == "id" ) {
                        list( $elementname, $ele_count ) = tag_judge_for_set_id( $key, $parent );
                        $keyvalue = $elementname . "-" . $GLOBALS[ "tag_count" ][ $ele_count ];
                    }
                    $dataarray[ $key ][ $tag ] = $keyvalue;
                } elseif ( !array_key_exists( $tag, $dataarray[ $key ] ) ) {
                    //$tagの属性が存在しない場合
                    if ( !array_key_exists( 0, $dataarray[ $key ] ) ) {
                        if ( !array_key_exists( "@attributes", $dataarray[ $key ] ) ) {
                            //"id"タグの場合先頭追加　それ以外は最後方
                            if ( $tag == "id" ) {
                                list( $elementname, $ele_count ) = tag_judge_for_set_id( $key, $parent );
                                $keyvalue = $elementname . "-" . $GLOBALS[ "tag_count" ][ $ele_count ];
                                array_unshift( $dataarray[ $key ], $keyvalue );
                                //先頭の要素のタグ値のキーを「0」から＄tag内容に変更
                                $a = array_keys( $dataarray[ $key ] );
                                $a[ 0 ] = $tag;
                                $b = array_values( $dataarray[ $key ] );
                                $dataarray[ $key ] = array_combine( $a, $b );
                            } else {
                                $dataarray[ $key ] += array( $tag => $keyvalue );
                            }
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
                //自分の階層の親が数値配列の場合　親キーは一つ上の階層。　
                if ( $flg ) {
                    $tmp_key = $parent;
                    $flg = false;
                } else { //それ以外の場合渡すキーはそのまま
                    $tmp_key = $key;
                }
                set_atribute_tag( $tag, $tmp_key, $dataarray[ $key ], $keyvalue );
            }
        }
    }
    return ( $dataarray );
}
/**
 * 追加するべきタグ名を判断しその割り振り番号をカウントする
 *
 * @param string $key1 要素自体の持つキー
 * @param string $pare 親の持つキー
 * @return array $tag_info[ $place ], $place　タグ名とカウント配列上の位置
 */
function tag_judge_for_set_id( string $key1, string $pare ) {

    $nkey = $key1;

    if ( $pare == "svg" && $key1 != "@attributes" ) {
        //もっとも最上層に君臨している属性たちはTopに当たる
        $nkey = "top";
    } elseif ( $pare == "svg" && $key1 == "@attributes" ) {
        //もっとも最上層の@attributesはSVGそのもの
        $nkey = "svg";
    } elseif ( $pare != "svg" ) {
        //それ以外の要素は親要素のキーがidに入る　
        $nkey = $pare;
    }
    $place = array_search( $nkey, $GLOBALS[ "tag_info" ] );
    $GLOBALS[ "tag_count" ][ $place ]++;

    return [ $GLOBALS[ "tag_info" ][ $place ], $place ];
}

function json_to_svgstring( array & $data ) {
    static $svgdata = "";
    $Nowend = "";
    $arraykeys = array_keys( $data );

    foreach ( $arraykeys as $keys => $key ) {
        if ( is_array( $data[ $key ] ) ) {
            if ( $key === "@attributes" ) {
                $thisdata = $data[ $key ];
                $Attributes_key = array_keys( $thisdata );

                $AtTag = strstr( $thisdata[ 'id' ], "-", true );
                $Tagdata = "";
                if ( $AtTag == "svg" ) {
                    $Tagdata .= "xmlns='http://www.w3.org/2000/svg' ";
                }
                foreach ( $Attributes_key as $Ttag => $tagVal ) {
                    $Tagdata .= $tagVal . "='" . $thisdata[ $tagVal ] . "' ";
                }
                if ( un_void_check( $AtTag ) == "end" ) {
                    $svgdata .= "<" . $AtTag . " " . $Tagdata . ">\r\n";
                    $Nowend = $AtTag;
                } elseif ( un_void_check( $AtTag ) == "void" ) {
                    $svgdata .= "<" . $AtTag . " " . $Tagdata . "/>\r\n";
                }
            }
            json_to_svgstring( $data[ $key ] );
        }
    }
    if ( $Nowend != "" ) {
        $svgdata .= "</" . $Nowend . ">\r\n";
        $Nowend = "";
    }
    return $svgdata;
}

function tag_exist( string $Tname ) {
    return in_array( $nkey, $GLOBALS[ "tag_info" ] );
}

function un_void_check( string $Tname ) {
    $void_tag = [ "rect", "circle", "ellipse", "line", "polyline", "polygon", "path", "text", "image", "text", "ND", "@attributes", "top" ];
    $end_tag = [ "a", "g", "defs", "svg", "pattern", "mask", "style", "clipPath" ];
    $result = "";

    if ( in_array( $Tname, $void_tag ) ) {
        $result = "void";
    } else if ( in_array( $Tname, $end_tag ) ) {
        $result = "end";
    } else {
        $result = false;
    }
    return $result;
}

?>