<?php
//header('Content-type: text/html; utf8mb4');

$pass = "Re@welkom01";
$user = "seefting";
$server = "localhost";
$name = "seefting";
$connection = new mysqli("localhost","seefting","Re@welkom01","seefting");

$connection->set_charset("utf8");

if($connection->connect_errno)
{
    exit("Database Connection Failed. Reason: ".$connection->connect_error);
}
/*try {
  $newconnection = new PDO("mysql:host=$server;dbname=seefting", $user, $pass);
  // set the PDO error mode to exception
  $newconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
*/
?>