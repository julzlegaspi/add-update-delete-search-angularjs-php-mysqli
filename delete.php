<?php
require 'conx.php';
$data = json_decode(file_get_contents("php://input"));     
$uid = $data->uid;
$result = $db->query("DELETE FROM users WHERE uid ='$uid'");
if($result)
return true;
return false; 