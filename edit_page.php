<?php
$fnm = "";
$st = "";
if ( isset( $_GET[ "name" ] ) ) {
    $fnm = $_GET[ "name" ];
    $st = $_GET[ "st" ];
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
<script> postSend("<?php echo $st ?>","<?php echo $fnm ?>"); </script> 
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
            <?php  ?>
        </div>
        <div id="svg_view"> 
        <div id="svg_wrapper"> 
            <img src="./tmp/<?php echo $fnm ?>.svg" alt="svg" id="svgview"/> 
        </div>
        </div>
    </div>
</main>
<aside> </aside>
<footer> </footer>
</body>
</html>