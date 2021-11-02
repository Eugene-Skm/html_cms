// JavaScript Document
setTimeout(function(){
    var li = document.getElementsByTagName('dd');
    console.log(li.length);
    for (var i=0; i < li.length; i++) {

         li[i].addEventListener('click', function() {
             
            if(this.id==null||this.id==""){
                this.id="temp_id";
            }
            
             var btn2=window.parent.document.getElementById("htmlt");
             btn2.innerHTML = this.id;
    },false);
    };

},2000);
