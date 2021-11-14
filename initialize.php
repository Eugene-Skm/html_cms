<?php
include( "./class_file_io.php" );
$profiledata_path = "./data/profile.csv";
$message = "";
if ( isset( $_POST[ 'img_folder' ] ) ) {
    $arraydata = $_POST[ 'img_folder' ];
    $new_array = [];
    foreach ( $arraydata as $data ) {
        if ( $data != "null" ) {
            array_push( $new_array, array( 'img', $data ) );
        }
    }
    $arraydata = $_POST[ 'html_folder' ];
    foreach ( $arraydata as $data ) {
        if ( $data != "null" ) {
            array_push( $new_array, array( 'html', $data ) );
        }
    }
    $writer = new file_io( $profiledata_path );
    $writer->write_csv( $new_array );
    if ( !file_exists( $profiledata_path ) ) {
        $writer->replace( $profiledata_path );
        header( 'Location: ./index.php' );
    } else {
        $message = "アップデート完了";
    }
}
$imgpathes = [];
$htmlpathes = [];
$folders = array_filter( glob( "../*" ), 'is_dir' );
if ( file_exists( $profiledata_path ) ) {
    //クラス　効果的
    $reader = new file_io( $profiledata_path );
    $data = $reader->get_csv();
    $imgpathes = $reader->get_type_of_folder_path( "img" );
    $htmlpathes = $reader->get_type_of_folder_path( "html" );
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無題ドキュメント</title>
<link href="css/common.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<link href="css/list_page.css" rel="stylesheet" type="text/css">
<script src="js/initialize.js"></script>
</head>

<body>
<header>
    <div id="topbar">
        <div id="logo"><img src="img/toplogo.png" alt="Logo"/></div>
    </div>
</header>
<main>
    <form action="" method="post">
        <p><?php echo $message; ?></p>
        <div id="folder_selectors">
            <div class="folder_setting" id='html_folder'>
                <p>HTMLファイルの入っているフォルダ</p>
                <?php  if(count($htmlpathes)==0){ ?>
                <select name="html_folder[]" id="html_selector" class="html_selector onChange="selector_change(this)"">
                    <option value="null" selected>未選択</option>
                    <option value="../" >最上階層</option>
                    <?php foreach( $folders as $fs ){ ?>
                    <option value="<?php echo $fs; ?>" ><?php echo substr($fs,1); ?></option>
                    <?php }; ?>
                </select>
                <?php }else{ ?>
                <?php  foreach($htmlpathes as $path){ ?>
                <select name="html_folder[]" id="html_selector" class="html_selector" onChange="selector_change(this)">
                    <option value="null" >未選択</option>
                    <option value="../"<?php if("../"==$path){ echo "selected"; };?> >最上階層</option>
                    <?php foreach( $folders as $fs ){ ?>
                    <option value="<?php echo $fs; ?>" <?php if($fs.'/'==$path){ echo "selected"; };?> ><?php echo substr($fs,1); ?></option>
                    <?php }; ?>
                </select>
                <?php }; ?>
                <select name="html_folder[]" id="html_selector" class="html_selector onChange="selector_change(this)"">
                    <option value="null" selected >未選択</option>
                    <option value="../" >最上階層</option>
                    <?php foreach( $folders as $fs ){ ?>
                    <option value="<?php echo $fs.'/'; ?>" ><?php echo substr($fs,1); ?></option>
                    <?php }; ?>
                </select>
                <?php }; ?>
            </div>
            <div class="folder_setting" id='img_folder'>
                <p>画像ファイルの入っているフォルダ（複数可能）</p>
                <?php  if(count($imgpathes)==0){ ?>
                <select name="img_folder[]" id="img_selector" class="img_selector" onChange="selector_change(this)">
                    <option value="null" selected>未選択</option>
                    <option value="../" >最上階層</option>
                    <?php foreach( $folders as $fs ){ ?>
                    <option value="<?php echo $fs.'/'; ?>" ><?php echo substr($fs,1); ?></option>
                    <?php }; ?>
                </select>
                <?php }else{ ?>
                <?php  foreach($imgpathes as $path){ ?>
                <select name="img_folder[]" id="img_selector" class="img_selector" onChange="selector_change(this)">
                    <option value="null" >未選択</option>
                    <option value="../"<?php if("../"==$path){ echo "selected"; };?> >最上階層</option>
                    <?php foreach( $folders as $fs ){ ?>
                    <option value="<?php echo $fs.'/'; ?>" <?php if($fs.'/'==$path){ echo "selected"; };?> ><?php echo substr($fs,1); ?></option>
                    <?php }; ?>
                </select>
                <?php }; ?>
                <select name="img_folder[]" id="img_selector" class="img_selector" onChange="selector_change(this)">
                    <option value="null" selected>未選択</option>
                    <option value="../" >最上階層</option>
                    <?php foreach( $folders as $fs ){ ?>
                    <option value="<?php echo $fs.'/'; ?>" ><?php echo substr($fs,1); ?></option>
                    <?php }; ?>
                </select>
                <?php }; ?>
            </div>
        </div>
        <input type="submit" value="確定">
    </form>
</main>
</body>
</html>