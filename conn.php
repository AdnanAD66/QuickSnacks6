<?php

$username="root";
$host="localhost";
$password="";
$db_name="online_mart";

$conn=new mysqli($host,$username,$password,$db_name);
// $conn=mysqli_connect($host,$username,$password,$db_name);

if($conn->connect_error)
{
    die("Connection Failed : ".$conn->connect_error);
}


?>