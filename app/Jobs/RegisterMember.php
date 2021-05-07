<?php

namespace App\Jobs;

use App\Mail\Register;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegisterMember implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
        //
    }

    /**
     * @return bool
     */
    public function handle()
    {
        $aData = [
            'user_id' => $this->userId,
        ];
        Log::info('----AfterRegister队列执行，data：' . json_encode($aData));

        //todo
        Mail::to('594652523@qq.com')->send(new Register());
        Log::info('--------' . $this->userId . '邮件发送完毕');

        return true;
    }
}
