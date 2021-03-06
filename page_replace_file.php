<?php
include("./class_file_io.php");
$name="";
if(isset($_GET["name"])){
    $name=$_GET["name"];    
}
$fgets=new file_io("./data/profile.csv");
$imglist= $fgets->get_type_of_file_path("img");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Untitled Document</title>
    <link href="css/replace_page.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/replace_page.js"></script>
</head>
    <main>
        <form action="page_replace_result.php" method="get" >
            <h2>画像差替え</h2>
            <div id="img_wrap">
                <div id="old_file" class="file_inspector">
                    <h3>選択画像</h3>
                    <div class="name_disp"><?php echo $name ;?></div>
                    <div class="file_view">
                        <img src="<?php echo $name ;?>">
                    </div>
                    <input type="hidden" name="old_file_path" id="old_file_path" value="<?php echo $name ?>">
                </div>
                <div id="new_file" class="file_inspector">
                    <h3>置換画像</h3>
                    <div class="name_disp" id="new_file_name"></div>
                    <div id="new_file_view" class="file_view">
                        <img id="new_file_img" src="">
                    </div>
                    <input type="hidden" id="new_file_path" name="new_file_path" value="">
                    
                    <!--<input type="file" name="file_p" >-->
                </div>
            </div>
            
            
            <div id="selector_img_list">
                <?php $flg=0; foreach($imglist as $f){  ?>
                <div class="thumb_set">
                    <div class="image_cell"><img src="<?php echo $f ;?>?<?php echo date("YmdHis");?>" ></img></div>
                    <div class="info_cell">
                        <p><?php echo basename($f) ;?></p>
                    </div>
                    <div class="act_butts">
                            <button type="button" onClick="set_image('<?php echo $f ;?>')">選択</button>
                    </div>
                </div>
                <?php } ?>
            </div>
            <input type="submit" value="置換実行" >
        </form>
    </main>
<body>
</body>
</html>