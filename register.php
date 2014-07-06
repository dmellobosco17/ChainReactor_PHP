<?php
require_once("db_connection.php");

$IMEI   = urldecode($_POST['IMEI']);
$username = urldecode($_POST['username']);
$mobile = urldecode($_POST['mobile']);
$feedback=array();

$sql="select * from `users` where `IMEI`='$IMEI'";
$result=mysql_query($sql);
if(mysql_num_rows($result)!=0)
{
	while($row=mysql_fetch_array($result))
	{
		$feedback['success']=FALSE;
		$feedback['message']="Device is already registered";
	
	}
}
else
{
$sql="insert into `users` values('$IMEI','$username','$mobile')";
$result=mysql_query($sql);

if($result=="1")
{
	$feedback['success']=TRUE;
	$feedback['message']="Device is registered successfully";
	$feedback['name']=$username;
	
}
else
{
	$feedback['success']=FALSE;
	$feedback['message']="Database error";
	
}
}
echo json_encode($feedback);

?>