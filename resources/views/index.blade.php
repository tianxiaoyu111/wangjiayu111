<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="{{asset('css/wangjiayu.css')}}" rel="stylesheet" />
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
<body>
<div style="display: none" id="status" >0</div>
<div style="display: none" id="url_up" >{{url('up')}}</div>
<div style="display: none" id="url_fix" >{{url('fix')}}</div>
<div style="display: none" id="url_down" >{{url('down')}}</div>
<div id="container">
    <div id="header">
        {{--<button id="1">上传</button>--}}
        <form id="upload" enctype="multipart/form-data" action="{{ url('up') }}" method="post">
            {{ csrf_field() }}
            <input type="file" name="txt" id="txt"/>
            <input type="button" value="提交" id="submit" onclick="upload()"/>
        </form>

        <button id="2" onclick="fix()">修改</button>
        <button id="3" onclick="down()">下载</button>
        <button id="4" onclick="location.href='{{ url('clean') }}'">重置</button>
    </div>
    <div id="box">
        <div id="left">
            <span id="filename">filename</span>：
            <div id="show" onscroll="funcsrcoll1()">
                <p>王佳雨传文件，点击提交后你会在这里看见文件内容</p>
            </div>
        </div>
        <div id="right">
            <span id="filename_fix">fix.filename</span>：
            <div id="show_fix" onscroll="funcsrcoll2()">
                <p>然后点修改，这里显示修改后的文件内容</p>
                <p>确认没问题点下载，重新开始点重置</p>
            </div>
        </div>
    </div>

</div>

<script src="{{asset('js/wangjiayu.js')}}"></script>
<script src="{{asset('js/up.js')}}"></script>
<script src="{{asset('js/fix.js')}}"></script>
<script src="{{asset('js/down.js')}}"></script>

</body>
</html>