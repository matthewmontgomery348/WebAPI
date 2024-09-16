<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');


$userName = $_REQUEST['userName'];
$finishTime=getFinishTime($userName);
$output = ['finishTime' => $finishTime];
echo json_encode($output);

exit();
