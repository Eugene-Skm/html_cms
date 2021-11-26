<?php
$htmlpath = "";
if ( isset( $_GET[ "htmlnm" ] ) ) {
    $htmlpath = $_GET[ "htmlnm" ];

}
?>

<!doctype html>
<html>
<head>
<title>Editor Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link href="css/common.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<link
            href="css/page_editor_main.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/page_editor_jq.js"></script> 
<script type="text/javascript" src="js/page_editor_prop.js" defer="defer"></script> 
<script type="text/javascript" src="js/path_calclater.js" defer="defer"></script> 
<script type="text/javascript" src="js/hex_translater.js" defer="defer"></script>
</head>

<body>
<header>
    <div id="topbar">
        <div id="logo"><img src="img/toplogo.png" alt="Logo"/></div>
    </div>
</header>
<main>
    <div id="loading_panel"><img src="img/Rolling-1s-200px.svg"></div>
    <div id="editor_panel">
        <div id="property_panel">
            <div class="puroperty">
                <h3>HTMLページデータ</h3>
                <div class="property_content">
                    
                    <p class="w30">ファイル名</p>
                    <p class="w70" id="htmlt"><?php echo basename($htmlpath); ?></p>
                    <input type="hidden" value="<?php echo realpath($htmlpath); ?>" id="abs_path">
                    <!--<input type="button" class="w30" id="edit_html_code" value="HTML編集">-->
                </div>
                <div class="property_content">
                    <p class="w30">タイトル</p>
                    <input type="text" class="w70" id="pagetitle" >
                </div>
            </div>
            <div class="puroperty">
                <h4>選択タグ名</h4>
                <div class="property_content">
                    <p class="w70" id="targeted_tag"><?php echo basename($htmlpath); ?></p>
                    <input type="hidden" id="targeted_id" value="">
                    <input type='button'class="w30" id='remover' value="要素削除" disabled="disabled" onClick="remove_Ele()">
                </div>
            </div>
            <hr>
            <div class="puroperty">
                <h4>内部テキスト</h4>
                <div class="property_content">
                    <textarea type="text" class="w70" id="inner_text" disabled="disabled"></textarea>
                    <input type='button' class="w30" id='big_editor' value="エディタ起動" disabled="disabled">
                </div>
            </div>
            <div class="puroperty">
                <h4>リンク</h4>
                <div class="property_content">
                    <p class="w30">テキスト</p>
                    <input type="text" class="w70" id="link_text" disabled="disabled">
                </div>
                <div class="property_content">
                    <p class="w30">URL</p>
                    <input type="text" class="w70" id="link_url" disabled="disabled">
                </div>
            </div>
            <div class="puroperty">
                <h4>画像パス</h4>
                <div class="property_content">
                <p  class="w70" id='img_name'></p>
                <input type='button' class="w30" id='img_select' onclick="img_selector_open()" value="差し替え" disabled="disabled">
                <input type='button' id='img_url' value="a" style=" display: none;">
                </div>
            </div>
            <div class="puroperty">
                <h4>繰返し項目操作</h4>
                <div class="property_content">
                <p  class="w70" id="duplicate_title">テーブル行"tr"複製</p>
                <input class="w30" type='button' id='duplicater' value="要素複製" disabled="disabled" onClick="duplicate_dialog_open('d')">
                </div>
            <div class="property_content">
                <p class="w70" id="sorter_title">テーブル行"tr"前後入替</p>
                <input class="w30" type='button' id='sorter' value="要素入替" disabled="disabled" onClick="duplicate_dialog_open('s')">
            </div>
            </div>
        </div>
        <div id="page_view">
            <div id="toolbar">
                <div id="bar_upper">
                    <div id="tabplace"><p id="title_tab"></p></div>
                    <div id="browser_button">
                        <div class="button">ー</div>
                        <div class="button">□</div>
                        <div class="button">×</div>
                    </div>
                </div>
                <div id="bar_bottom">
                    <div id="transition_buttons">
                        <div class="button"><b>←</b></div>
                        <div class="button"><b>→</b></div>
                        
                    </div>
                    <div id="url_bar"><p><?php echo $htmlpath; ?></p></div>
                </div>
            </div>
            <iframe id="htmlframe" src="<?php echo $htmlpath."?".date("YmdHis"); ?>" frameborder="0"></iframe>
        </div>
        <div id="functional_Buttons">
            <button id="save" style='display: inline-block; width:"100px";' onclick="save_close()"><img src="img/save.svg" width="50px"></button>
        </div>
    </div>
    
    <!--*******************************ダイアログ*******************************-->
    <div id="a_dialog" class="dialog">
        <form class="dialog_form" name="dialog">
            <div id="set_proper">
                <div id="set_alt">
                    <p>alt属性（代替テキスト）の設定</p>
                    <input type="text" id="alt_input" value="">
                </div>
            </div>
            <hr>
            <div id="a_alert">
                <p>親要素が aリンク要素です。リンク先を変更しますか？</p>
                <div class="way">
                    <input type="radio" name="use_a_way" value="nowurl" id="nowurl_r" class="waybutton" checked>
                    <label for="nowurl_r">現在のURL</label>
                    <label for="nowurl_r" id="nowurl" class="way_url"></label>
                </div>
                <div class="way">
                    <input type="radio" name="use_a_way" value="newimgurl" id="nowimg_url_r" class="waybutton">
                    <label for="nowimg_url_r">新画像URL</label>
                    <label for="nowimg_url_r" id="newimgurl" class="way_url"></label>
                </div>
                <div class="way">
                    <input type="radio" name="use_a_way" value="nowurl_input" id="nowurl_input_r" class="waybutton">
                    <label for="nowurl_input_r">新規入力</label>
                    <input type="text" value="" id="nowurl_input" class="way_url" placeholder="URLを入力" onClick="document.getElementById('nowurl_input_r').checked=true">
                </div>
                <input type="hidden" value="" id="rl_path">
            </div>
            <input type="button" value="確定" onclick="call_change_html_from_dialog()">
        </form>
    </div>
    <div id="d_dialog" class="dialog">
        <form class="dialog_form" name="dialog">
            <div id="d_setting">
                <p>
                <p class="d_tagname">tr</p>
                <p id="pattern_title">複製設定</p>
                </p>
                <p id="instruction">複製元と複製先の設定をしてください</p>
                <div class="origin">
                    <p>複製元</p>
                    <select id="d_origin">
                    </select>
                </div>
                <div class="set">
                    <p>複製先</p>
                    <select id="d_set">
                    </select>
                    <select id="beforeafter">
                        <option value="b">前</option>
                        <option value="a">後ろ</option>
                    </select>
                </div>
            </div>
            <input type="hidden" id="duplicatepattern" value="">
            <input type="button" value="確定" onclick="duplicator_sorter()">
        </form>
    </div>
</main>
<aside></aside>
<footer></footer>
</body>
</html>