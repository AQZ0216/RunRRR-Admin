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
                        <span class="pull-right"><a href="edit.php" type="button" class="btn btn-primary">新增線索</a></span>
                        線索管理
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
                                <th width="10%">#</th>
                                <th>內文</th>
                                <th width="10%">編輯</th>
                            </tr>
                        </thead>
                        <tbody>
		            		<?php
		            			$clue_array = ClueReadAll();
		            			$clue_array = $clue_array['payload']['objects'];
		            			foreach($clue_array as $clue){
		            				echo "
					            		<tr>
			                                <td>".$clue['cid']."</td>
			                                <td>".$clue['content']."</td>
			                                <td class=\"center\">
                                                <a href=\"control.php?cid=".$clue['cid']."&action=delete\" type=\"button\" class=\"btn btn-outline btn-danger btn-xs\">刪除</a>
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
        $('a[href="/run/admin/pages/clue/index.php"]').addClass("active");
        $('a[href="/run/admin/pages/clue/index.php"]').parent().parent().removeClass("collapse");
    });
    </script>

</body>

</html>
