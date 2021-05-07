<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('新用户注册通知')->view('mail.test')->with(['nickname' => '樱花', 'avatar' => 'https://thirdwx.qlogo.cn/mmopen/vi_32/iaSUDHup94R7OTQYeCAiaUZoM1A66iaZiakX9ArjsnzaN0lbVibaaWpsZUUXXtFRY78SCvVLN2J7CF6rd7HibAiaicMQFQ/132']);
    }
}
