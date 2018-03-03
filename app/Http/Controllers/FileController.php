<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function showUploaded(Request $request)
    {
        //如果不选文件就点提交则报错
        if (!$request->hasFile('txt')) {
            return false;
        }

        //移动文件
        $file = $request->txt;
        $filename = $file->getClientOriginalName();
        $file->storeAs('up', $filename);


        //把文件内容转为html需要的样子，再加上文件名组成json数组
        $contents = Storage::get('up/'.$filename);
        $str = txt2html($contents);
        $jsonArr = str2json($filename, $str);

        //返回json字符串
        return response()->json($jsonArr);
    }

    public function showFixed(Request $request)
    {
        //如果被修改的文件名不存在则报错
        $filename = $request->get('filename');
        if (empty($filename) OR $filename == 'filename') {
            return false;
        }

        //把文件以新名字复制进down目录
        $fixName = 'fix.'.$filename;
        if (Storage::exists('down/'.$fixName)) {
            Storage::delete('down/'.$fixName);
        }
        Storage::copy('up/'.$filename, 'down/'.$fixName);

        //读取文件内容并修改保存
        $contents = Storage::get('down/'.$fixName);
        $contents = doFix($contents);
        Storage::put('down/'.$fixName, $contents);

        //读取修改后的文件内容，将内容转为要输出的json数组
        $contents = Storage::get('down/'.$fixName);
        $str = txt2html($contents);
        $jsonArr = str2json($fixName, $str);

        //返回json字符串
        return response()->json($jsonArr);

    }

    public function download($filename)
    {
        //如果文件夹下没有这个文件，则通知文件缺失
        if (!Storage::exists('down/'.$filename)) {
            return '没有此文件，重置再弄，弄不好找爸爸';
        }
        //下载文件
        return response()->download(public_path('uploads/down/') . $filename);
    }

    public function cleanUp()
    {
        //删除两个文件夹下的所有文件
        $files = array_merge(Storage::files('up'), Storage::files('down'));

        if (!Storage::delete($files)) {
            return '文件删除失败';
        }
        //返回重定向
        return redirect('/');
    }


}
