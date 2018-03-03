function upload() {
    var form = document.getElementById('upload'),
        formData = new FormData(form);
    $.ajax({
        url:$('#url_up').text(),
        type:"post",
        data:formData,
        processData:false,
        contentType:false,
        success:function(res){
            //            if(res){
            //             alert("上传成功！");
            //            }
            console.log(res);
            $("#txt").val("");
            $("#filename").html(res.filename);
            $("#show").html(res.content);
            $("#status").text("1");
            //            $(".showUrl").html(res);
            //            $(".showPic").attr("src",res);
        },
        error:function(err){
            alert("选文件再提交",err);
        }

    })
}
