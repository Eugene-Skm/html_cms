// JavaScript Document
var partsselector = document.getElementById("partsselector");

partsselector.addEventListener('change', function (e) {
    console.log("A");
}, false);


// チェックボックス全てを取得
function update(obj) {
    
    id=obj.id;
    keyvalue=obj.value;
    if(obj.tagName=="Input"){
        keyvalue="none";
    }
    
    
   //XMLhttp 呼び出し 
}
