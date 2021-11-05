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
            console.log(event.target);
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
    
  
    
    var in_tex_tag=['a','p','li','td','h1','h2','h3','h4','h5','address','dd','dt','spans'];
    var in_img_tag=['img'];
    
    var text_place = window.parent.document.getElementById("inner_text");
    var img_name = window.parent.document.getElementById("source_name");
    var img_src = window.parent.document.getElementById("source_url");
    text_place.disabled = true;
    text_place.value = ""; 
    
    if(in_img_tag.includes(target.tagName.toLocaleLowerCase())){
        img_name.innerHTML=target.getAttribute("src").substring(target.getAttribute("src").lastIndexOf("/")+1);
        img_src.value=target.getAttribute("src");
    }else if(in_tex_tag.includes(target.tagName.toLocaleLowerCase())){
        text_place.disabled = false;
        text_place.value = target.innerHTML;
    }
}


