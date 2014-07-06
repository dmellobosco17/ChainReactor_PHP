<?php
require_once("db_connection.php");
require_once './myFunctions.php';

$IMEI   = urldecode($_POST['IMEI']);

$feedback=array();

$sql="SELECT * FROM `games`";
$result=  mysql_query($sql);

while ($row = mysql_fetch_array($result)) {
    $game=array();
    $game['name']=  getUsernameFromIMEI($row['admin']);
    $game['pin']=$row['PIN'];
    array_push($feedback, $game);
}

echo json_encode($feedback);
?>
