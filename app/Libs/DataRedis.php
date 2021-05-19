<?php
/**
 * Created by PhpStorm.
 * User: zt
 * Date: 2019/6/24
 * Time: 12:01
 */

namespace App\Libs;


class DataRedis
{
    //类单例数组
    private static $instance = [];
    //redis连接句柄
    protected $_redis = false;
    protected $prefix = 'shop:jiakao';//redis key前缀
    protected static $configKey = 'redis_cache'; //默认的database内配置的连接的指定redis数据库
    protected static $expireTime = 3600 * 24;

    private function __construct($config)
    {
        $database = $config['database'];
        if (isset($config['persistent']) && $config['persistent']) {
            $func = 'pconnect';
            //注意 $persistent_id 此处，持久连接设置标识
            $persistent_id = 'pconnect_' . $database;
        } else {
            $func          = 'connect';
            $persistent_id = null;
        }
        $this->_redis = new \Redis();
        $this->_redis->$func($config['host'], $config['port'], 0, $persistent_id);
        $this->_redis->setOption(2, $this->prefix);
        if ('' != $config['password']) {
            $this->_redis->auth($config['password']);
        }
        $this->_redis->select((int)$database);
    }

    /**
     * 获取类单例
     * @return self
     */
    public static function getRedisInstance()
    {
        $config   = config("database.redis." . self::$configKey);
        $database = $config['database'];
        $database = (int)$database;
        if (!isset(self::$instance[$database])) {
            self::$instance[$database] = new self($config);
        }
        return self::$instance[$database];
    }


    public function __call($name, $arguments)
    {
        $res = call_user_func_array(array($this->_redis, $name), $arguments);

        return $res;
    }
}
