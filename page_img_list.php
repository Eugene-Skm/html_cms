<?php
include("./class_file_io.php");
$pattern = "";
if ( isset( $_GET[ 'pattern' ] ) ) {
    // img_edit || img_select
    $pattern = $_GET[ 'pattern' ];
}
$fgets=new file_io("./data/profile.csv");
$imglist= $fgets->get_type_of_file_path("img");
//$svglist = array_filter( glob( "./SVG/*" ), 'is_file' );
//$imglist = array_filter( glob( "./img/*" ), 'is_file' );
$current_fpath="";
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Untitled Document</title>
<link href="css/common.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<link href="css/list_img.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<script type="text/javascript" src="js/img_list.js"></script>
</head>
<body>
<header>
    <div id="topbar">
        <div id="logo"><img src="img/toplogo.png" alt="Logo"/></div>
    </div>
</header>
<main> 
    <div class="list">
    <?php $flg=0; foreach($imglist as $f){ 
        $filepath = pathinfo($f);
    if($current_fpath != $filepath['dirname']){
        $current_fpath=$filepath['dirname'];
        echo '<h2>ディレクトリ  ';echo $current_fpath; echo'</h2>';
    }
    ?>
        <div class="thumb_set">
            <?php if ( $_GET[ 'pattern' ] == "img_edit" ) { 
                    if(strtolower($filepath['extension'])=="svg"){
            ?>
            <a onClick="" href="./page_svg_editor.php?name=<?php echo $f; ?>&st=initialized"></a>
            <?php } 
                }
            ?>
            <div class="image_cell"> <img src="<?php echo $f ;?>?<?php echo date("YmdHis");?>" ></img> </div>
            <div class="info_cell">
                <p><?php echo basename($f) ;?></p>
            </div>
            <div class="act_butts">
                
                <?php if ( $_GET[ 'pattern' ] == "img_edit" ) { 
                if(strtolower($filepath['extension'])=="svg"){
                ?>
                 <button type=“button” href="location.href='./page_svg_editor.php?name=<?php echo $f; ?>&st=initialized'">編集</button>
                <?php  }; ?>
                <div class="vertical">
                    <button type="button" onClick="window.open('page_replace_file.php?name=<?php echo $f ;?>','差替選択','width=900,height=650,toolbar=no,menubar=no,scrollbars=yes')">差替</button>
                    <button type="button" onClick="deleteconfirm('<?php echo basename($f); ?>')" >削除</button>
                </div>
                <?php } else if ( $_GET[ 'pattern' ] == "img_select" ) { ?>
                    <button type="button" onClick="send_img_data('<?php echo urlencode(realpath($f));?>')">選択</button>
                     <input type="hidden" value="<?php echo realpath($f); ?>" id="img_abs_path">
                <?php } ?>
                
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