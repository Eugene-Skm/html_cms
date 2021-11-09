function path_calclater(base_path,target_path){
    var samepoint=0;
    for(var y=0; y < base_path.length; y++ ){
        if (base_path[y] == target_path[y]){
            samepoint = y;
        }else{
            break;
        }
    }
    console.log(samepoint);
    var seme_base = base_path.substring(0,samepoint);
    
    var base_home_path = base_path.substring(samepoint );
    var target_home_path = target_path.substring(samepoint );
    console.log(base_home_path,target_home_path);
    
    var slashcount = ( base_home_path.match( /\\/g ) || [] ).length;
        target_home_path=target_home_path.slice(1);
        var prep_url="";
        var uping ="..\\";
    console.log(slashcount);
    for(var t=0; t<slashcount-1; t++ ){
        prep_url += uping;
    }
    
    var relative_path = prep_url + target_home_path;
    
    return relative_path.replaceAll(/\\/g,"/") ;
}