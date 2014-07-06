<?php

require_once("db_connection.php");
require_once 'gameObject.php';

$IMEI   = urldecode($_POST['IMEI']);
$PIN = urldecode($_POST['PIN']);

$feedback=array();

$sql="select * from `games` where `PIN`='$PIN'";
$result=mysql_query($sql);

if(mysql_num_rows($result)==0) {
    $feedback['success'] = FALSE;
    $feedback['message'] = "PIN is not registered";
    $feedback['pin'] = $PIN;
    
}else {
    $game = new Game($PIN);
    $name=  getUsernameFromIMEI($IMEI);
    $participant =new Participant(-1, $name, $IMEI);
    $result = $game->addParticipant($participant);
    
    if($result==FALSE)
    {
        $feedback['success'] = FALSE;
        $feedback['message'] = $game->errorMsg;
        $feedback['pin'] = $PIN;
    }
    else
    {
        $feedback['success'] = TRUE;
        $feedback['message'] = $game->errorMsg;
        $feedback['pin'] = $PIN;
    }
    
    $game->commitChanges();
    
    
    echo json_encode($feedback);
}
?>
