setTimeout(function () {
    //テキストイベントリスナー　
    document.getElementById('inner_text').addEventListener('input', function () {
        var content = document.getElementById('inner_text').value;
        var id = document.getElementById('targeted_id').value;
        var type = "text";
        change_html(type, content);
    });
    document.getElementById('link_text').addEventListener('input', function () {
        var content = document.getElementById('link_text').value;
        var id = document.getElementById('targeted_id').value;
        var type = "link_text";
        change_html(type, content);
    });
    document.getElementById('link_url').addEventListener('input', function () {
        var content = document.getElementById('link_url').value;
        var id = document.getElementById('targeted_id').value;
        var type = "link_url";
        change_html(type, content);
    });
    document.getElementById('img_url').addEventListener('change', function () {
        var content = document.getElementById('img_url').value;
        var place = document.getElementById('targeted_id');
        place.src = content;
    });
    

}, 20);

function img_selector_open() {
    window.open('page_img_list.php?pattern=img_select', '差替選択', 'width=950,height=650,left=20%,toolbar=no,menubar=no,scrollbars=yes');
    window.onstorage = event => {
        if (event.key === 'new_img') {
            // msg というキーに値が設定されたらその新しい値を表示
            var targetpath=decodeURIComponent(event.newValue);
            var o_iframe = document.getElementById('htmlframe');
            var id = document.getElementById('targeted_id').value;
            var target = o_iframe.contentWindow.document.getElementById(id);
            document.getElementById("dialog").style.display="inline-block";
            
            var base = document.getElementById("abs_path").value;
            document.getElementById("alt_input").value=target.getAttribute("alt");
            rl_cont_path= path_calclater(base, targetpath);
            document.getElementById("rl_path").value=rl_cont_path;
            console.log(rl_cont_path);
            if(target.parentElement.tagName.toLocaleLowerCase()=="a"){
                document.getElementById("a_alert").style.display="inline-flex";
                document.getElementById("nowurl").innerHTML= target.parentElement.getAttribute('href') ;
                document.getElementById("newimgurl").innerHTML= rl_cont_path ;
            }
            
        }
    };
}
function call_change_html_from_dialog(){
    try{
    var type = "img";
    let elements = document.getElementsByName('use_a_way');
    let len = elements.length;
    let targetval = '';
    for (let i = 0; i < len; i++){
        if (elements.item(i).checked){
            targetval = elements.item(i).value;
        }
    }
    var new_alt=document.getElementById("alt_input").value;
    var img_path=img_path=document.getElementById("rl_path").value;
    console.log(img_path);
    var new_a_path=document.getElementById(targetval).value || document.getElementById(targetval).innerHTML;
    }catch{}
    
    document.getElementById("dialog").style.display="none";
    change_html(type,new_alt,img_path,new_a_path);
}

function change_html(type, cont, cont2=null, cont3=null) {
    var o_iframe = document.getElementById('htmlframe');
    var id = document.getElementById('targeted_id').value;
    var target = o_iframe.contentWindow.document.getElementById(id);
    if (type == "text") {
        target.innerHTML = cont;
    } else if (type == "img") {
        var label_img_name = document.getElementById("img_name");
        label_img_name.innerHTML = cont2.substring(cont2.lastIndexOf('\\') + 1);
        target.alt=cont;
        target.src = cont2;
        if(cont3!=""){
            target.parentElement.href=cont3;
        }
    }else if( type=="link_text"){
        target.innerHTML=cont;
    }else if( type=="link_url"){
        target.href=cont;
    }
    
}
function change_paretnt_a(obj_path){
    var id = document.getElementById('targeted_id').value;
    var o_iframe = document.getElementById('htmlframe');
    var target = o_iframe.contentWindow.document.getElementById(id);
    target.parentElement.href=obj_path;
}

function save_close(){
    var iframe = document.getElementById('htmlframe'); 
    var f_name = document.getElementById("htmlt").innerHTML;
    var elementlist = iframe.contentWindow.document.querySelectorAll('*');
    for (var i = 0; i < elementlist.length; i++) {
    var targetclass=elementlist[i].getAttribute("class");
        if(targetclass == null || targetclass == undefined || targetclass == ""  ){
            
            elementlist[i].removeAttribute("class");
        }
    }
    var tmpelementlist = iframe.contentWindow.document.querySelectorAll(".temporary_script");
    for (var i = 0; i < elementlist.length; i++) {
        var e = tmpelementlist[i];
        if (e) {
          e.parentNode.removeChild(e);
        }
    }
    
    var innerDoc = iframe.contentDocument || iframe.contentWindow.document; 
    var targettext=innerDoc.body.parentElement.innerHTML;
    targettext = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n<html>\n' + targettext + '\n</html>';
    const hex_targettext_array = string_to_utf8_hex_string(targettext).match(/.{1,1000}/g);
    callxmlhttp(hex_targettext_array,f_name);
}

function callxmlhttp(contents, fn ){
    var pagecount=contents.length;
    for(var u=0; u<contents.length; u++){
        var currentpage= u + 1;
        
        var statement= "fname=" + fn +"&cont="+contents[u]+"&cpage="+currentpage +"&psum="+pagecount;

        html_xmlhttp_gate(statement)
    }
    window.location.href = './page_html_list.php';    
}

function html_xmlhttp_gate(sttext){
    var request = new XMLHttpRequest();
        request.open('GET', "./gate_xmlhttp_html.php?" + sttext, true);
        request.responseType = '';
       /* request.addEventListener('load', function (response) {
            // JSONデータを受信した後の処理
            _returnValues = this.response;
            request.abort();
        });*/
        request.send();
}
