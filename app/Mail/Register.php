<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    public $userInfo;

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
        // 指定文件夹路径和文件名
        $folderPath = 'assets/images/about';
        $fileName   = 'archive.zip';
        $this->attachWindows($folderPath,$fileName);
        $this->subject('新用户注册通知')
//            ->attach('D:\phpcode\shop\public\assets\images\about\about-1.jpg')    //添加windows上单个文件到附件
            ->attach($fileName)//添加windows上压缩包做附件
            ->view('mail.register');
//            ->with(['nickname' => $this->userInfo['nickname'], 'avatar' => $this->userInfo['avatar']]); //当前类定义的任何公共属性将自动传递给视图
        //更新打包方式
        return true;
    }

    //发送邮件带附件之windows服务器
    public function attachWindows($folderPath,$fileName)
    {
        // 创建临时压缩文件
        $rootPath = dirname(dirname(__FILE__));
        $zip      = new \ZipArchive();
        $zip->open($fileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // 遍历指定文件夹下的文件并添加到压缩文件中
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($folderPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
    }

    public function attachLinux()
    {

    }
}
