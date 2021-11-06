// JavaScript Document
setTimeout(function () { //iframe内 load待ち対策

    var elementlist = document.querySelectorAll('*');
    for (var i = 0; i < elementlist.length; i++) {

        elementlist[i].addEventListener('click', function (event) {
            //イベントバブリング停止　
            //https://itsakura.com/javascript-bubbling
            event.stopPropagation();　//イベントバブリング停止　
            
            event.preventDefault();　　//デフォルトクリックイベント停止
            try {
                //前回別カ所で作成されたtemp_idの削除
                document.getElementById("temp_id").id = "";
            } catch (e) {}

            //idが無い場合、一時的に仮のidを作成
            if (event.target.id == null || event.target.id == "") {
                event.target.id = "temp_id";
            }

            //親iframe内要素に情報をセット
            info_set(event.target);
            
        }, true);
        
        //https://ja.javascript.info/mousemove-mouseover-mouseout-mouseenter-mouseleave
        elementlist[i].addEventListener('mouseover', function (event) {
            event.stopPropagation();　//イベントバブリング停止　
            event.target.classList.add("hovered");
        }, true);
        
        elementlist[i].addEventListener('mouseout', function (event) {
            event.stopPropagation();　//イベントバブリング停止　
            event.target.classList.remove("hovered");
        }, true);
    };
    loaded();
}, 10);

function loaded(){
    var loadpanel = window.parent.document.getElementById("loading_panel");
    loadpanel.style.display='none'
}
function info_set( target ){
    var titlecall = window.parent.document.getElementById("targeted_tag");
    var titlecall2 = window.parent.document.getElementById("targeted_id");
    titlecall.innerHTML = target.tagName;
    titlecall2.value = target.id;
    
    var in_tex_tag=['a','p','li','td','h1','h2','h3','h4','h5','address','dd','dt','span'];
    var in_img_tag=['img'];
    
    var textarea_text_place = window.parent.document.getElementById("inner_text");
    var button_big_editor = window.parent.document.getElementById("big_editor");
    var label_img_name = window.parent.document.getElementById("img_name");
    var button_img_change = window.parent.document.getElementById("img_select");
    var hidden_img_src = window.parent.document.getElementById("img_url");
    
    textarea_text_place.disabled = true;
    textarea_text_place.value = ""; 
    button_big_editor.disabled=true;
    
    label_img_name.innerHTML="";
    label_img_name.disabled=true;
    button_img_change.disabled=true;
    hidden_img_src.value="";
    
    if(in_img_tag.includes(target.tagName.toLocaleLowerCase())){
        label_img_name.innerHTML=target.getAttribute("src").substring(target.getAttribute("src").lastIndexOf("/")+1);
        hidden_img_src.value=target.getAttribute("src");
        button_img_change.disabled=false;
    }else if(in_tex_tag.includes(target.tagName.toLocaleLowerCase())){
        textarea_text_place.disabled = false;
        textarea_text_place.value = set_break(target.innerHTML);
        button_big_editor.disabled=false;
    }
}

function set_break(value){
    var val = value.replaceAll("><",">\n<");
    var val = val.replaceAll(">",">\n");
    var val = val.replaceAll("<","\n<");
    var val = val.replaceAll("\n\n","");
    return val;
}
