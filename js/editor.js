// JavaScript Document
var partsselector = document.getElementById("partsselector");
var pullup = new Xmlgate();

pullup.setfile(getFname());
xmlhttp_pulldata();

history.pushState(null, null, null);
window.addEventListener("popstate", function (e) {

    history.pushState(null, null, null);
    return;

});


function getFname() {
    var queryString = window.location.search;
    var queryObject = new Object();
    if (queryString) {
        queryString = queryString.substring(1);
        var parameters = queryString.split('&');

        for (var i = 0; i < parameters.length; i++) {
            var element = parameters[i].split('=');

            var paramName = decodeURIComponent(element[0]);
            var paramValue = decodeURIComponent(element[1]);

            queryObject[paramName] = paramValue;

        }
    }

    return queryObject["name"];
}


partsselector.addEventListener('change', function (e) {

    var sel = document.getElementById("partsselector");
    var idx = sel.selectedIndex;
    var keyvalue = sel.options[idx].value;
    document.getElementById("properties").reset();
    pullup.setid(keyvalue);
    xmlhttp_pulldata(keyvalue);
}, false);


function update(obj) {
    console.log(obj);
    var id = obj.id;
    var keyvalue = obj.value;
    if (obj.id.includes("-effective") || obj.id == "display") {
        if (document.getElementById(id).checked == true) {
            keyvalue = "none";
        } else {
            if (obj.id != "display") {
                keyvalue = document.getElementById(id.replace("-effective", "")).value;
            } else {
                keyvalue = "inline";
            }
        }
    }
    keyvalue = keyvalue.replace("#", "");
    id = id.replace("-effective", "");
    xmlhttp_update(id, keyvalue);
}


function xmlhttp_pulldata(id) {
    if (id == null) {
        pullup.setMethodtype("ini");
    } else {
        pullup.setMethodtype("geteach");
    }
    pullup.mainmethod(id);
}

function xmlhttp_update(tag, value) {
    pullup.setMethodtype("upd");
    pullup.mainmethod(tag, value);
}

function xmlhttp_close() {
    pullup.setMethodtype("cls");
    pullup.mainmethod();
    window.location.href = './img_list.php?pattern=img_edit';
}
