<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        // Setup a connection to Redis.
        $key = 0;
        $server = config('redis.servers')[0];
        $db = RedisDB::getInstance($server);
        $info = $db->info();

        $this->assign('k',$key);
        $this->assign('info',$info);
        return $this->fetch();
    }

    public function db_list(){
        
        $server = config('redis.servers')[0];
        $db = RedisDB::getInstance($server);
        $info = $db->info();
        $db_count = $db->config('GET', 'databases')['databases'];

        $db_info = [];
        for($i=0;$i<$db_count;$i++){
            if(!empty($info['db'.$i])){
                $tmp = explode(',',$info['db'.$i]);
                $keys = explode('=',$tmp[0]);
                $db_info[$i]['keys'] = $keys[1];
            }else{
                $db_info[$i]['keys'] = 0;
            }
        }      

        return $db_info;
    }

}
