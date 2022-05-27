<?php
include('./class_file_io.php');

$way="";
if ( isset( $_GET[ 'way' ] ) ) {
	$way= $_GET[ 'way' ];
}
$path="";
if ( isset( $_GET[ 'path' ] ) ) {
	$path= $_GET[ 'path' ];
}
if($way == 'dl' ){
	$dl_io= new file_io( $path );
	//$return=$dl_io-> dl();
	if($dl_io-> dl()){
		echo "<script type='text/javascript'>window.close();</script>";
	}
}

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
	<?php if($way == 'dl' ){ ?>

	<?php } ?>
</main>
</body>
</html>
