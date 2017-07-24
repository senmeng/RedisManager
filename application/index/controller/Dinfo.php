<?php
namespace app\index\controller;

use think\Controller;

class Dinfo extends Controller
{
    public function index()
    {        
        $db_id = input('param.id',0,'int');
        $k = input('param.k');

        $server = config('redis.servers')[0];
        $db = RedisDB::getInstance($server);
        $db->select($db_id);
        $type = $db->type($k);
        $uri = config('redis.type')[$type];
        if($k){           
            $this->redirect($uri.'/index', ['id' => $db_id,'k'=>$k]);
        }

        
        $list = $db->keys('*');

        $this->assign('list',$list);
        $this->assign('db_id',$db_id);
        return $this->fetch();
    }

}
