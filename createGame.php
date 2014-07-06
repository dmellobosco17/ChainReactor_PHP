<?php

require_once("db_connection.php");
require_once("myFunctions.php");

$IMEI   = urldecode($_POST['IMEI']);
$PIN = urldecode($_POST['PIN']);
$privacy = urldecode($_POST['privacy']);

$feedback=array();

$sql="select * from `games` where `admin`='$IMEI'";
$result=mysql_query($sql);
if(mysql_num_rows($result)!=0)
{
	$feedback['success']=FALSE;
	$feedback['message']="User already created game";
	while($row=mysql_fetch_array($result))
	{
		$feedback['pin']=$row['PIN'];
	}
}
else
{
        $username = getUsernameFromIMEI($IMEI);
        $admin=new Participant(0,$username,$IMEI);
        $participants=array();
        $participants[0]=$admin;
        
	$sql="insert into `games` (`admin`, `PIN`, `participants`, `num_of_participants`, `game`, `active_participant`, `DOE`, `privacy`) VALUES ('$IMEI','$PIN','".json_encode($participants)."',1,'{}','0',CURDATE()+2,'$privacy')";
	$result=mysql_query($sql);
	if($result=="1")
	{
		$feedback['success']=TRUE;
                $feedback['pin']=$PIN;
		
	}
	else
	{
		$sql="select * from `games` where `PIN`='$PIN'";
		$result=mysql_query($sql);
		if(mysql_num_rows($result)!=0)
		{
			$feedback['success']=FALSE;
			$feedback['message']="PIN already in use";
			
		}
		else
		{
			$feedback['success']=FALSE;
			$feedback['message']="Database Error";
		}
	}
}

echo json_encode($feedback);

?>