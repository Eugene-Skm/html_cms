<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Untitled Document</title>
    <script src="js/uploadscript.js" defer></script> 
    <script src="upload_svg.php" defer></script>
</head>
<body>
<form action="./upload_svg.php" method="POST" enctype="multipart/form-data">
    <div id="drop-zone" style="border: 1px solid; padding: 30px;">
        <p>ファイルをドラッグ＆ドロップもしくは</p>
        <input type="file" name="file" id="file-input">
        <input type="submit" style="margin-top: 50px">
    </div>
    <h2>アップロードした画像</h2>
    <div id="preview"></div>
</form>
<?php echo "こんにちは"; ?>
</body>
</html> 