<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>一个简单的书籍管理系统 -- 基于swoft Framework 2.0 的开发</title>
    <!-- bootstrap + jquery -->

    <!-- vuejs  , reactjs , angular -->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id="alert_box"></div>
<div class="container-fluid">
    <!-- 页头 -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>一个简单的书籍管理系统<small>基于swoft Framework 2.0 的开发</small></h1>
            </div>
        </div>
    </div>

    <!-- 功能按钮 -->
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" id="new-job">增加新书籍</button>
            
        </div>
    </div>

    <!-- 任务列表 -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" style="margin-top: 20px">
                <div class="panel-body">
                    <table id="book-list"  class="table table-striped">
                        <thead>
                        <tr>
                            <th>书名ID</th>
                            <th>书名</th>
                            <th>作者</th>
                            <th>页数</th>
                            <th>出版社</th>
                            <th>出版时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- position: fixed -->
<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">增加新书籍</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="edit-title">书名</label>
                        <input type="text" class="form-control" id="edit-title" placeholder="书名">
                    </div>
                    <div class="form-group">
                        <label for="edit-author">作者</label>
                        <input type="text" class="form-control" id="edit-author" placeholder="作者">
                    </div>
                    <div class="form-group">
                        <label for="edit-pages">页数</label>
                        <input type="number" class="form-control" id="edit-pages" placeholder="页数">
                    </div>
                    <div class="form-group">
                        <label for="edit-publiser">出版社</label>
                        <input type="text" class="form-control" id="edit-publiser" placeholder="出版社">
                    </div>
                    <div class="form-group">
                        <label for="edit-publis_time">出版时间</label>
                        <input type="date" class="form-control" id="edit-publis_time" placeholder="出版时间">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id="save-book">保存</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--  日志模态框 -->
<div id="log-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">任务日志</h4>
            </div>
            <div class="modal-body">
                <table id="log-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th>shell命令</th>
                        <th>错误原因</th>
                        <th>脚本输出</th>
                        <th>计划开始时间</th>
                        <th>实际调度时间</th>
                        <th>开始执行时间</th>
                        <th>执行结束时间</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--  健康节点模态框 -->
<div id="worker-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">健康节点</h4>
            </div>
            <div class="modal-body">
                <table id="worker-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th>节点IP</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    // 页面加载完成后, 回调函数
    $(document).ready(function() {
        // 时间格式化函数
        function timeFormat(millsecond) {
            // 前缀补0: 2018-08-07 08:01:03.345
            function paddingNum(num, n) {
                var len = num.toString().length
                while (len < n) {
                    num = '0' + num
                    len++
                }
                return num
            }
            var date = new Date(millsecond)
            var year = date.getFullYear()
            var month = paddingNum(date.getMonth() + 1, 2)
            var day = paddingNum(date.getDate(), 2)
            var hour = paddingNum(date.getHours(), 2)
            var minute = paddingNum(date.getMinutes(), 2)
            var second = paddingNum(date.getSeconds(), 2)
            var millsecond = paddingNum(date.getMilliseconds(), 3)
            return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second + "." + millsecond
        }

        // 1, 绑定按钮的事件处理函数
        // 用javascript委托机制, DOM事件冒泡的一个关键原理

        // 编辑任务
        $("#book-list").on("click", ".edit-job", function(event) {
            // 取当前job的信息，赋值给模态框的input
            $('#edit-title').val($(this).parents('tr').children('.job-name').text())
            $('#edit-author').val($(this).parents('tr').children('.job-command').text())
            $('#edit-pages').val($(this).parents('tr').children('.job-cronExpr').text())
            $('#edit-publiser').val($(this).parents('tr').children('.job-cronExpr').text())
            $('#edit-publis_time').val($(this).parents('tr').children('.job-cronExpr').text())
            // 弹出模态框
            $('#edit-modal').modal('show')
        })
        // 删除书籍
        $("#book-list").on("click", ".delete-job", function(event) { // javascript bind
            var bookId = $(this).parents("tr").children(".book-id").text()
            $.ajax({
                url: '/v1/book/delete',
                type: 'post',
                dataType: 'json',
                data: {id: bookId},
                complete: function() {
                    window.location.reload()
                }
            })
        }) 
        // 保存
        $('#save-book').on('click', function() {
            var bookInfo = {
              title: $('#edit-title').val(),
              author: $('#edit-author').val(),
              pages: $('#edit-pages').val(), 
              publiser: $('#edit-publiser').val(), 
              publis_time: $('#edit-publis_time').val()
              }
            $.ajax({
                url: '/v1/book/save',
                type: 'post',
                dataType: 'json',
                data: {book: JSON.stringify(bookInfo)},
                complete: function() {
                    window.location.reload()
                }
            })
        })
 

        // 2，定义一个函数，用于刷新任务列表
        function rebuildJobList() {
            // /job/list
            $.ajax({
                url: '/v1/book/list',
                dataType: 'json',
                success: function(resp) {
                    if (resp.errno != 0) {  // 服务端出错了
                        mytip(resp.msg)
                        return
                    }
                    // 任务数组
                    var jobList = resp.data
                    // 清理列表
                    $('#job-list tbody').empty()
                    // 遍历任务, 填充table
                    for (var i = 0; i < jobList.length; ++i) {
                        var job = jobList[i];
                        var tr = $("<tr>")
                        tr.append($('<td class="job-command book-id">').html(job.id))
                        
                        tr.append($('<td class="job-command">').html(job.title))
                        tr.append($('<td class="job-cronExpr">').html(job.author))
                        tr.append($('<td class="job-cronExpr">').html(job.pages))
                        tr.append($('<td class="job-cronExpr">').html(job.publiser))
                        tr.append($('<td class="job-cronExpr">').html( job.publis_time ) )
                        var toolbar = $('<div class="btn-toolbar">')
                                .append('<button class="btn btn-info edit-job">编辑</button>')
                                .append('<button class="btn btn-danger delete-job">删除</button>');
                        tr.append($('<td>').append(toolbar))
                        $("#book-list tbody").append(tr)
                    }
                }
            })
        }
        rebuildJobList();
 
        
    })
</script>

</body>
</html>