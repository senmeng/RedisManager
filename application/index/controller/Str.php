<?php
namespace app\index\controller;

use think\Controller;

class Str extends Controller
{
    public function index()
    {
        // Setup a connection to Redis.
        // $key = 0;
        // $server = config('redis.servers')[0];
        // $db = RedisDB::getInstance($server);
        // $info = $db->info();

        // $this->assign('k',$key);
        // $this->assign('info',$info);
        echo 2;
        //return $this->fetch();
    }
}
