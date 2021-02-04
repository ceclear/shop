<?php
/*
* mark
* date 2021/2/3
* time 19:40
* author zt
*/

namespace App\Admin\Controllers;


use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UploadController extends AdminController
{
    public function editorUploadImage(Request $request)
    {
        if (!$request->file('upload')) {
            throw new \Exception("请选择文件");
        }
        $file            = $request->file('upload');
        $object          = $file->store('admin_images');
        $ossConfigPublic = config('filesystems.disks.admin.url');
        $file->move(config('filesystems.disks.admin.root') . '/' . config('admin.upload.directory.image'), $object);
        Storage::deleteDirectory('admin_images');
        return $ossConfigPublic . $object;
    }

}
