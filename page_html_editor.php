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
            href="css/page_editor_main.css"
            type="text/css"
            charset="utf-8"
            rel="stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script
            type="text/javascript"
            src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <link
            rel="stylesheet"
            href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
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
                        <h3>HTML名</h3>
                        <p id="htmlt"><?php echo basename($htmlpath); ?></p>
                        <input type="hidden" value="<?php echo realpath($htmlpath); ?>" id="abs_path">
                        <input type="button" id="edit_html_code" value="HTMLコード編集">
                    </div>
                    <div class="puroperty">
                        <h4>タグ名</h4>
                        <p id="targeted_tag"><?php echo basename($htmlpath); ?></p>
                        <input type="hidden" id="targeted_id" value="">
                        <input type="button" id="edit_inner_code" value="タグ内コード編集">
                    </div>
                    <hr>
                    <div class="puroperty">
                        <h4>内部テキスト</h4>
                        <textarea type="text" id="inner_text" disabled="disabled"></textarea>
                        <input type='button' id='big_editor' value="エディタ起動" disabled="disabled">
                    </div>
                    <div class="puroperty">
                        <h4>リンク</h4>
                        <input type="text" id="link_text" disabled="disabled"></textarea>
                        <input type="text" id="link_url" disabled="disabled"></textarea>
                    </div>
                    <div class="puroperty">
                        <h4>画像パス</h4>
                        <label id='img_name'></label>
                        <input
                            type='button'
                            id='img_select'
                            onclick="img_selector_open()"
                            value="差し替え"
                            disabled="disabled">
                        <input type='button' id='img_url' value="a" style=" display: none;">

                    </div>
                    <div class="puroperty"></div>
                </div>
                <div id="page_view">
                    <iframe id="htmlframe" src="<?php echo $htmlpath."?".date("YmdHis"); ?>"></iframe>
                </div>
                <div id="functional_Buttons">
                    <button
                        id="save"
                        style='display: inline-block; width:"100px";'
                        onclick="save_close()"><img src="img/save.svg" width="50px"></button>
                </div>
            </div>
            <div id="dialog">
                <form id="dialog_form" name="dialog">
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
                            <label for="nowurl_r">現在のURL</label><label for="nowurl_r" id="nowurl" class="way_url"></label>
                        </div>
                        <div class="way">
                            <input type="radio" name="use_a_way" value="newimgurl" id="nowimg_url_r" class="waybutton">
                            <label for="nowimg_url_r">新画像URL</label><label for="nowimg_url_r" id="newimgurl" class="way_url"></label>
                        </div>
                        <div class="way">
                            <input type="radio" name="use_a_way" value="nowurl_input" id="nowurl_input_r" class="waybutton">
                            <label for="nowurl_input_r">新規入力</label><input type="text" value="" id="nowurl_input" class="way_url" placeholder="URLを入力" onClick="document.getElementById('nowurl_input_r').checked=true">
                        </div>
                        <input type="hidden" value="" id="rl_path">
                    </div>
                    <input type="button" value="確定" onclick="call_change_html_from_dialog()">
                </form>
            </div>
        </main>
       
        <aside></aside>
        <footer></footer>
    </body>
</html>