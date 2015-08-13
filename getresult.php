<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$db = new mysqli("localhost","root","","webdev1");

$result = $db->query("SELECT * FROM users");

$data = "";
while($r = $result->fetch_object()) {
    if ($data != "") {$data .= ",";}
    $data .= '{"uid":"'  . $r->uid . '",';
    $data .= '"Firstname":"'   . $r->firstname . '",';
    $data .= '"Lastname":"'   . $r->lastname . '",';
    $data .= '"Lastname":"'   . $r->lastname . '",';
    $data .= '"Age":"'   . $r->age . '",';
    $data .= '"Bio":"'. $r->bio . '"}'; 
    }
    $result->free();
$data ='{"records":['.$data.']}';
$db->close();
echo($data);
