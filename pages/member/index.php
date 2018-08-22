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
                    <h1 class="page-header">隊員管理</h1>
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
                                <th width="10%">姓名</th>
                                <th width="10%">生存</th>
                                <th width="10%">求救</th>
                                <th width="10%">分數</th>
                                <th width="10%">現金</th>
                                <th width="20%">小隊別</th>
                                <th width="20%">編輯</th>
                            </tr>
                        </thead>
                        <tbody>
		            		<?php
		            			$member_array = MemberReadAll();
		            			$member_array = $member_array['payload']['objects'];
		            			foreach($member_array as $member){
                                    if($member['uid'] > 10000){
                                        continue;
                                    }
		            				echo "
					            		<tr>
			                                <td>".$member['uid']."</td>
                                            <td>".$member['name']."</td>
                                            <td>".$member['status']."</td>
                                            <td>".$member['help_status']."</td>
                                            <td>".$member['score']."</td>
                                            <td>".$member['money']."</td>
                                            <td>第 ".$member['squad']." 小隊</td>
			                                <td class=\"center\">
                                                <a href=\"control.php?action=switch-liveordie&uid=".$member['uid']."\" type=\"button\" class=\"btn btn-outline btn-warning btn-xs\">切換生存狀態</a>
                                                <a href=\"edit.php?uid=".$member['uid']."\" type=\"button\" class=\"btn btn-outline btn-primary btn-xs\">編輯詳細資料</a>
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
        $('a[href="/run/admin/pages/member/index.php"]').addClass("active");
        $('a[href="/run/admin/pages/member/index.php"]').parent().parent().removeClass("collapse");
    });
    </script>

</body>

</html>
