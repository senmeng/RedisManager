<?php
namespace app\index\controller;

use think\Controller;

class Set extends Controller
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
        $info['val'] = $db->smembers($k);      
        $info['ttl'] = $db->ttl($k);
        $info['strlen'] = $db->scard($k);
   
        $this->assign('info',$info);        
        return $this->fetch();
    }
}
