<?php

require_once 'gameObject.php';
$PIN='1234';

$sql = "SELECT * FROM `games` WHERE `PIN`='$PIN'";
$result = mysql_query($sql);
$usersCode = getValueFromMySQLResult($result, "participants");
$usersCode = explode(",", $usersCode);
$users=array();

foreach ($usersCode as $user) {
    $users[] = User::fromCode($user);
}
print_r($users);

?>
