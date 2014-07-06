<?php
require_once 'db_connection.php';
require_once 'myFunctions.php';

class Game {
    var $admin;
    var $activeParticipant;
    var $errorMsg="";
    var $maxNumOfUsers=8;
    var $participants=array();
    var $numOfParticipants;
    var $PIN;
    var $DOE;
    var $privacy;
    var $gameCode;
    
    function __construct($PIN) {
        $sql="select * from `games` where `PIN`='$PIN'";
        $result=mysql_query($sql);
        if(mysql_num_rows($result)==0){
            $this->errorMsg="Invalid PIN";
        }
        else{
            $this->admin = getValueFromMySQLResult($result, "admin");
            $this->PIN=$PIN;
            $this->participants=  json_decode(getValueFromMySQLResult($result, "participants"),TRUE);
            //array_push($this->participants,$participants);
            $this->numOfParticipants=  (int)getValueFromMySQLResult($result, "num_of_participants");
            $this->gameCode=  getValueFromMySQLResult($result, "game");
            $this->activeParticipant=  (int)getValueFromMySQLResult($result, "active_participant");
            $this->DOE=  getValueFromMySQLResult($result, "DOE");
        }
    }
    
    function addParticipant($participant){
        if($this->maxNumOfUsers==$this->participants){
            $this->errorMsg.="Number of participants is exceeding the limit. Allowed participants:".$this->maxNumOfUsers;
            return FALSE;
        }
        for($i=0;$i<sizeof($this->participants);$i++){
            debug($this->participants[$i]['IMEI']);
            if($this->participants[$i]['IMEI']==$participant->IMEI){
                $this->errorMsg.="$participant->name already added to game.";
                debug($this->errorMsg);
                return FALSE;
            }
            
        }
        $participant->index=  $this->numOfParticipants;
        $this->numOfParticipants=array_push($this->participants,$participant);
        
        return TRUE;
    }
    
    function commitChanges(){
        $sql=" UPDATE `games` SET `admin`='$this->admin',`PIN`='$this->PIN',`participants`='".json_encode($this->participants)."',`num_of_participants`='$this->numOfParticipants',`game`='$this->gameCode',`active_participant`='".$this->activeParticipant."',`DOE`='$this->DOE' WHERE `PIN`='$this->PIN' ";
        $result=  mysql_query($sql);
        
        return $result;
    }
}

?>
