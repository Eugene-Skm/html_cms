function deleteconfirm(fname){
    var result = window.confirm(fname + ' を削除してもよろしいでしょうか');
    if(result){
        window.open('replace_file_back.php?del_file_path=./SVG/'+ fname,'削除','width=900,height=650,toolbar=no,menubar=no,scrollbars=yes');    
    }else{
        alert("キャンセルされました。")
    }
    
}

function send_img_data(data){
    console.log(data);
    localStorage.setItem('new_img',data);
    //window.close();
}
//onClick="window.open('replace_file_back.php?del_file_path=./SVG/<?php echo basename($f) ;?>','削除','width=900,height=650,toolbar=no,menubar=no,scrollbars=yes')"