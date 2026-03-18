<?php
$servername ="localhost";
$username ="root";
$password ="Butare223!";
$dbname ="student_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    exit('Connection failed: '.$conn->connect_error);
}
?>
