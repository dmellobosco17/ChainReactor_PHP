<?php

require_once("db_connection.php");
require_once './myFunctions.php';

$IMEI   = urldecode($_POST['IMEI']);
$PIN = urldecode($_POST['PIN']);

$feedback=array();

$sql="select * from `games` where `PIN`='$PIN'";
$result=mysql_query($sql);

if(mysql_num_rows($result)==0) {
    $feedback['success'] = FALSE;
    $feedback['message'] = "PIN is not registered";
    $feedback['pin'] = $PIN;
    
}
else
{
    $feedback['success'] = TRUE;
    $feedback['pin'] = $PIN;
    while($row = mysql_fetch_array($result)) {
        $feedback['participants'] = $row['participants'];
        
    }
    
}

echo json_encode($feedback);
?>
