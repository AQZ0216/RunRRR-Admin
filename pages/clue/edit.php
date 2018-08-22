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
                        線索管理：新增線索
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="control.php?action=create" method="GET">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="action" value="create">
                                        <div class="form-group">
                                            <label>內文</label>
                                            <input type="text" class="form-control" name="content" required="required">
                                        </div>
                                    </div>
                                    <!-- /.col-lg-12 (nested) -->
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
        $('a[href="/run/admin/pages/clue/index.php"]').addClass("active");
        $('a[href="/run/admin/pages/clue/index.php"]').parent().parent().removeClass("collapse");
    });
    </script>

</body>

</html>
