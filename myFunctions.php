
<?php
// contains useful required functions
require_once 'db_connection.php';

// will return the value of specified index from MySQL result
function getValueFromMySQLResult($result,$index) {
    mysql_data_seek($result, 0);
    while ($row = mysql_fetch_array($result)) {
        return $row[$index];
    }
}

//will return username from IMEI from database
function getUsernameFromIMEI($IMEI) {
    $sql="SELECT * FROM `users` WHERE `IMEI`='$IMEI'";
    $result = mysql_query($sql);
    $username = getValueFromMySQLResult($result, 'username');
    
    return $username;
}

//used to write to debug.txt file for debugging purpose
function debug($text)
{
    $file = fopen("debug.txt","a");
    fwrite($file,$text."\n");
    fclose($file);
}



class Participant{
    var $index;
    var $name;
    var $IMEI;
    
    function __construct($index,$name,$IMEI) {
        if($index>=0)
            $this->index=$index;
        
        $this->name=$name;
        $this->IMEI=$IMEI;
    }
    
}
?>
