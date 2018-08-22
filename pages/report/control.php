<?php
	require_once("../../config.php");
	$rid = $_GET['rid'];
	$action = $_GET['action'];

	if($action == 'default'){
		$uid = $_GET['uid'];
		$mid = $_GET['mid'];
		$mission_array = MissionReadById($mid)['payload']['objects'][0];
		$mission_score = $mission_array['score'];
		$mission_money = $mission_array['prize'];
		$mission_clue = $mission_array['clue'];
		ReportCheckById($rid, 0);
		$pack_array = PackReadByUserId($uid);
		$pack_array = $pack_array['payload']['objects'];
		foreach($pack_array as $pack){
			if($pack['id'] == $mission_clue){
				PackDeleteByRecordId($pack['pid']);
				break;
			}
		}
		MemberScoreEditById($uid, "-".$mission_score);
		MemberMoneyEditById($uid, "-".$mission_money);
		header("Location: finished.php?status=updated");
		exit();
	}
	else if($action == 'pass'){
		$uid = $_GET['uid'];
		$mid = $_GET['mid'];
		$mission_array = MissionReadById($mid)['payload']['objects'][0];
		$mission_score = $mission_array['score'];
		$mission_money = $mission_array['prize'];
		$mission_clue = $mission_array['clue'];
		ReportCheckById($rid, 1);
		$pack['uid'] = $uid;
		$pack['class'] = "CLUE";
		$pack['id'] = $mission_clue;
		if($mission_clue != "0")
			PackCreate($pack);
		MemberScoreEditById($uid, $mission_score);
		MemberMoneyEditById($uid, $mission_money);
		header("Location: index.php?status=updated");
		exit();
	}
	else if($action == 'fail'){
		ReportCheckById($rid, 2);
		header("Location: index.php?status=updated");
		exit();
	}
	else if($action == 'delete'){
		ReportDeleteById($rid);
		header("Location: index.php?status=updated");
		exit();
	}
?>