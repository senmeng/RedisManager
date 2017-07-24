<?php
namespace app\index\controller;

use think\Controller;

class Str extends Controller
{
    public function index()
    {

        $id = input('param.id');
        $k = input('param.k');
        $server = config('redis.servers')[0];
        $db = RedisDB::getInstance($server);
        $info['key'] = $k;
        $info['id'] = $id;
        $info['val'] = $db->get($k);
        $info['ttl'] = $db->ttl($k);
        $info['strlen'] = $db->strlen($k);
        

        $this->assign('info',$info);        
        return $this->fetch();
    }
}
