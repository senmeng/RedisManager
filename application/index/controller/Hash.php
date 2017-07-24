<?php
namespace app\index\controller;

use think\Controller;

class Hash extends Controller
{
    public function index()
    {

        $k = input('param.k');
        $server = config('redis.servers')[0];
        $db = RedisDB::getInstance($server);
        $info['key'] = $k;
        $info['type'] = $db->type($k);
        $info['val'] = $db->hgetall($k);      
        $info['ttl'] = $db->ttl($k);
        $info['strlen'] = $db->hlen($k);

        $this->assign('info',$info);        
        return $this->fetch();
    }
}
