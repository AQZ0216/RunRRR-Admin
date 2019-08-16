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
                        隊員管理：地圖瀏覽
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="map" style="width:100%; height:600px;"></div>
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
        var map;
        var marker = [];

        <?php
            /*$member_array = MemberReadAll();
            $member_array = $member_array['payload']['objects'];
            foreach($member_array as $member){
                if($member['uid'] > 10000){
                    continue;
                }
                echo "
                    var marker".$member['uid'].";";
            }*/
        ?>
        function initMap() {
            var geo_nthu = {lat: 24.7939266, lng: 120.9929205};
            map = new google.maps.Map(document.getElementById('map'), {
              zoom: 17,
              center: geo_nthu
            });
            <?php
                $member_array = MemberReadAll();
                $member_array = $member_array['payload']['objects'];
                foreach($member_array as $member){
                    if($member['uid'] > 10000){
                        continue;
                    }
                    echo "
                        marker[".$member['uid']."] = new google.maps.Marker({
                          position: {lat: ".$member['position_n'].", lng: ".$member['position_e']."},
                          map: map,
                          title: \"".$member['name']."\",
                          label: \"".$member['name']."\"
                        });
                        marker[".$member['uid']."].setMap(map);
                    ";
                }
            ?>
            var boundaryLayer = new google.maps.KmlLayer({
              url: 'http://nthuee.org:8081/api/v1.1/download/map/boundary.kml?rev='+new Date().getTime(),
              map: map,
              suppressInfoWindows: false,
              clickable: false,
              screenOverlays: false
            });
            setInterval(updateMap, 5000);
        }



        function updateMap(){

            $.ajax({
                url: "control.php?action=readall&uid=0",
                type: 'GET'
            })
            .done(function(data){
                var member_array = JSON.parse(data).payload.objects;
                member_array.forEach(function(val, index, arr){
                    uid=val.uid;
                    lat=val.position_n;
                    lng=val.position_e;
                    mk = marker[uid];
                    mk.setPosition({lat: lat, lng:lng});
                })
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
        $('a[href="/run/admin/pages/member/map.php"]').addClass("active");
        $('a[href="/run/admin/pages/member/map.php"]').parent().parent().removeClass("collapse");
    });
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAQzfAGUZKKu4bRH1wNsekrK1JeKMm6YQ&callback=initMap">
    </script>
</body>

</html>
