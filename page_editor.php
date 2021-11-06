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
<link href="css/page_editor_main.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script type="text/javascript" src="js/page_editor_jq.js"></script> 
<script type="text/javascript" src="js/page_editor_prop.js" defer></script> 
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
                <textarea type="text" id="inner_text"></textarea>
                <input type='button' id='big_editor' value="エディタ起動">
            </div>
            <div class="puroperty">
                <h4>画像パス</h4>
                <label id='img_name'></label>
                <input type='button' id='img_select' value="差し替え">
                <input type='hidden' id='img_url' value="">
            </div>
            <div class="puroperty">
                
            </div>
        </div>
        <div id="page_view">
            <iframe id="htmlframe" src="<?php echo $htmlpath."?".date("YmdHis"); ?>"></iframe>
        </div>
        <div id="functional_Buttons">
            <button id="save" style='display: inline-block; width:"100px";' onClick="xmlhttp_close()"><img src="img/save.svg" width="50px"></button>
        </div>
    </div>
</main>
<script defer>
        setTimeout(function(){
            var iframe = document.getElementById('htmlframe'); 
            var innerDoc = iframe.contentDocument || iframe.contentWindow.document; 
            console.log("A");
            //console.log(innerDoc);
            
            var doc = document.getElementsByTagName("iframe")[0].contentWindow.document;
            console.log("B");
            //console.log(doc);


            const elem = document.getElementById('htmlframe');
            const target = elem.contentWindow.document.querySelector('html');
            console.log("C");
            //console.log(target.innerHTML);
            //target.style.textAlign = 'right';
/*
            var o_iframe = document.getElementById('htmlframe');
            var color = o_iframe.contentWindow.document.getElementById('nn');
            console.log("D");
            console.log(o_iframe);
            color.innerHTML = "赤色に変えました。";
            color.style.background = "red";
*/
            
        },10);
        
        $('#htmlframe').on('load', function() {
                var iframe = $("#htmlframe");
               // console.log(iframe.contents().find('html').html() );
        });
    </script>
<aside> </aside>
<footer> </footer>
</body>
</html>