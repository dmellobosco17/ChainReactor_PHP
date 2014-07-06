<?php
/*
 * last edited(18/6/2014)
 * 
 */
require_once("db_connection.php");

$IMEI   = urldecode($_POST['IMEI']);
$feedback=array();
$isRegistered=FALSE;

$sql="select * from `users` where `IMEI`='".$IMEI."'";
$result=mysql_query($sql);

if(mysql_num_rows($result)==0)
{
	$feedback['registered']=FALSE;
}
else
{
	$feedback['registered']=TRUE;
	while($row=mysql_fetch_array($result))
	{
		$feedback['name']=$row['username'];
	}
}

echo json_encode($feedback);
?>