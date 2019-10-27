<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>简单的书籍管理系统 -- 基于swoft Framework 2.0 的开发</title>
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
            <button type="button" class="btn btn-primary" id="new-book">增加新书籍</button>
            
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

        <!-- 页头 -->
        <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                 <small>yangqinjiang@qq.com</small>
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
                <h4 class="modal-title edit-book-title">增加新书籍</h4>
            </div>
            <div class="modal-body">
                <form>
                <input type="hidden"  id="edit-id" value=0>
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
        $("#book-list").on("click", ".edit-book", function(event) {
            // 取当前book的信息，赋值给模态框的input
            var tr = $(this).parents('tr');
            $('#edit-id').val(tr.children('.book-id').text())
            $('#edit-title').val(tr.children('.book-title').text())
            $('#edit-author').val(tr.children('.book-author').text())
            $('#edit-pages').val(tr.children('.book-pages').text())
            $('#edit-publiser').val(tr.children('.book-publiser').text())
            $('#edit-publis_time').val(tr.children('.book-publis_time').text())
            // 弹出模态框
            $('.edit-book-title').html("编辑书籍")
            $('#edit-modal').modal('show')
        })
        // 删除书籍
        $("#book-list").on("click", ".delete-book", function(event) { // javascript bind
            if (!confirm("确定删除此书籍?")){
                return
            }
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
              id: $('#edit-id').val(),
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
        });
        // 新建任务
        $('#new-book').on('click', function() {
            $('#edit-id').val(0)
            $('#edit-title').val("")
            $('#edit-author').val("")
            $('#edit-pages').val("")
            $('#edit-publiser').val("")
            $('#edit-publis_time').val("")
            $('.edit-book-title').html("增加新书籍")
            $('#edit-modal').modal('show')
        })
 

        // 2，定义一个函数，用于刷新任务列表
        function rebuildJobList() {
            // 
            $.ajax({
                url: '/v1/book/list',
                dataType: 'json',
                success: function(resp) {
                    if (resp.errno != 0) {  // 服务端出错了
                        mytip(resp.msg)
                        return
                    }
                    // 任务数组
                    var List = resp.data
                    // 清理列表
                    $('#job-list tbody').empty()
                    // 遍历任务, 填充table
                    for (var i = 0; i < List.length; ++i) {
                        var item = List[i];
                        var tr = $("<tr>")
                        tr.append($('<td class="book-id">').html(item.id))
                        
                        tr.append($('<td class="book-title">').html(item.title))
                        tr.append($('<td class="book-author">').html(item.author))
                        tr.append($('<td class="book-pages">').html(parseInt(item.pages)))
                        tr.append($('<td class="book-publiser">').html(item.publiser))
                        tr.append($('<td class="book-publis_time">').html( item.publis_time ) )
                        var toolbar = $('<div class="btn-toolbar">')
                                .append('<button class="btn btn-info edit-book">编辑</button>')
                                .append('<button class="btn btn-danger delete-book">删除</button>');
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