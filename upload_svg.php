<?php
$tempfile = $_FILES['file']['tmp_name'];
$filename = './img/'.$_FILES['file']['name'];

if (is_uploaded_file($tempfile)) {
    if (move_uploaded_file($tempfile, $filename)) {
        echo $filename . "をアップロードしました。";
    }
}
?>