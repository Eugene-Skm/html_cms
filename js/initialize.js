function selector_change(eventor){
	if(eventor.value=='null'){
		eventor.remove();
	}else{
		var selectors=eventor.parentNode.querySelectorAll("select");
		var flg=true;
		selectors.forEach(element => {
			if(element != eventor){
				if(element.value==eventor.value && element.value!="null"){
					console.log(element.value!="null");
					alert("The choice was selected at another box");
					eventor.selectedIndex = 0;
					//eventor.remove();
					flg=false;
				}
			}
		});
		if(flg){
			if(eventor==eventor.parentNode.lastElementChild){
				eventor.parentElement.append(eventor.parentNode.lastElementChild.cloneNode(true));
			}
		}
	}
}

//document.getElementById('img_folder').append(document.getElementById('img_selector').cloneNode(true));
//eventor.parentElement.append(eventor.cloneNode(true));
//上二つ同一