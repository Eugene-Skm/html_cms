// JavaScript Document

var _returnValues;

function setTagdata(_returnValue) {
    _returnValue=JSON.parse(_returnValue);
    var elemelist=document.getElementsByClassName("property_val");
    var idlist=[];
    var searchtag="";
    for(var eleme of elemelist ){
        idlist.push(eleme.id);
    }
    for(const key in _returnValue ){
        searchtag=key;
        if(key=="fill"||key=="stroke"){
            if(_returnValue[key]=="none"){
                searchtag=key+"-effective"
            }
        }
        
        if(idlist.includes(searchtag)){
            
            if(searchtag.includes("-effective")){
                document.getElementById(searchtag).checked=true;    
            }else if(searchtag=="display"&&_returnValue[searchtag]=="none"){
                document.getElementById(searchtag).checked=true;    
            }else{
                document.getElementById(searchtag).value=_returnValue[key];
            }
        }
    }
}

function upd(_returnValues) {
    document.getElementById("svg_view").innerHTML = _returnValues;
}
function savechecked(){
    
}


class Xmlgate {
    constructor() {
        this.PID = null;
        this.id = null
        this.fn = null
    }
    setfile(fn) {
        this.fn = fn;
    }
    setid(id) {
        this.id = id;
    }

    setMethodtype(processID) {
        switch (processID) {
            case "ini":
                this.PID = "ini";
                break;
            case "upd":
                this.PID = "upd";
                break;
            case "geteach":
                this.PID = "ged";
                break;
            case "cls":
                this.PID = "cls";
                break;
        }
    }
    
    mainmethod(st1, st2) {
        //get用 statement処理
        if (this.PID == "ini"||this.PID == "cls") {
            this.statement = 'st=' + this.PID + "&fnm=" + this.fn;
        } else if (this.PID == "upd") {
            this.statement = 'st=' + this.PID + "&fnm=" + this.fn+ "&id=" + this.id + "&tag=" + st1 + "&val="+ st2;
        }else if (this.PID == "ged") {
            this.statement = 'st=' + this.PID + "&fnm=" + this.fn+"&id="+st1;
        }
        //Xmlhttp 開始

        var request = new XMLHttpRequest();
        request.open('GET', "./xmlhttp_gate.php?" + this.statement, true);
        request.responseType = '';
        console.log(this.statement);
        request.addEventListener('load', function (response) {
            // JSONデータを受信した後の処理
            _returnValues = this.response;
            console.log(_returnValues);
            if(_returnValues=="saved"){
               savechecked();
            }else if(!isJson(_returnValues)){
               upd(_returnValues);
            }else{
                setTagdata(_returnValues);
            }
            request.abort();
            
        });
        request.send();
    }
}
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}