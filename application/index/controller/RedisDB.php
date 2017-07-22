<?php
namespace app\index\controller;
/**
 * redis操作类
 * 说明，任何为false的串，存在redis中都是空串。
 * 只有在key不存在时，才会返回false。
 * 这点可用于防止缓存穿透
 *
 */
class RedisDB{

    //当前数据库ID号
    protected $dbId=0;

    /**
     * 实例化的对象,单例模式.
     * @var \iphp\db\Redis
     */
    static private $_instance=array();
    private  $k;

    public static function getInstance($config,$attr=array()){
        $oldattr = array(
            //连接超时时间，redis配置文件中默认为300秒
            'timeout'=>3,
            //选择的数据库。
            'db_id'=>0,
        );

        //如果是一个字符串，将其认为是数据库的ID号。以简化写法。
        if(!is_array($attr))
        {
            $dbId    =    $attr;
            $attr    =    array();
            $attr['db_id']    =    $dbId;
        }else{
            $attr = array_merge($oldattr,$attr);
        }

        //默认数据库
        $attr['db_id']    =    $attr['db_id'] ? $attr['db_id'] : 0;
        
        //数据库Key
        $k    =    md5(implode('', $config).$attr['db_id']);
        if(empty(self::$_instance[$k])){
            try {   
                $redis = new \Redis();
                $redis->connect($config['host'],$config['port'],3);
                if($config['auth'])
                {
                    $redis->auth($config['auth']);
                }
                self::$_instance[$k] = $redis;
                self::$_instance[$k]->k = $k;
            } catch (Exception $e) {
                return false;
            }
        }

        return static::$_instance[$k];
        //$this->attr = array_merge($this->attr,$attr);
     }
}