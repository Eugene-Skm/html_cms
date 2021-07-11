// JavaScript Document

var _returnValues;
function postSend(fnm) {
    var request = new XMLHttpRequest();
    request.open('GET', "./xmlhttp_gate.php?fnm="+fnm , true);
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
    document.getElementById("svg_view").innerHTML=_returnValues;
    
}


class Xmlgate{
 
    constructor() {
        this.PID = "";
    }
    
 
    setMethodtype(processID) {
        switch(processID){
            case "initialize":
                this.PID="ini";
                break;
            case "update":
                this.PID="ini";
               break;
        }
    }
    
    function mainmethod(st1,st2=null){
        //get用 statement処理
        var statement="";
        if(this.PID=="ini"){
            statement='st='+st1;
        }else if(this.PID=="ini"){
            
        }
        
        //Xmlhttp 開始
        
        
        
        
    }
    
}