<?php
require_once( 'class_db_io.php' );

$db = new connect();
$list = $db->select_listsvg();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<header> </header>
<main>
    <div>
        <?php foreach($list as $svg){ ?>
        <div id="set"> <a href="./edit_page.php?name=<?php echo $svg['fname'] ;?>"></a>
            <div id="image_cell"> <img src="original_svg/<?php echo $svg['fname'] ;?>" ></img> </div>
            <div id="info_cell">
                <p><?php echo $svg['title'] ;?></p>
                <p><?php echo $svg['date'] ;?></p>
            </div>
        </div>
        <?php } ?>
    </div>
</main>
<aside> </aside>
<footer> </footer>
</body>
</html>