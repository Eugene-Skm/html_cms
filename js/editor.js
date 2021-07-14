// JavaScript Document
var partsselector = document.getElementById("partsselector");
var pullup=new Xmlgate();

pullup.setfile(getFname());
xmlhttp_pulldata();
console.log();
function getFname(){
    var queryString = window.location.search;
    var queryObject = new Object();
    if(queryString){
      queryString = queryString.substring(1);
      var parameters = queryString.split('&');

      for (var i = 0; i < parameters.length; i++) {
        var element = parameters[i].split('=');

        var paramName = decodeURIComponent(element[0]);
        var paramValue = decodeURIComponent(element[1]);

        queryObject[paramName] = paramValue;

      }
    }    
    
    return queryObject["name"];
}


partsselector.addEventListener('change', function (e) {
    
    var sel= document.getElementById("partsselector") ;
    var idx=sel.selectedIndex;
    var keyvalue=sel.options[idx].value;
    pullup.setid(keyvalue);
    xmlhttp_pulldata(keyvalue);
}, false);


function update(obj) {
        console.log(obj);
    var id=obj.id;
    var keyvalue=obj.value;
    if(obj.id.includes("-effective")){
        if(document.getElementById(id).checked==true){
            keyvalue="none";
        }else{
            keyvalue=document.getElementById(id.replace("-effective","")).value;
        }
        
    }
    keyvalue=keyvalue.replace("#","");
    id=id.replace("-effective","");
    console.log(id,keyvalue);
    xmlhttp_update(id,keyvalue);
}



function xmlhttp_pulldata(id){
    if(id==null){
        pullup.setMethodtype("ini");
        console.log("B");
    }else{
        pullup.setMethodtype("geteach"); 
        console.log("X");
    }
    
    pullup.mainmethod(id);
}

function xmlhttp_update(tag,value){
    pullup.setMethodtype("upd");
    pullup.mainmethod(tag,value);
}

function xmlhttp_close(){
    pullup.setMethodtype("cls");
    pullup.mainmethod();
    window.location.href = './svg_editor_list.php';
}