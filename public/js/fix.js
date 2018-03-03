function fix() {
    var filename = $("#filename").text();
    $.ajax({
        url:$("#url_fix").text(),
        type:"get",
        data:{filename : filename},
        success:function(res){
            console.log(res);
            $("#filename_fix").html(res.filename);
            $("#show_fix").html(res.content);
            $("#status").text("2");
        },
        error:function(err){
            alert("没有传入文件名",err);
        }

    })
}