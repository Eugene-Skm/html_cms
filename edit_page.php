<?php
include( './class_json_edit.php' );
$fnm = "";
$st = "";
$svgjson;
if ( isset( $_GET[ "name" ] ) ) {
    $fnm = $_GET[ "name" ];
    $st = $_GET[ "st" ];
    $flg = copy( './edited_svg_json/E_' . $fnm . '.json', './tmp/' . $fnm . '.json' );
    $flg = copy( './edited_svg/E_' . $fnm . '.svg', './tmp/' . $fnm . '.svg' );

    $jsonedit = new JSONEDIT( $fnm . '.json' );
    $idlist = $jsonedit->get_allid();
    sort( $idlist );

}
?>

<!doctype html>
<html>
<head>
<title>Editor Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link href="css/common.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<link href="css/editor_main.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<script type="text/javascript" src="js/openup.js" ></script> 
<script type="text/javascript" src="js/editor.js" defer></script> 


</head>

<body>
<header>
    <div id="topbar">
        <div id="logo"><img src="img/toplogo.png" alt="Logo"/></div>
    </div>
</header>
<main>
    <div id="editor_panel">
        <div id="property_panel">
            <div id="parts_selecter">
                <label for="ids">調整可能要素</label>
                <select name="ids" id="partsselector">
                    <option value="default" default>---</option>
                    <?php foreach( $idlist as $id ){ ?>
                    <option value="<?php echo $id ?>"><?php echo strstr($id,"-",true)." - " . $id ?></option>
                    <?php } ?>
                </select>
            </div>
            <div id="properties">
                <!---------ひとまとまり---------->
                <input id="key-check3" class="key-check" type="checkbox">
                <label class="key-label " for="key-check3"><div class="mountain"></div>要素状態</label>
                <div class="key-content">
                    <label class="property_name" for="effective1"> 非表示</label>
                    <input id="display" class="effective property_val" type="checkbox" onchange="update(this)"/>
                    <div class="attribute">
                        <div class="tagset">
                            <label class="property_name" for="stroke-opacity">全体透明度</label>
                            <input class="property_val" id="stroke-opacity" type="range" min="0" max="1" step="0.01" value="1" onchange="update(this)">
                        </div>
                    </div>
                </div>
                <!---------ひとまとまり---------->
                <input id="key-check1" class="key-check" type="checkbox">
                <label class="key-label" for="key-check1"><div class="mountain"></div>塗り</label>
                <div class="key-content">
                    <label class="property_name" for="effective3"> 無し</label>
                    <input class="effective property_val" id="fill-effective"  type="checkbox" onchange="update(this)"/>
                    <div class="attribute">
                    <div class="tagset">
                            <label class="property_name" for="fill">色</label>
                            <input class="property_val" id="fill" type="color" onchange="update(this)"/>
                        </div>
                        <div class="tagset">
                            <label class="property_name" for="fill-opacity">透明度</label>
                            <input class="property_val" id="fill-opacity" type="range" min="0" max="1" step="0.01" value="1" onchange="update(this)">
                        </div>
                        </div>
                </div>
                <!---------ひとまとまり---------->
                <input id="key-check2" class="key-check" type="checkbox">
                <label class="key-label" for="key-check2"><div class="mountain"></div>枠</label>
                <div class="key-content">
                    <label class="property_name" for="effective2"> 無し</label>
                    <input id="stroke-effective" class="effective property_val" type="checkbox" onchange="update(this)"/>
                    <div class="attribute">
                        <div class="tagset">
                            <label class="property_name" for="stroke">枠線色</label>
                            <input class="property_val" id="stroke" type="color" onchange="update(this)"/>
                        </div>
                        <div class="tagset">
                            <label class="property_name" for="stroke-opacity">透明度</label>
                            <input class="property_val" id="stroke-opacity" type="range" min="0" max="1" step="0.01" value="1" onchange="update(this)">
                        </div>
                    </div>
                </div>
                <!---------ひとまとまり---------->
                <input id="key-check4" class="key-check" type="checkbox">
                <label class="key-label" for="key-check4">クリックで開く4</label>
                <div class="key-content">
                    <p>hello.world4!</p>
                </div>
                <!---------ひとまとまり---------->
            </div>
        </div>
        <div id="svg_view"> </div>
        <div id="functional_Buttons">
            <button id="save" style='display: inline-block; width:"100px";' onClick="xmlhttp_close()"><img src="img/save.svg" width="50px"></button>
        </div>
    </div>
</main>
<aside> </aside>
<footer> </footer>
</body>
</html>