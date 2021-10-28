// JavaScript Document
function set_image(fname){
    var oldpath=document.getElementById("old_file_path").value;
    var oldfiletype=oldpath.slice(oldpath.lastIndexOf(".")).toLowerCase();
    var newfiletype=fname.slice(fname.lastIndexOf(".")).toLowerCase();
    
    
    
    if(oldfiletype==newfiletype){
        document.getElementById("new_file_name").innerHTML = fname;
        document.getElementById("new_file_img").src = fname;
        document.getElementById("new_file_path").value = fname;
    }else{
        alert("ふぁいるたいぷが異なります。")
    }
       
    
    
    //make_hidden('new_file_path', fname);
}
