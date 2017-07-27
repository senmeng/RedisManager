if(window.localStorage) {
    getNavMenuCache();       
}else{
    getNavMenu(); 
}   
function getNavMenu(){
    $.post('/api/category/navMenu',function(data) {
        if (data) {  
            if(window.localStorage) {                                
                console.log('写入NavMenuCache');    
                store.set('NavMenu',data); 
            }
            setNavMenu(data); 
        }
    })
}  

function getNavMenuCache(){                                       
    var list = store.get('NavMenu');
    if(list){
        setNavMenu(list);
        return true;
    }
    getNavMenu();                    
}

function setNavMenu(data){
    var html = '';
    $(data).each(function(index,item){
        html += '<li class="active"><a href="/'+item.alias+'/'+item.id+'.html" title="'+item.name+'">'+item.name+'</a></li>';
    });
    $(".navbar-nav :first").after(html);
}