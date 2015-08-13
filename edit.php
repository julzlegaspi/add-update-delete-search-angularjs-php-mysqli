 <?php
require 'conx.php';
$data = json_decode(file_get_contents("php://input"));     
$uid = $data->uid; 
$result = $db->query("SELECT * from users WHERE uid='$uid'");
$d = array();
while($r = $result->fetch_object())
{
    $d[] = array(
                "uid" =>  $r->uid,
                "Firstname" => $r->firstname,
                "Lastname" => $r->lastname,
                "Age" => $r->age,
                "Bio" => $r->bio
                );
}
print_r(json_encode($d));
return json_encode($d);  