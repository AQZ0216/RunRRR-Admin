<?php
	require_once("../../config.php");
	$action = $_GET['action'];
	$uid = $_GET['uid'];

	if($action == 'update'){
		MemberDieById($uid, $_GET['liveordie']);
		MemberMoneyEditById($uid, $_GET['money-amount']);
		MemberScoreEditById($uid, $_GET['score-amount']);
		header("Location: edit.php?uid=".$uid."&status=updated");
		exit();
	}
	else if($action == 'callhelp'){
		$member = MemberReadById($uid)['payload']['objects'][0];
		MemberCallHelp($uid, $member['position_e'], $member['position_n']);
		header("Location: edit.php?uid=".$uid."&status=updated");
		exit();
	}
	else if($action == 'switch-liveordie'){
		$status = MemberReadById($uid)['payload']['objects'][0]['status'];
		if($status == 1)
			MemberDieById($uid, 1);
		else
			MemberDieById($uid, 0);
		header("Location: index.php?status=updated");
		exit();
	}
	else if($action == 'readall'){
		echo json_encode(MemberReadAll());
		exit();
	}
	else if($action == 'packdelete'){
		PackDeleteByRecordId($_GET['pid']);
		header("Location: edit.php?uid=".$uid."&status=updated");
		exit();
	}
?>