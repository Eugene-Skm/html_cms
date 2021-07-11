// JavaScript Document
var partsselector = document.getElementById("partsselector");

partsselector.addEventListener('change', function (e) {
    
    var sel= document.getElementById("partsselector") ;
    var idx=sel.selectedIndex;
    var keyvalue=sel.options[idx].value;
    
    console.log(keyvalue);
}, false);


// チェックボックス全てを取得
function update(obj) {
    
    var id=obj.id;
    var keyvalue=obj.value;
    if(obj.tagName=="Input"){
        keyvalue="none";
    }
    
    
   //XMLhttp 呼び出し 
}

function xmlhttp_pulldata(){
    
}

function xmlhttp_update(){
    
}