<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    // 指定文件夹路径和文件名
//    protected $folderPath = 'assets/images/about';//windows的路径
    protected $folderPath = 'img/partners';
    protected $fileName = 'archive.zip';

    public function __construct($path = '', $name = '')
    {
        !empty($path) && $this->folderPath = $path;
        !empty($name) && $this->fileName = $name;
    }

    public function index()
    {
        //发送邮件带附件之windows服务器
//        self::attachWindows($this->folderPath,$this->fileName);
//        self::attachLinux($this->folderPath, $this->fileName);
        echo 'success';

    }

    public static function attachWindows($folderPath, $fileName)
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
        // 发送邮件
        //以下方式不带模板,要使用自定义模板请使用app/mail下面的
        Mail::raw('请查收', function ($message) use ($fileName) {
            $message->to('594652523@qq.com')
                ->subject('打包的文件windows')
                ->attach($fileName);
        });
        unlink($fileName);
    }

    public static function attachLinux($folderPath, $fileName)
    {
        // 创建临时压缩文件
        $zip     = new \ZipArchive();
        $zipFile = public_path($fileName);
        $zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        // 遍历指定文件夹下的文件并添加到压缩文件中
        $files = File::allFiles(public_path($folderPath));
        foreach ($files as $file) {
            $relativePath = str_replace(public_path($folderPath).'/', '', $file);
            $zip->addFile($file, $relativePath);
        }

        $zip->close();
        // 发送邮件
        //以下方式不带模板,要使用自定义模板请使用app/mail下面的
        Mail::raw('请查收', function ($message) use ($zipFile) {
            $message->to('594652523@qq.com')
                ->subject('打包的文件linux')
                ->attach($zipFile);
        });
        unlink($zipFile);
    }


}
