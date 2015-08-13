<?php
require 'conx.php';
$data = json_decode(file_get_contents("php://input")); 
$uid = $data->uid;
$fn = $data->fn;    
$ln = $data->ln;
$age  = $data->age;
$bio = $data->bio;
$result = $db->query("UPDATE users SET firstname='$fn' , lastname='$ln', age='$age', bio='$bio' WHERE uid='$uid'");
