<?php
/**
 * Created by PhpStorm.
 * User: zt
 * Date: 2019/6/24
 * Time: 12:01
 */

namespace App\Libs;


use Illuminate\Support\Facades\Log;

class MemberRedis
{
    //类单例数组
    private static $instance = [];
    //redis连接句柄
    protected $_redis = false;
    protected $prefix = 'shop:member_';//redis key前缀
    protected static $configKey = 'member'; //默认的database内配置的连接的指定redis数据库

    private function __construct($config)
    {
        $database = $config['database'];
        if (isset($config['persistent']) && $config['persistent']) {
            $func = 'pconnects';
            //注意 $persistent_id 此处，持久连接设置标识
            $persistent_id = 'pconnect_' . $database;
        } else {
            $func          = 'connects';
            $persistent_id = null;
        }
        $this->_redis = new \Redis;
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

    public function setLogin($user, $token, $expireTime)
    {
        if (!$this->_redis) {
            return false;
        }
        $userId             = $user['id'];
        $arr['id']          = $userId;
        $arr['username']    = $user['username'];
        $arr['avatar']      = $user['avatar'];
        $arr['email']       = $user['email'];
        $arr['nickname']    = $user['nickname'];
        $arr['token']       = $token;
        $user['login_time'] = date('Y-m-d H:i:s', time());
        Log::info('user_id====' . $userId . '：login_time：' . $user['login_time']);
        $this->_redis->hMSet($userId, $arr);
        $this->_redis->expire($userId, $expireTime);
        return true;
    }

    public function checkLoginToken($userId, $token)
    {
        if (!$this->_redis) {
            return false;
        }
        $hashInfo = $this->_redis->hGetAll($userId);
        if (empty($hashInfo)) {
            Log::info('登录信息失效,未能获取redis信息,token:' . $token);
            return false;
        }
        if ($hashInfo && $hashInfo['token'] != $token) {
            Log::info('登录token验证失败，user_id：' . $userId . '，参数token：' . $token . '，redis_token：' . $hashInfo['token']);
            return false;
        }
        return true;
    }

    public function __call($name, $arguments)
    {
        $res = call_user_func_array(array($this->_redis, $name), $arguments);

        return $res;
    }
}
