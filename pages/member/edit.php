<?php require_once("../../config.php"); ?>
<?php $uid = $_GET['uid']; $member = MemberReadById($uid)['payload']['objects'][0]; ?>
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
                        隊員管理：<?php echo $member['uid'] . " " . $member['name']; ?>
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
                        <div class="panel-heading">
                            個人資料編輯
                        </div>
                        <div class="panel-body">
                            <form action="control.php" method="GET">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="uid" value="<?php echo $member['uid']; ?>">
                                        <div class="form-group">
                                            <label>姓名</label>
                                            <p class="form-control-static"><?php echo $member['name']; ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>分數</label>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <p class="form-control-static"><?php echo $member['score']; ?> 分</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">增減分數</span>
                                                        <input type="text" class="form-control" name="score-amount">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>現金</label>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <p class="form-control-static"><?php echo $member['money']; ?> 元</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon">增減金額</span>
                                                        <input type="text" class="form-control" name="money-amount">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>生存狀態</label>
                                            <br>
                                            <label class="radio-inline">
                                                <input type="radio" name="liveordie" id="liveordie-live" value="0" <?php if($member['status'] == 1) echo "checked"; ?>>生存
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="liveordie" id="liveordie-die" value="1" <?php if($member['status'] == 0) echo "checked"; ?>>死亡
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>緊急狀態指示</label>
                                            <br>
                                            <div class="col-lg-2">
                                                <p class="form-control-static">
                                                    <?php if($member['help_status']==1)echo "<span class=\"text-danger\">求救中</span>"; else echo "正常"; ?>
                                                </p>
                                            </div>
                                            <div class="col-lg-10">
                                                <?php if($member['help_status']==1)echo "<a href=\"control.php?action=callhelp&uid=".$member['uid']."\" class=\"btn btn-danger btn-block btn-sm\">狀態賦歸</a>" ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label>GPS 座標位置</label>
                                            <p class="form-control-static"><?php echo $member['position_n'] . " , " . $member['position_e']; ?></p>
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
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>地圖位置</label>
                                            <div id="map" style="width:100%; height:400px;"></div>
                                        </div>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            背包物品一覽
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th width="10%">#</th>
                                                <th width="10%">類別</th>
                                                <th width="70%">名稱</th>
                                                <th width="10%">編輯</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $pack_array = PackReadByUserId($member['uid']);
                                                $pack_array = $pack_array['payload']['objects'];
                                                foreach($pack_array as $pack){
                                                    if($pack['class'] == "TOOL")
                                                        $pack['content'] = ToolReadById($pack['id'])['payload']['objects'][0]['title'];
                                                    else
                                                        $pack['content'] = ClueReadById($pack['id'])['payload']['objects'][0]['content'];
                                                    echo "
                                                        <tr>
                                                            <td>".$pack['pid']."</td>
                                                            <td>".$pack['class']."</td>
                                                            <td>".$pack['content']."</td>
                                                            <td class=\"center\">
                                                                <a href=\"control.php?action=packdelete&uid=".$pack['uid']."&pid=".$pack['pid']."\" type=\"button\" class=\"btn btn-outline btn-danger btn-xs\">刪除</a>
                                                            </td>
                                                        </tr>
                                                    ";
                                                }
                                            ?>

                                        </tbody>
                                    </table>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
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

    <script>
      function initMap() {
        var member = {lat: <?php echo $member['position_n']; ?>, lng: <?php echo $member['position_e'];?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: member
        });
        var marker = new google.maps.Marker({
          position: member,
          map: map
        });
        var boundaryLayer = new google.maps.KmlLayer({
          url: 'http://nthuee.org:8081/api/v1.1/download/map/boundary.kml?rev='+new Date().getTime(),
          map: map,
          suppressInfoWindows: false,
          clickable: false,
          screenOverlays: false
        });
      }
    </script>

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

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAQzfAGUZKKu4bRH1wNsekrK1JeKMm6YQ&callback=initMap">
    </script>
</body>

</html>
