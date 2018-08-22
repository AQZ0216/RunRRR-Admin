<?php require_once("../../config.php"); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once(INCLUDE_PAGES_PATH . "html-head.php"); ?>
</head>

<body>

    <div id="wrapper">

        <?php require_once(INCLUDE_PAGES_PATH . "navigation.php"); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <span class="pull-right">
                            <a href="index.php" type="button" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i>&nbsp;返回清單</a>
                        </span>
                        道具管理：新增道具
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                        if(isset($_GET['status']) && $_GET['status']=='updated')
                            echo "
                                <div class=\"alert alert-success alert-dismissable\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                                    資料更新成功。
                                </div>
                            ";
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="control.php?action=create" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="action" value="create">
                                        <div class="form-group">
                                            <label>名稱</label>
                                                <input type="text" class="form-control" name="title" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>價格</label>
                                            <input type="text" class="form-control" name="price" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>自爆秒數</label>
                                            <input type="text" class="form-control" name="expire" required="required">
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>內容說明</label>
                                            <textarea class="form-control" rows="3" name="content" required="required"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>示範照片上傳</label>
                                            <input type="file" name="file" id="file" required="required">
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="submit" class="btn btn-primary btn-block" value="儲存變更"></input>
                                    </div>
                                    <!-- /.col-lg-12 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php require_once(INCLUDE_PAGES_PATH . "html-body-js.php"); ?>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
        $('a[href="/run/admin/pages/tool/index.php"]').addClass("active");
        $('a[href="/run/admin/pages/tool/index.php"]').parent().parent().removeClass("collapse");
    });
    </script>

</body>

</html>
