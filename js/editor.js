// JavaScript Document
var partsselector = document.getElementById("partsselector");
var pullup=new Xmlgate();

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
    pullup.setfile(queryObject["name"]);
    xmlhttp_pulldata();
}



partsselector.addEventListener('change', function (e) {
    
    var sel= document.getElementById("partsselector") ;
    var idx=sel.selectedIndex;
    var keyvalue=sel.options[idx].value;
    pullup.setid(keyvalue);
    console.log(keyvalue);
}, false);


// チェックボックス全てを取得
function update(obj) {
    
    var id=obj.id;
    var keyvalue=obj.value;
    if(obj.tagName=="Input"){
        keyvalue="none";
    }
    console.log("A");
    xmlhttp_update(id,keyvalue);
    
   //XMLhttp 呼び出し 
}



function xmlhttp_pulldata(){
    pullup.setMethodtype("ini");
    pullup.mainmethod();
}

function xmlhttp_update(tag,value){
    pullup.setMethodtype("upd");
    pullup.mainmethod(tag,value);
    
}