<?php
include( './class_json_edit.php' );
$fnm = "";
$st = "";
$svgjson;
if ( isset( $_GET[ "name" ] ) ) {
    $fnm = $_GET[ "name" ];
    $st = $_GET[ "st" ];

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
<script src="js/openup.js" ></script> 
<script type="text/javascript" src="js/editor.js" defer></script> 
<script> 
    postSend("<?php echo $st ?>","<?php echo $fnm ?>");
</script>
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
                <select name="ids">
                    <?php foreach( $idlist as $id ){ ?>
                    <option value="<?php echo $id ?>"><?php echo strstr($id,"-",true)." - " . $id ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="properties">
                <div class="property">
                    <p>表示・非表示</p>
                    <div class="tagset">
                        <label class="property_name" for="display">表示・非表示</label>
                        <input class="property_val" id="display" type="checkbox"/>
                    </div>
                    <div class="tagset">
                        <label class="property_name" for="stroke-opacity">全体透明度</label>
                        <input class="property_val" id="stroke-opacity" type="range" min="0" max="1" step="0.1" value="1">
                    </div>
                </div>
                <div class="property">
                    <p>枠線系要素</p>
                    <div class="tagset">
                        <label class="property_name" for="stroke">枠線色</label>
                        <input class="property_val" id="stroke" type="color"/>
                    </div>
                    <div class="tagset">
                        <label class="property_name" for="stroke-opacity">透明度</label>
                        <input class="property_val" id="stroke-opacity" type="range" min="0" max="1" step="0.1" value="1">
                    </div>
                </div>
                <div class="property">
                    <p>塗り要素</p>
                    <div class="tagset">
                        <label class="property_name" for="fill">色</label>
                        <input class="property_val" id="fill" type="color"/>
                    </div>
                    <div class="tagset">
                        <label class="property_name" for="fill-opacity">透明度</label>
                        <input class="property_val" id="fill-opacity" type="range" min="0" max="1" step="0.1" value="1">
                    </div>
                </div>
            </div>
        </div>
        <div id="svg_view"> </div>
    </div>
</main>
<aside> </aside>
<footer> </footer>
</body>
</html>