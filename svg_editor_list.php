<?php
require_once( 'class_db_io.php' );

$db = new connect();
$list = $db->select_listsvg();
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
    <div id="list">
        <?php $flg=0; foreach($list as $svg){  ?>
        <div class="thumb_set"><a href="./edit_page.php?name=<?php echo str_replace('.svg', '', $svg['fname'] ); ?>&st=<?php echo $svg['stat'] ?>"></a>
            <div class="image_cell"> <img src="edited_svg/E_<?php echo $svg['fname'] ;?>?<?php echo date("YmdHis");?>" ></img> </div>
            <div class="info_cell">
                <p><?php echo $svg['title'] ;?></p>
                <p><?php echo $svg['date'] ;?></p>
            </div>
        </div>
        <?php $flg++;  ?>
        <?php if($flg==4){ echo "<hr>"; $flg=0; }  ?>
        <?php } ?>
    </div>
</main>
<aside> </aside>
<footer> </footer>
</body>
</html>