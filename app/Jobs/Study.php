<?php

namespace App\Jobs;

use App\Mail\StudyComplete;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Study implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userInfo;
    protected $studyInfo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userInfo, $studyInfo)
    {
        $this->userInfo  = $userInfo;
        $this->studyInfo = $studyInfo;
        //
    }

    /**
     * @return bool
     */
    public function handle()
    {
        Log::info('----study队列执行，data：' . json_encode($this->userInfo));

        //todo
        Mail::to('594652523@qq.com')->send(new StudyComplete($this->userInfo,$this->studyInfo));
        Mail::to('1414351551@qq.com')->send(new StudyComplete($this->userInfo,$this->studyInfo));
        Log::info('--------' . $this->userInfo['id'] . '邮件发送完毕');

        return true;
    }
}
