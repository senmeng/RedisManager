<?php
namespace app\index\controller;

use think\Controller;

class Lists extends Controller
{
    public function index()
    {

        $id = input('param.id');
        $k = input('param.k');
        $server = config('redis.servers')[0];
        $db = RedisDB::getInstance($server);
        $info['key'] = $k;
        $info['id'] = $id;
        $info['type'] = $db->type($k);
        $info['val'] = $db->lrange($k,0,10);      
        $info['ttl'] = $db->ttl($k);
        $info['strlen'] = $db->llen($k);
 
        $this->assign('info',$info);        
        return $this->fetch();
    }
}
