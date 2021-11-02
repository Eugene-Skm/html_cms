// JavaScript Document
$(function(){
    $('#htmlframe').on('load', function(){
        $('#htmlframe').contents().find('head').append('<link rel="stylesheet" href="../frame_inner_scripts/frame_inner.css">');
        $('#htmlframe').contents().find('head').append('<script type="text/javascript" src="../frame_inner_scripts/frame_inner.js"></script>');
    });
});