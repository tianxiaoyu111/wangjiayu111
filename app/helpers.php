<?php
//传入txt文本文件内容，输出展示页面的字符串
function txt2html($contents)
{
    $arr = explode("\r\n", $contents);//转换成数组
    foreach ($arr as $key => $val) {
        $num = '<small style="color: #778899">' . ($key+1) . '</small>' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ;
        $arr[$key] = $num.$val;
    }
    $str = nl2br(implode("\r\n", $arr));
    return $str;
}

//传入文件名和页面字符串组成json数组格式
function str2json($filename, $str)
{
    $jsonArr = [
        'filename' => $filename,
        'content' => $str,
    ];
    return $jsonArr;
}

//修改文件
function doFix($contents)
{
    //字符串转为二维数组，并查找出G96，G97，G98行的下标
//        $contents = Storage::get('test.txt');
    $arr = explode("\r\n", $contents);//转换成数组
    $g96 = 0;
    $g97 = 0;
    $g98 = 0;
    foreach ($arr as $key=>$value) {
        $arr[$key] = explode(" ", $value);
        if (isset($arr[$key][1]) AND $arr[$key][1] == 'G96') {
            $g96 = $key;
        }
        if (isset($arr[$key][1]) AND $arr[$key][1] == 'G97') {
            $g97 = $key;
        }
        if (isset($arr[$key][1]) AND $arr[$key][1] == 'G98') {
            $g98 = $key;
        }
    }

    //调整g96,g97 行位置
    while (substr($arr[$g96][2], 1) < substr($arr[$g96-1][2], 1)) {
        $tmp = $arr[$g96];
        $arr[$g96] = $arr[$g96-1];
        $arr[$g96-1] = $tmp;
        $g96--;
    }
    while (substr($arr[$g97][2], 1) < substr($arr[$g97-1][2], 1)) {
        $tmp = $arr[$g97];
        $arr[$g97] = $arr[$g97-1];
        $arr[$g97-1] = $tmp;
        $g97--;
    }

    //调整g96到g97之间的错误,第二列都等于M57
    for ($key = ($g96 + 1); $key <= ($g97 - 1); $key++) {
        $arr[$key][1] = 'M57';
    }
    //调整g97到g98之间的错误，第二列都等于M58，第三列X换成Z
    for ($key = ($g97 + 1); $key <= ($g98 - 1); $key++) {
        $arr[$key][1] = 'M58';
        $arr[$key][2] = str_replace('X', 'Z', $arr[$key][2]);
    }


    //二维数组逆转为字符串
    foreach ($arr as $key=>$value) {
        $arr[$key] = implode(" ", $value);
    }
    $contents = implode("\r\n", $arr);
    return $contents;
}