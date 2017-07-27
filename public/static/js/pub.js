var h = '';
function getTree(data, sub = '') {    
    $(data).each(function(index,item){
        h += '<option value='+item.id+'>'+sub+item.name+'</option>'; 
        if (item.sub && item.sub.length > 0) {
            getTree(item.sub,sub+'|---');
        }
    });
    return h;
}