<?php
require 'conx.php';
$data = json_decode(file_get_contents("php://input")); 
$fn = $data->fn;    
$ln = $data->ln;
$age = $data->age;
$bio = $data->bio;
    
$result = $db->query("INSERT INTO users(firstname,lastname,age,bio) values('$fn','$ln','$age','$bio')");

