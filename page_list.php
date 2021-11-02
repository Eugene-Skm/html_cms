<?php
$htmllist = array_filter( glob( "./testHTML/*" ), 'is_file' );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無題ドキュメント</title>
<link href="css/common.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<link href="css/list_page.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    <div id="topbar">
        <div id="logo"><img src="img/toplogo.png" alt="Logo"/></div>
    </div>
</header>
<main>
    <ul>
        <?php foreach( $htmllist as $hl ){ ?>
        <li>
            <div class="basic_name">
                <?php echo basename($hl) ?> 
                <a href="page_editor.php?htmlnm=<?php echo $hl ?>" ></a>
            </div>
        </li>
        <?php } ?>
    </ul>
</main>
</body>
</html>