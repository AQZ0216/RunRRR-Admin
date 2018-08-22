<?php

$api_url = "";
setcookie("operator_uid", "", time()+3600);
setcookie("token", "", time()+3600);

/* ----- HTTP CURL FUNCTIONS ----- */

function httpGet($object, $action, $params){
	global $api_url;
	$url = $api_url . $object . "/" . $action;

	$get_data = '';
	foreach($params as $key => $value){
		$get_data .= $key . '=' . $value . '&';
	}
	$get_data = rtrim($get_data, '&');

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url.'?'.$get_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$output = curl_exec($ch);

	curl_close($ch);
	return json_decode($output, TRUE);
}
function httpPost($object, $action, $params){
	global $api_url;
	$url = $api_url . $object . "/" . $action;

	$post_data = '';
	foreach($params as $key => $value){
		$post_data .= $key . '=' . $value . '&';
	}
	$post_data = rtrim($post_data, '&');

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_POST, count($post_data));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

	$output = curl_exec($ch);

	curl_close($ch);
	return json_decode($output, TRUE);
}
function httpPut($object, $action, $params){
	global $api_url;
	$url = $api_url . $object . "/" . $action;

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

	$output = curl_exec($ch);

	curl_close($ch);
	return json_decode($output, TRUE);
}
function httpDelete($object, $action, $params){
	global $api_url;
	$url = $api_url . $object . "/" . $action;

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

	$output = curl_exec($ch);

	curl_close($ch);
	return json_decode($output, TRUE);
}

/* ----- SYSTEM FUNCTIONS ----- */

function GetServerMemUsage(){
	$free = shell_exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
	$memory_usage = $mem[2]/$mem[1]*100;
	return $memory_usage;
}
function GetServerCpuUsage(){
	$load = sys_getloadavg();
	return $load[0];
}

/* ----- MEMBER FUNCTIONS ----- */

function MemberLogin($email, $password){
	$params = array(
		"email" => $email,
		"password" => $password
	);
	$json_return = httpPost("member", "login", $params);
	return $json_return;
}
function MemberReadById($uid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"uid" => $uid
	);
	$json_return = httpGet("member", "read", $params);
	return $json_return;
}
function MemberReadAll(){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"]
	);
	$json_return = httpGet("member", "read", $params);
	return $json_return;
}
function MemberReadAllNotification(){
	$ret['valid_area'] = 1;
	$ret['help_status'] = 0;
	$member_array = MemberReadAll();
	$member_array = $member_array['payload']['objects'];
	foreach($member_array as $member){
		if($member['valid_area'] == 0 && $member['uid'] < 10000){
			$ret['valid_area'] = 0;
			break;
		}
	}
	foreach($member_array as $member){
		if($member['help_status'] == 1 && $member['uid'] < 10000){
			$ret['help_status'] = 1;
			break;
		}
	}
	return $ret;
}
function MemberMoneyEditById($uid, $money_amount){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"uid" => $uid,
		"money_amount" => $money_amount
	);
	$json_return = httpPut("member", "money", $params);
	return $json_return;
}
function MemberScoreEditById($uid, $score_amount){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"uid" => $uid,
		"score" => $score_amount
	);
	$json_return = httpPut("member", "score", $params);
	print_r($params);
	return $json_return;
}
function MemberDieById($uid, $status){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"uid" => $uid,
		"status" => $status
	);
	$json_return = httpPut("member", "liveordie", $params);
	return $json_return;
}
function MemberCallHelp($uid, $position_e, $position_n){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"uid" => $uid,
		"position_e" => $position_e,
		"position_n" => $position_n
	);
	$json_return = httpPut("member", "callhelp", $params);
	return $json_return;
}

/* ----- MISSION FUNCTIONS ----- */

function MissionCreate($mission, $image){
	$params = $mission;
	$params['operator_uid'] = $_COOKIE["operator_uid"];
	$params['token'] = $_COOKIE["token"];
	if(isset($image)){
		$params['image'] = $image;
	}
	print_r($params);
	$json_return = httpPost("mission", "create", $params);
	return $json_return;
}
function MissionReadAll(){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"]
	);
	$json_return = httpGet("mission", "read", $params);
	return $json_return;
}
function MissionReadById($mid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"mid" => $mid
	);
	$json_return = httpGet("mission", "read", $params);
	return $json_return;
}
function MissionEditById($id, $mission, $image){
	$params = $mission;
	$params['mid'] = $id;
	if(isset($image)){
		$params['image'] = $image;
	}
	$params['operator_uid'] = $_COOKIE["operator_uid"];
	$params['token'] = $_COOKIE["token"];
	$json_return = httpPut("mission", "edit", $params);
	return $json_return;
}
function MissionDeleteById($mid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"mid" => $mid
	);
	$json_return = httpDelete("mission", "delete", $params);
	return $json_return;
}

/* ----- REPORT FUNCTIONS ----- */

function ReportReadByMissionId($mid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"mid" => $mid
	);
	$json_return = httpGet("report", "read", $params);
	return $json_return;
}
function ReportReadByUserId($uid){
	// TODO Check auth level?
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"uid" => $uid
	);
	$json_return = httpGet("report", "read", $params);
	return $json_return;
}
function ReportCheckById($rid, $status){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"rid" => $rid,
		"status" => $status
	);
	$json_return = httpPut("report", "check", $params);
	return $json_return;
}
function ReportDeleteById($rid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"rid" => $rid
	);
	$json_return = httpDelete("report", "delete", $params);
	return $json_return;
}

/* ----- TOOL FUNCTIONS ----- */

function ToolCreate($tool, $image){
	$params = $tool;
	$params['image'] = $image;
	$params['operator_uid'] = $_COOKIE["operator_uid"];
	$params['token'] = $_COOKIE["token"];
	$json_return = httpPost("tool", "create", $params);
	return $json_return;
}
function ToolReadAll(){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"]
	);
	$json_return = httpGet("tool", "read", $params);
	return $json_return;
}
function ToolReadById($tid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"tid" => $tid
	);
	$json_return = httpGet("tool", "read", $params);
	return $json_return;
}
function ToolDeleteById($tid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"tid" => $tid
	);
	$json_return = httpDelete("tool", "delete", $params);
	return $json_return;
}

/* ----- CLUE FUNCTIONS ----- */

function ClueCreate($content){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"content" => $content
	);
	$json_return = httpPost("clue", "create", $params);
	return $json_return;
}
function ClueReadAll(){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"]
	);
	$json_return = httpGet("clue", "read", $params);
	return $json_return;
}
function ClueReadById($cid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"cid" => $cid
	);
	$json_return = httpGet("clue", "read", $params);
	return $json_return;
}
function ClueDeleteById($cid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"cid" => $cid
	);
	$json_return = httpDelete("clue", "delete", $params);
	return $json_return;
}

/* ----- PACK FUNCTIONS ----- */

function PackCreate($pack){
	$params = $pack;
	$params['operator_uid'] = $_COOKIE["operator_uid"];
	$params['token'] = $_COOKIE["token"];
	$json_return = httpPost("pack", "create", $params);
	return $json_return;
}
function PackReadAll(){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"]
	);
	$json_return = httpGet("pack", "read", $params);
	return $json_return;
}
function PackReadByUserId($uid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"uid" => $uid
	);
	$json_return = httpGet("pack", "read", $params);
	return $json_return;
}
function PackDeleteByRecordId($pid){
	$params = array(
		"operator_uid" => $_COOKIE["operator_uid"],
		"token" => $_COOKIE["token"],
		"pid" => $pid
	);
	$json_return = httpDelete("pack", "delete", $params);
	return $json_return;
}



$pack = array(
	"uid" => "380",
	"class" => "TOOL",
	"id" => "6"
);

#$imagedata = file_get_contents("1.jpg");
#$base64 = base64_encode($imagedata);
#$base64 = urlencode($base64);

$tool = array(
	"title" => "(Test)全新的鐵肝",
	"content" => "使用後獵人被砸中無法移動 10 秒。",
	"expire" => "10",
	"price" => "100"
);

$mission = array(
	"title" => "(Test)護肝計畫",
	"content" => "淳佑的肝臟一天一天變得更堅硬了。請到小吃部商店購買一罐蜆精，並送到名人堂門口給淳佑。",
	"time_start" => "2017-04-01 14:00:00",
	"time_end" => "2017-04-01 15:30:00",
	"prize" => "100",
	"clue" => "1",
	"class" => "SUB",
	"score" => "10",
	"location_e" => "120.993038",
	"location_n" => "24.793919"
);

/* Mission image cannot upload, mission cannot edit */

// Not tested yet: /member/update /report/delete
?>
