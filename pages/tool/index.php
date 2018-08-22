<?php require_once("../../config.php"); ?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <?php require_once(INCLUDE_PAGES_PATH . "html-head.php"); ?>
</head>

<body>
    <div id="black-transparent"></div>
    <div id="lightbox"></div>

    <div id="wrapper">

        <?php require_once(INCLUDE_PAGES_PATH . "navigation.php"); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <span class="pull-right"><a href="edit.php" type="button" class="btn btn-primary">新增道具</a></span>
                        道具管理
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
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th width="7%">#</th>
                                <th width="18%">名稱</th>
                                <th width="45%">內容說明</th>
                                <th width="8%">秒數</th>
                                <th width="8%">價格</th>
                                <th width="14%">編輯</th>
                            </tr>
                        </thead>
                        <tbody>
		            		<?php
		            			$tool_array = ToolReadAll();
		            			$tool_array = $tool_array['payload']['objects'];
		            			foreach($tool_array as $tool){
		            				echo "
					            		<tr>
			                                <td class=\"center\">".$tool['tid']."</td>
                                            <td>".$tool['title']."</td>
                                            <td>".$tool['content']."</td>
                                            <td>".$tool['expire']."</td>
                                            <td>".$tool['price']."</td>
			                                <td class=\"center\">
                                                <button onclick=\"lightboxShowApiImage('".$tool['url']."');\" type=\"button\" class=\"btn btn-outline btn-primary btn-xs\">查看圖片</button>
                                                <a href=\"control.php?action=delete&tid=".$tool['tid']."\" type=\"button\" class=\"btn btn-outline btn-danger btn-xs\">刪除</a>
                                            </td>
			                            </tr>
                            		";
		            			}
		            		?>

                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
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
    });
        $('a[href="/run/admin/pages/tool/index.php"]').addClass("active");
        $('a[href="/run/admin/pages/tool/index.php"]').parent().parent().removeClass("collapse");
    </script>

</body>

</html>
