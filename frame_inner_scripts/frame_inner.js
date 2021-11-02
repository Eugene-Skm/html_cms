// JavaScript Document
setTimeout(function () { //iframe内 load待ち対策

    //----------------------再起処理　ここから------------------------
    //バブリング解決したから？？Z-indexいらんくね
  /*  function strongLink(node, layer) {
        if (node.nodeName === 'p' || node.nodeName === 'P') {
            //特定要素に対する処理
        }
        try {
            node.style.zIndex = layer;
        } catch (e) {}
        for (let i = 0; i < node.childNodes.length; i++) {
            strongLink(node.childNodes[i], layer + 1); //再帰的呼び出し
        }
    }
    //再起呼び出し　スタート地点　スクリプト言語のため呼び出し対象の後ろ側に来る
    let contents = document.querySelector("html");
    strongLink(contents, 0);*/
    //----------------------再起処理　ここまで------------------------

    var elementlist = document.querySelectorAll('*');
    //elementlist.shift();
    for (var i = 0; i < elementlist.length; i++) {

        elementlist[i].addEventListener('click', function (event) {
            //イベントバブリング　https:
            //ja.javascript.info/bubbling-and-capturing
            //イベントバブリング停止　
            //https://itsakura.com/javascript-bubbling
            event.stopPropagation();
            console.log(event.target);
            try {
                //前回別カ所で作成されたtemp_idの削除
                document.getElementById("temp_id").id = "";
            } catch (e) {}

            //idが無い場合、一時的に仮のidを作成
            if (event.target.id == null || event.target.id == "") {
                event.target.id = "temp_id";
            }

            //親iframe内要素に情報をセット
            var titlecall = window.parent.document.getElementById("htmlt");
            titlecall.innerHTML = event.target.tagName;
        }, true);
    };

}, 2000);
