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
                        <span class="pull-right"><a href="edit.php?action=create" type="button" class="btn btn-primary">新增任務</a></span>
                        任務管理
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
                                <th width="7%">分類</th>
                                <th width="20%">任務名稱</th>
                                <th width="12%">時間</th>
                                <th width="7%">獎金</th>
                                <th width="7%">線索</th>
                                <th width="10%">分數</th>
                                <th width="20%">GPS 地點</th>
                                <th width="10%">編輯</th>
                            </tr>
                        </thead>
                        <tbody>
		            		<?php
		            			$mission_array = MissionReadAll();
		            			$mission_array = $mission_array['payload']['objects'];
		            			foreach($mission_array as $mission){
		            				echo "
					            		<tr>
			                                <td class=\"center\">".$mission['mid']."</td>
                                            <td>".$mission['class']."</td>
                                            <td>".$mission['title']."</td>
                                            <td>".date('H:i', strtotime($mission['time_start']))." ~ ".date('H:i', strtotime($mission['time_end']))."</td>
                                            <td>".$mission['prize']."</td>
                                            <td>".$mission['clue']."</td>
                                            <td>".$mission['score']."</td>
                                            <td>".$mission['location_n']." , ".$mission['location_e']."</td>
			                                <td class=\"center\">
                                                <a href=\"edit.php?mid=".$mission['mid']."&action=edit\" type=\"button\" class=\"btn btn-outline btn-primary btn-xs\">編輯</a>
                                                <a href=\"control.php?mid=".$mission['mid']."&action=delete\" type=\"button\" class=\"btn btn-outline btn-danger btn-xs\">刪除</a>
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
        $('a[href="/run/admin/pages/mission/index.php"]').addClass("active");
        $('a[href="/run/admin/pages/mission/index.php"]').parent().parent().removeClass("collapse");
    });
    </script>

</body>

</html>
