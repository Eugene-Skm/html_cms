// JavaScript Document
$(function () {
    $('#htmlframe').on('load', function () {
        $('#htmlframe').contents().find('head').append('<link class="temporary_script" rel="stylesheet" href="./htmluser/frame_inner_scripts/frame_inner.css">');
       // $('#htmlframe').contents().find('head').append('<script class="temporary_script" src="//code.jquery.com/jquery-1.11.1.min.js"></script>');
       // $('#htmlframe').contents().find('head').append('<script class="temporary_script" src="../js/jquery-3.6.0.min.js></script>');
        set_js();
    });
});

function set_js() {    
    var pare = document.getElementById("htmlframe");
    var pareelem = pare.contentWindow.document.querySelector('html');
    var element = document.createElement("script");
    element.setAttribute("class", "temporary_script");
    element.setAttribute("type", "text/javascript");
    element.setAttribute("src", "./htmluser/frame_inner_scripts/frame_inner.js");
    var flg=pareelem.insertBefore(element, null);
}