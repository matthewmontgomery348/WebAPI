<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
require('functions.inc.php');


$userName = $_REQUEST['userName'];
$startTime=getStartTime($userName);
$output = ['startTime' => $startTime];
echo json_encode($output);

exit();
