<?php
//require_once( 'trashed_code/class_db_io.php' );

//$db = new connect();
//$list = $db->select_listsvg();
$svglist = array_filter(glob("./testSVG/*.svg"),'is_file');
$imglist = array_filter(glob("./img/*"),'is_file');

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Untitled Document</title>
<link href="css/common.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<link href="css/list_main.css" type="text/css" charset="utf-8" rel="stylesheet"/>
</head>
<body>
<header>
    <div id="topbar">
        <div id="logo"><img src="img/toplogo.png" alt="Logo"/></div>
    </div>
</header>
<main>
    <h2>フォルダ:SVG</h2>
    <div class="list">
        <?php $flg=0; foreach($svglist as $f){  ?>
        <div class="thumb_set"><a onClick="" href="./edit_page.php?name=<?php echo str_replace('.svg', '', basename($f) ); ?>&st=initialized"></a>
            <div class="image_cell"> <img src="./testSVG/<?php echo basename($f) ;?>?<?php echo date("YmdHis");?>" ></img> </div>
            <div class="info_cell">
                <p><?php echo basename($f) ;?></p>
            </div>
            <div class="act_butts">
                <button type=“button” href="location.href='./edit_page.php?name=<?php echo str_replace('.svg', '', basename($f) ); ?>&st=initialized'">編集</button>
                <div class="vertical">
                    <button type=“button”>差替</button>
                    <button type=“button”>削除</button>
                </div>
            </div>
        </div>
        <?php $flg++;  ?>
        <?php if($flg==6){ echo "<hr>"; $flg=0; }  ?>
        <?php } ?>
    </div>
    <hr class="null">
    <h2>フォルダ:IMG</h2>
    <div class="list">
        <?php $flg=0; foreach($imglist as $f){  ?>
        <div class="thumb_set"><a onClick="" href="./edit_page.php?name=<?php echo str_replace('.svg', '', basename($f) ); ?>&st=initialized"></a>
            <div class="image_cell"><img src="./img/<?php echo basename($f) ;?>?<?php echo date("YmdHis");?>" ></img></div>
            <div class="info_cell">
                <p><?php echo basename($f) ;?></p>
            </div>
        </div>
        <?php $flg++;  ?>
        <?php if($flg==6){ echo "<hr>"; $flg=0; }  ?>
        <?php } ?>
    </div>
</main>
<aside> </aside>
<footer> </footer>
</body>
</html>