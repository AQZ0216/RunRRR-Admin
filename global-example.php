<?php

static $api_url = "";
$object = null;
$action = null;

$attr_get = "";
$attr_post = array(
    "",
);

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

function MemberReadAll(){
    $object = "member";
    $action = "read";
    $attr_get = "operator_uid=1";
    $json_return = CurlGet("member", "read", $attr_get);
    return $json_return;
}
/*
function MemberReadById($uid)
function MemberMoneyEditById()
function MemberLiveOrDieById()
function MissionCreate($mission)
*/
function MissionReadAll(){
    $object = "mission";
    $action = "read";
    $attr_get = "operator_uid=1";
    $json_return = CurlGet("mission", "read", $attr_get);
    return $json_return;
}
/*
function MissionReadById($mid)
function MissionEditById($mission)
function MissionDeleteById($mid)

function ReportReadAll()
function ReportReadById($rid)
function ReportCheckById($rid)
function ReportDeleteById($rid)

function ToolCreate()
function ToolReadAll()
function ToolReadById($tid)
function ToolDeleteById($tid)

function ClueCreate()
function ClueReadAll()
function ClueReadById($cid)
function ClueDeleteById($cid)

function PackCreate()
function PackReadAll()
function PackReadByUserId($uid)
function PackDeleteByRecordId($pid)
*/

function CurlGet($object, $action, $attr_get){
    $ch = curl_init();
    $api_url = "http://nthuee.org:8081/api/v1.1/";
    curl_setopt($ch, CURLOPT_URL, $api_url. $object."/".$action."?".$attr_get);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $result = json_decode($result, true);
    curl_close($ch);
    return $result;
}

function CurlPost(){
    curl_setopt($ch, CURLOPT_URL, $api_url+"/"+$object+"/"+$action);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($attr_post));
    $result = curl_exec($ch);
    $result = json_decode($result, true);
    curl_close($ch);
    return $result;
}

function CurlPut(){
    curl_setopt($ch, CURLOPT_URL, $api_url+"/"+$object+"/"+$action);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($attr_post));
    $result = curl_exec($ch);
    $result = json_decode($result, true);
    curl_close($ch);
    return $result;
}

function CurlDelete(){
    curl_setopt($ch, CURLOPT_URL, $api_url+"/"+$object+"/"+$action);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($attr_post));
    $result = curl_exec($ch);
    $result = json_decode($result, true);
    curl_close($ch);
    return $result;

}

?>
