<?php
    $fnm="";
    $st="";
    if(isset($_GET["name"])){
        $fnm=$_GET["name"];
        $st=$_GET["st"];
    }
?>

<!doctype html>
<html>
<head>
    <script src="js/openup.js" ></script> 
    <script> postSend("<?php echo $st ?>","<?php echo $fnm ?>"); </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Editor Page</title>
    <link href="css/common.css" type="text/css" charset="utf-8" rel="stylesheet"/>
    <link href="css/editor_main.css" type="text/css" charset="utf-8" rel="stylesheet"/>
    <script type="text/javascript" src="js/editor.js" defer></script>
</head>

<body>
    <header>
    </header>
    <main>
        <div>
            <div id="property_panel">
                <?php  ?>
            </div>
            <div id="svg_view">
               <img src="./tmp/<?php echo $fnm ?>.svg" alt="svg"/> 
            </div>
        </div>
        
    </main>
    <aside>
    </aside>
    <footer>
    </footer>
</body>
</html>