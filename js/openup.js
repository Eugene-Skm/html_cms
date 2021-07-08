// JavaScript Document

var _returnValues;
function postSend(st,fnm) {
    var request = new XMLHttpRequest();
    request.open('GET', "./xmlhttp_gate.php?st="+st+"&fnm="+fnm , true);
    request.responseType = 'text';
    request.addEventListener('load', function (response) {
      // JSONデータを受信した後の処理
        _returnValues=this.response;
        upd(_returnValues);
    });
    request.send();
}
function upd(_returnValues){
  var time=Math.random().toString();
    
    //document.getElementById("svg_view").innerHTML="<img src='./tmp/"+fn+".svg?"+time+"' alt='svg' id='svgview'/>"
    document.getElementById("svg_view").innerHTML=_returnValues;
    
}


