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
    
    var in_tex_tag=['p','li','td','h1','h2','h3','h4','h5','address','dd','dt','span','strong','b','i','u'];
    var in_img_tag=['img'];
    var in_link_tag=['a'];
    var duplicatable_tag=['li','ul','ol','table','td','tr','dt','dd'];
    
    var textarea_text_place = window.parent.document.getElementById("inner_text");
    var button_big_editor = window.parent.document.getElementById("big_editor");
    var label_img_name = window.parent.document.getElementById("img_name");
    var button_img_change = window.parent.document.getElementById("img_select");
    var hidden_img_src = window.parent.document.getElementById("img_url");
    var link_text = window.parent.document.getElementById("link_text");
    var link_url = window.parent.document.getElementById("link_url");
    var li_duplicater = window.parent.document.getElementById("duplicater");
    var duplic_title = window.parent.document.getElementById("duplicate_title");
    var sorter_title = window.parent.document.getElementById("sorter_title");
    var sorter = window.parent.document.getElementById("sorter");
    var remover = window.parent.document.getElementById("remover");
    
    textarea_text_place.disabled = true;
    textarea_text_place.value = ""; 
    button_big_editor.disabled=true;
    
    label_img_name.innerHTML="";
    label_img_name.disabled=true;
    button_img_change.disabled=true;
    hidden_img_src.value="";
    
    link_text.disabled=true;
    link_text.value = "";
    link_url.disabled=true;
    link_url.value="";
    
    li_duplicater.disabled =true;
    sorter.disabled=true;
    remover.disabled=false;
    
    var ttag=target.tagName.toLocaleLowerCase();
    if(in_img_tag.includes(ttag)){
        label_img_name.innerHTML=target.getAttribute("src").substring(target.getAttribute("src").lastIndexOf("/")+1);
        hidden_img_src.value=target.getAttribute("src");
        button_img_change.disabled=false;
    }else if(in_tex_tag.includes(ttag)){
        textarea_text_place.disabled = false;
        textarea_text_place.value = set_break(target.innerHTML);
        button_big_editor.disabled=false;
    }else if(in_link_tag.includes(ttag)){
        link_text.disabled = false;
        link_text.value = target.innerHTML;
        link_url.disabled=false;
        link_url.value=target.getAttribute("href");
    }
    if(duplicatable_tag.includes(ttag)){
        var title="" 
       if(duplicatable_tag.slice(0,3).includes(ttag)){
            title="リスト要素 'li' "
        }else if(duplicatable_tag.slice(3,6).includes(ttag)){
            title="テーブル行 'tr' "
        }else if(duplicatable_tag.slice(6).includes(ttag)){
            title="記述型リスト 'dt・dd' "
        }
        
        li_duplicater.disabled = false;
        duplic_title.innerHTML =title+" 要素追加";
        if(ttag != "dd" && ttag != "dt"){
            sorter.disabled = false;    
            sorter_title.innerHTML=title+ " 入替"
        }
        
    }
}

function set_break(value){
    var val = value.replaceAll("><",">\n<");
    var val = val.replaceAll(">",">\n");
    var val = val.replaceAll("<","\n<");
    var val = val.replaceAll("\n\n","");
    return val;
}
