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
                    <h1 class="page-header">任務回報管理：已審回報</h1>
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
                                <th width="15%">使用者</th>
                                <th width="40%">任務</th>
                                <th width="20%">照片</th>
                                <th width="15%">編輯</th>
                            </tr>
                        </thead>
                        <tbody>
		            		<?php
                                $mission_array = MissionReadAll()['payload']['objects'];
                                foreach($mission_array as $mission){   
                                    $report_array = ReportReadByMissionId($mission['mid']);
                                    if(!isset($report_array['payload'])) continue;
    		            			$report_array = $report_array['payload']['objects'];
    		            			foreach($report_array as $report){
                                        if($report['status'] == 0) continue;
                                        else if($report['status'] == 1) $class = "success";
                                        else $class = "warning";
    		            				echo "
    					            		<tr class=\"".$class."\">
    			                                <td class=\"center\">".$report['rid']."</td>
                                                <td>".MemberReadById($report['uid'])['payload']['objects'][0]['name']."</td>
                                                <td>".MissionReadById($report['mid'])['payload']['objects'][0]['title']."</td>
                                                <td><button onclick=\"lightboxShowApiImage('".$report['url']."');\" type=\"button\" class=\"btn btn-outline btn-primary btn-xs btn-block\">查看圖片</button></td>
    			                                <td class=\"center\">
                                                    <a href=\"control.php?rid=".$report['rid']."&action=default&uid=".$report['uid']."&mid=".$report['mid']."\" type=\"button\" class=\"btn btn-outline btn-default btn-xs\">取消審核狀態</a>
                                                    <a href=\"control.php?rid=".$report['rid']."&action=delete\" type=\"button\" class=\"btn btn-outline btn-danger btn-xs\">刪除</a>
                                                </td>
    			                            </tr>
                                		";
    		            			}
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
        $('a[href="/run/admin/pages/report/finished.php"]').addClass("active");
        $('a[href="/run/admin/pages/report/finished.php"]').parent().parent().removeClass("collapse");
    });
    </script>

</body>

</html>
