<?php
    require_once("../../config.php");
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    $action = $_GET['action'];

    if($action == 'create'){
        $tool['title'] = $_POST['title'];
        $tool['content'] = $_POST['content'];
        $tool['price'] = $_POST['price'];
        $tool['expire'] = $_POST['expire'];
        $imagedata = file_get_contents($_FILES['file']['tmp_name']);
        $base64 = urlencode(base64_encode($imagedata));
        ToolCreate($tool, $base64);
        header("Location: index.php?status=updated");
        exit();
    }
    else if($action == 'delete'){
        $tid = $_GET['tid'];
        ToolDeleteById($tid);
        header("Location: index.php?status=updated");
        exit();
    }
?>