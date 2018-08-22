<?php require_once("../../config.php"); ?>
<?php
    if($_GET['action']=='edit'){
        $mid = $_GET['mid'];
        $mission = MissionReadById($mid)['payload']['objects'][0]; 
    }
?>
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
                        <span class="pull-right">
                            <a href="index.php" type="button" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i>&nbsp;返回清單</a>
                        </span>
                        任務管理：<?php if($_GET['action']=='edit') echo $mission['mid'] . " " . $mission['title']; else echo "新增任務";?>
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
                            <form action="control.php?action=<?php echo $_GET['action']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="hidden" name="action" value="<?php echo $_GET['action']; ?>">
                                        <input type="hidden" name="mid" <?php if($_GET['action']=='edit') echo "value=\"".$mission['mid']."\""; ?>>
                                        <input type="hidden" name="location_e" id="location_e" <?php if($_GET['action']=='edit') echo "value=\"".$mission['location_e']."\""; ?>>
                                        <input type="hidden" name="location_n" id="location_n" <?php if($_GET['action']=='edit') echo "value=\"".$mission['location_n']."\""; ?>>
                                        <div class="form-group">
                                            <label>名稱</label>
                                                <input type="text" class="form-control" name="title" <?php if($_GET['action']=='edit') echo "value=\"".$mission['title']."\""; ?> required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>開始 / 結束時間</label>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="datetime-local" class="form-control" name="time-start" <?php if($_GET['action']=='edit') echo "value=\"".date('Y-m-d', strtotime($mission['time_start']))."T".date('H:i', strtotime($mission['time_start']))."\""; ?> required="required">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="datetime-local" class="form-control" name="time-end" <?php if($_GET['action']=='edit') echo "value=\"".date('Y-m-d', strtotime($mission['time_end']))."T".date('H:i', strtotime($mission['time_end']))."\""; ?> required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>完成獎金</label>
                                            <input type="text" class="form-control" name="prize" <?php if($_GET['action']=='edit') echo "value=\"".$mission['prize']."\""; ?> required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>分數</label>
                                            <input type="text" class="form-control" name="score" <?php if($_GET['action']=='edit') echo "value=\"".$mission['score']."\""; ?> required="required">
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>分類</label>
                                            <br>
                                            <label class="radio-inline">
                                                <input type="radio" name="class" id="class-main" value="MAIN" <?php if($mission['class'] == 'MAIN') echo "checked"; ?>>主線
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="class" id="class-sub" value="SUB" <?php if($mission['class'] == 'SUB') echo "checked"; ?>>支線
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="class" id="class-urg" value="URG" <?php if($mission['class'] == 'URG') echo "checked"; ?>>緊急
                                            </label>
                                        </div><div class="form-group">
                                            <label>內容說明</label>
                                            <textarea class="form-control" rows="3" name="content"><?php if($_GET['action']=='edit') echo $mission['content']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>完成線索</label>
                                            <select class="form-control" name="clue">
                                                <option value="0">不給予線索</option>
                                                <?php
                                                    $clue_array = ClueReadAll();
                                                    $clue_array = $clue_array['payload']['objects'];
                                                    foreach($clue_array as $clue){
                                                        echo "<option value=\"".$clue['cid']."\"";
                                                        if($mission['clue']==$clue['cid']){
                                                            echo "selected";
                                                        }
                                                        echo ">".$clue['content']."</option>
                                                        ";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <?php if($_GET['action']=='edit') echo "<span class=\"pull-right\"><a class=\"btn btn-outline btn-primary btn-xs\" onclick=\"lightboxShowApiImage('".$mission['url']."')\">顯示現有圖片</a></span>"; ?>
                                            <label>
                                                示範照片上傳
                                            </label>
                                            <input type="file" name="file" id="file">

                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <!-- /.row (nested) -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>地圖位置（拖曳標記以設定位置）</label>
                                            <div id="map" style="width:100%; height:400px;"></div>
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

    <script>
        var prev_infowindow =false; 
        function initMap() {
            var geo_map_center = {lat: <?php if($_GET['action']=='edit') echo $mission['location_n']; else echo "24.7958392";?>, lng: <?php if($_GET['action']=='edit') echo $mission['location_e']; else echo "120.9922496";?>};
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 17,
              center: geo_map_center
            });
            var boundaryLayer = new google.maps.KmlLayer({
              url: 'http://nthuee.org:8081/api/v1.1/download/map/boundary.kml?rev='+new Date().getTime(),
              map: map,
              suppressInfoWindows: false,
              clickable: false
            });
            console.log(boundaryLayer);
            var marker = new google.maps.Marker({
                position: {lat: <?php if($_GET['action']=='edit') echo $mission['location_n']; else echo "24.7958392";?>, lng: <?php if($_GET['action']=='edit') echo $mission['location_e']; else echo "120.9922496";?>},
                map: map,
                draggable: true
            });
            marker.addListener('position_changed', function() {
                var position = this.getPosition();
                document.getElementById("location_n").value = position.lat().toString();
                document.getElementById("location_e").value = position.lng().toString();
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
        $('a[href="/run/admin/pages/mission/index.php"]').addClass("active");
        $('a[href="/run/admin/pages/mission/index.php"]').parent().parent().removeClass("collapse");
    });
    </script>
</body>

</html>
