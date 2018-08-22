<?php
    require_once("../../config.php");
    $action = $_GET['action'];

    if($action == 'create'){
        $mission['title'] = $_POST['title'];
        $mission['content'] = $_POST['content'];
        $mission['time_start'] = $_POST['time-start'];
        $mission['time_end'] = $_POST['time-end'];
        $mission['prize'] = $_POST['prize'];
        $mission['clue'] = $_POST['clue'];
        $mission['class'] = $_POST['class'];
        $mission['score'] = $_POST['score'];
        $mission['location_e'] = round($_POST['location_e'], 6);
        $mission['location_n'] = round($_POST['location_n'], 6);
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $imagedata = file_get_contents($_FILES['file']['tmp_name']);
            $base64 = urlencode(base64_encode($imagedata));
            print_r(MissionCreate($mission, $base64));
        }
        else{
            echo "No image upload".
            print_r(MissionCreate($mission, NULL));
        }
        header("Location: index.php?status=updated");
        exit();
    }
    else if($action == 'edit'){
        $mid = $_POST['mid'];
        $mission['title'] = $_POST['title'];
        $mission['content'] = $_POST['content'];
        $mission['time_start'] = $_POST['time-start'].":00.000Z";
        $mission['time_end'] = $_POST['time-end'].":00.000Z";
        $mission['prize'] = $_POST['prize'];
        $mission['clue'] = $_POST['clue'];
        $mission['class'] = $_POST['class'];
        $mission['score'] = $_POST['score'];
        $mission['location_e'] = round($_POST['location_e'], 6);
        $mission['location_n'] = round($_POST['location_n'], 6);
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $imagedata = file_get_contents($_FILES['file']['tmp_name']);
            $base64 = urlencode(base64_encode($imagedata));
            MissionEditById($mid, $mission, $base64);
        }
        else{
            print_r(MissionEditById($mid, $mission, NULL));
            print_r($mission);
        }
        header("Location: index.php?status=updated");
        exit();
    }
    else if($action == 'delete'){
        $mid = $_GET['mid'];
        MissionDeleteById($mid);
        header("Location: index.php?status=updated");
        exit();
    }
?>