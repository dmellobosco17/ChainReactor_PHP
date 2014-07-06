<?php
require_once("db_connection.php");

$sql="TRUNCATE TABLE  `users`";
$result=mysql_query($sql);
$sql="TRUNCATE TABLE  `games`";
$result=mysql_query($sql);

echo $result;

?>