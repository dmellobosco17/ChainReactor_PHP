<?php
$User_name="root";
$DB_name="chain_reactor";
$DB_Password="";
$DB_Server="localhost";

global $con;
$con = mysql_connect($DB_Server,$User_name,$DB_Password);
mysql_select_db($DB_name,$con);

?>