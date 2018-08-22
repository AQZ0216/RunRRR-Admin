<?php
	require_once("../../config.php");
	$action = $_GET['action'];

	if($action == 'create'){
		$content = $_GET['content'];
		ClueCreate($content);
		header("Location: index.php?status=updated");
		exit();
	}
	else if($action == 'delete'){
		$cid = $_GET['cid'];
		ClueDeleteById($cid);
		header("Location: index.php?status=updated");
		exit();
	}
?>