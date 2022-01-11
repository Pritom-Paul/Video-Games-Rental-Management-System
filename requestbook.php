<?php

include("data_class.php");

$userid=$_GET['userid'];
$gameid=$_GET['gameid'];





$obj=new data();
$obj->setconnection();
$obj->requestgame($userid,$gameid);

?>