// JavaScript Document
$(function () {
    $('#htmlframe').on('load', function () {
        $('#htmlframe').contents().find('head').append('<link id="temporary_css" rel="stylesheet" href="../frame_inner_scripts/frame_inner.css">');
        $('#htmlframe').contents().find('head').append('<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>');
        $('#htmlframe').contents().find('head').append('<script src="../js/jquery-3.6.0.min.js');
        set_js();
    });
});

function set_js() {    
    var pare = document.getElementById("htmlframe");
    var pareelem = pare.contentWindow.document.querySelector('html');
    var element = document.createElement("script");
    element.setAttribute("id", "temporary_script");
    element.setAttribute("type", "text/javascript");
    element.setAttribute("src", "../frame_inner_scripts/frame_inner.js");
    var flg=pareelem.insertBefore(element, null);
}