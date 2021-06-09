<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:task {m?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取验证码方便app登录';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $this->sendCode();
    }

    public function sendCode()
    {
        if (empty($this->argument('m'))) {
            $arr = DB::table('user_info')->where('status',1)->get();
        } else {
            $mobile = $this->argument('m');
            $arr    = [['mobile' => $mobile]];
        }
        foreach ($arr as $item) {
            $url  = 'https://api.mdweilai.cn/api/v1/smscode';
            $data = '{"phone": "' . $item->mobile . '","code_type": "register"}';
            $data = json_decode($data, true);
            $rel  = $this->http_post($url, [], $data);
            $rel  = json_decode($rel, true);
            $code = $rel['data']['code'];
            //新加账号执行登录获得uid
//            self::login($code, $item->mobile);
            Log::info('mobile==='.$item->mobile.'====code===='.$code);
            //新加账号不要执行下面修改
            DB::table('user_info')->where('mobile',$item->mobile)->update(['code'=>$code]);
            sleep(10);
        }

    }

    public function login($code, $mobile)
    {
        $url = 'https://api.mdweilai.cn/api/v1/login';

        $data = '{"phone": "' . $mobile . '","code": "' . $code . '","code_type": "register"}';
        $data = json_decode($data, true);
        $rel  = $this->http_post($url, [], $data);
        $rel  = json_decode($rel, true);
        $info = $rel['data'];
        Log::info('手机号' . $mobile . '登录信息', $data);
        DB::table('user_info')->where('mobile',$mobile)->update(['uid'=>$info['id']]);
        return $info;
    }


    public function http_post($sUrl, $aHeader, $aData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $sUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($aData));
        $sResult = curl_exec($ch);
        if ($sError = curl_error($ch)) {
            die($sError);
        }
        curl_close($ch);
        return $sResult;
    }


    function curl_get($url, $header = [])
    {


        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        // 超时设置,以秒为单位
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        // 超时设置，以毫秒为单位
        // curl_setopt($curl, CURLOPT_TIMEOUT_MS, 500);

        // 设置请求头
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //执行命令
        $data = curl_exec($curl);

        // 显示错误信息
        if (curl_error($curl)) {
            print "Error: " . curl_error($curl);
        } else {
            curl_close($curl);
            return $data;
        }
    }

}

