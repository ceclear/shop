<?php

namespace App\Jobs;

use App\Mail\StudyComplete;
use EasyWeChat\Factory;
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
        //todo
        Mail::to('594652523@qq.com')->send(new StudyComplete($this->userInfo, $this->studyInfo));
//        Mail::to('1414351551@qq.com')->send(new StudyComplete($this->userInfo, $this->studyInfo));
        //服务通知加一个
//        Log::info('提交作业信息了',$this->studyInfo);
        $app     = Factory::miniProgram(config('wechat.mini_program.default'));
        $content = '总数:' . $this->studyInfo['total'] . ',用时:' . $this->studyInfo['remind'] . ',正确数:' . $this->studyInfo['yes'] . ',错误数:' . $this->studyInfo['no'] . ',正确率:' . $this->studyInfo['rate'] . ',提交时间:'
            . $this->studyInfo['submit_time'];
        $app->subscribe_message->send([
            'touser'      => 'oc53p5dwSYOIKYOgduU-7aIOZoAU',
            'template_id' => 'sNrOvfxKncoCjKZ-KM77XV6y8vrTUgWK98wwOV2L4S4',
            'data'        => [
                'thing1' => "{$this->userInfo['nickname']}",
                'thing2' => '1.12',
                'thing3' => '连加连减计算',
                'thing4' => $content
            ]
        ]);
        Log::info('--------作业提交' . $this->userInfo['id'] . '邮件发送完毕');

        return true;
    }
}
