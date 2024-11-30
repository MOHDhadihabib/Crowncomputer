<?php
 $server = 'localhost';
 $username = 'root';
 $password = '';
 $database = 'db_crowncomputer';



 $conn = mysqli_connect($server, $username, $password, $database);


 if (!$conn) {
     echo die("con filed" . mysqli_connect_errno());
 } 


?>