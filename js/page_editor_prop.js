setTimeout(function(){

    
    document.getElementById('inner_text').addEventListener('input', function(){
        var content = document.getElementById('inner_text').value;
        var id =  document.getElementById('targeted_id').value;
        var type = "text";
       change_html(id, content, type );
        
    });
    
            const elem = document.getElementById('htmlframe');
            const target = elem.contentWindow.document.querySelector('html');
            console.log("C");
            //console.log(target.innerHTML);
            //target.style.textAlign = 'right';
        
        $('#htmlframe').on('load', function() {
                var iframe = $("#htmlframe");
               // console.log(iframe.contents().find('html').html() );
        });
},20);
function text_change(){
    
}

function change_html(id,cont ,type){
            var o_iframe = document.getElementById('htmlframe');
            var text = o_iframe.contentWindow.document.getElementById(id);
            console.log(id);
            if(type=="text"){
                text.innerHTML = cont;
            }
}

           /* var iframe = document.getElementById('htmlframe'); 
            var innerDoc = iframe.contentDocument || iframe.contentWindow.document; 
            console.log("A");
            //console.log(innerDoc);
            
            var doc = document.getElementsByTagName("iframe")[0].contentWindow.document;
            console.log("B");
            //console.log(doc);*/
