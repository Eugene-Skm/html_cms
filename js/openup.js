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
        this.PID=null;
        this.id=null
        this.fn=null
    }
    setfile(fn) {
        this.fn=fn;
    }
    setid(id){
        this.id=id;
    }
 
    setMethodtype(processID) {
        switch(processID){
            case "ini":
                this.PID="ini";
                break;
            case "upd":
                this.PID="upd";
               break;
        }
        
        
    }
    
     mainmethod(st1,st2){
        //get用 statement処理
        console.log(this.PID);
        if(this.PID=="ini"){
            this.statement='st='+this.PID+"&fnm="+this.fn;
        }else if(this.PID=="upd"){
            this.statement='st='+this.PID+"&id="+this.id+"&tag="+st1+"&val="+st2+"&fnm="+this.fn;
        }
        //Xmlhttp 開始
        
        var request = new XMLHttpRequest();
        request.open('GET', "./xmlhttp_gate.php?"+this.statement , true);
         console.log("./xmlhttp_gate.php?"+this.statement);
        request.responseType = 'text';
        request.addEventListener('load', function (response) {
          // JSONデータを受信した後の処理
            _returnValues=this.response;
            //upd(_returnValues);
            upd(_returnValues);
        });
        request.send();
        
    }
    upd(_returnValues){
        document.getElementById("svg_view").innerHTML=_returnValues;
    }

    
}