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
            var titlecall = window.parent.document.getElementById("targeted_id");
            titlecall.innerHTML = event.target.tagName;
            
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
            console.log(event.target);
        }, true);
    };
    loaded();
}, 10);

function loaded(){
    var loadpanel = window.parent.document.getElementById("loading_panel");
    loadpanel.style.display='none'
}
function info_set(){
    
}
