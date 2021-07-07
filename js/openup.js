// JavaScript Document

var _returnValues;
function postSend(st,fnm) {
    var request = new XMLHttpRequest();
    request.open('GET', "./xmlhttp_gate.php?st="+st+"&fnm="+fnm , true);
    request.responseType = 'text';
    request.addEventListener('load', function (response) {
      // JSONデータを受信した後の処理
        _returnValues=response;
        upd();
    });
    request.send();
}
function upd(){
        console.log("A");
    document.getElementById("svgview").alt="setd";
}