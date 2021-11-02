// JavaScript Document
$(function(){
    $('#htmlframe').on('load', function(){
        $('#htmlframe').contents().find('head').append('<link id="temporary_css" rel="stylesheet" href="../frame_inner_scripts/frame_inner.css">');
        $('#htmlframe').contents().find('head').append('<script　id="temporary_script" type="text/javascript" src="../frame_inner_scripts/frame_inner.js"></script>');
    });
});