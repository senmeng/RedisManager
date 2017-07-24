<?php
namespace app\index\controller;

use think\Controller;

class Hash extends Controller
{
    public function index()
    {

        //$act = input('get.act');
        $k = 'hash';
        $server = config('redis.servers')[0];
        $db = RedisDB::getInstance($server);
        $info['type'] = $db->type($k);
        $info['val'] = $db->hgetall($k);      
        $info['ttl'] = $db->ttl($k);
        $info['strlen'] = $db->hlen($k);

        $this->assign('info',$info);        
        return $this->fetch();
    }
}
