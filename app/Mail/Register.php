<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    protected $userInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userInfo)
    {
        $this->userInfo = $userInfo;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('新用户注册通知')
            ->view('mail.register')
            ->with(['nickname' => $this->userInfo['nickname'], 'avatar' => $this->userInfo['avatar']]);
    }
}
