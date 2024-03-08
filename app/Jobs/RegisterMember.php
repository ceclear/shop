<?php

namespace App\Jobs;

use App\Mail\Register;
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Queue\SerializesModels;
//use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Facades\Mail;

class RegisterMember implements ShouldQueue
{
//    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userInfo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userInfo)
    {
        $this->userInfo = $userInfo;
        //
    }

    /**
     * @return bool
     */
    public function handle()
    {
        //todo 取消发送验证码
        Mail::to('594652523@qq.com')->send(new Register($this->userInfo));
        Log::info('--------新注册用户----' . $this->userInfo['id'] . '邮件发送完毕');

        return true;
    }
}
