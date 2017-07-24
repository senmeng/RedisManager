<?php
namespace app\index\controller;

use think\Controller;

class Edit extends Controller
{
    public function index()
    {        
        return $this->fetch();
    }

    public function doSub(){

        $act = input('get.act');
        $acts = ['str','list','hash','set','zset'];
        $data = input('post.');
        $key = $data['key'];
        $val = $data['val'];
        if(!in_array($act,$acts)){
            echo '非常请求';
        }
        
        $server = config('redis.servers')[0];
        $db = RedisDB::getInstance($server);

        if($act=='str'){
            echo $db->set($key,$val);
        }
     
        echo $act;
    }

    public function rename(){
        
        $oldkey = input('post.oldkey');
        $newkey = input('post.newkey');
        if($oldkey && $newkey){
            $server = config('redis.servers')[0];
            $db = RedisDB::getInstance($server);
            if($db->rename($oldkey,$newkey)){
                return retJson();
            }else{
                return retJson(6001);
            }            
        }
    }
}
