<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class StudyComplete extends Mailable
{
    use Queueable, SerializesModels;

    protected $userInfo;
    protected $attend;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userInfo, $attend = [])
    {
        $this->userInfo = $userInfo;
        $this->attend   = $attend;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sendData = [
            'user_id'     => $this->userInfo['id'],
            'nickname'    => $this->userInfo['nickname'],
            'submit_time' => Carbon::now()->toDateTimeString()
        ];
        $sendData = array_merge($sendData, $this->attend);
        Log::info('发送数据', $sendData);
        return $this->subject('作业通知')->view('mail.study')->with($sendData);
    }
}
