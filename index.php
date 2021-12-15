<?php
if(!file_exists('./data/profile.csv')){
    header('Location: ./page_initialize.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無題ドキュメント</title>
<link href="css/common.css" type="text/css" charset="utf-8" rel="stylesheet"/>
<link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    <div id="topbar">
        <div id="logo"><img src="img/toplogo.png" alt="Logo"/></div>
    </div>
</header>
<main>
    <ul>
        <li>
            <div class="basic_name">
                <a href="page_html_list.php?way=view"></a>
                <img src="SVG/view-editor.svg">
                <p>HTMLビューエディタ</p>
            </div>
        </li>
        <li>
            <div class="basic_name">
                <a href="page_html_list.php?way=code"></a>
                <img src="SVG/editor.svg">
                <p>HTMLコードエディタ</p>
            </div>
        </li>
        <li>
            <div class="basic_name">
                <a href="page_img_list.php?pattern=img_edit"></a>
                <img src="SVG/imagemanagement.svg">
                <p>画像管理</p>
            </div>
        </li>
        <li>
            <div class="basic_name">
                <a href="page_img_list.php?pattern=img_edit"></a>
                <img src="SVG/filemanagement.svg">
                <p>ファイル管理</p>
            </div>
        </li>
        <li>
            <div class="basic_name">
                <a href="page_html_list.php"></a>
                <img src="SVG/upload.svg">
                <p>アップロード</p>
            </div>
        </li>
        <li>
            <div class="basic_name">
                <a href="page_html_list.php"></a>
                <img src="SVG/download.svg">
                <p>ダウンロード</p>
            </div>
        </li>
        <li>
            <div class="basic_name">
                <a href="page_initialize.php"></a>
                <img src="SVG/setting.svg">
                <p>設定</p>
            </div>
        </li>
    </ul>
</main>
</body>
</html>