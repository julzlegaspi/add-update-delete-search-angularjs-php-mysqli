<?php
$db = new mysqli("localhost","root","","webdev1");
if($db->connect_error){
    echo "May Problema si Juan :(";
}