function down() {
    var filename = $("#filename_fix").text();
    if (filename == 'fix.filename') {
        alert ("缺少文件名\r\n王佳雨你不要瞎搞好吧，按顺序来");
        return;
    }

    location.href = $("#url_down").text() + '/' + filename;
}