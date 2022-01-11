<?php

include("data_class.php");

$game=$_POST['game'];
$userselect= $_POST['userselect'];
$getdate= date("d/m/Y");
$days= $_POST['days'];

$returnDate=Date('d/m/Y', strtotime('+'.$days.'days'));

$obj=new data();
$obj->setconnection();
$obj->issuegame($game,$userselect,$days,$getdate,$returnDate);
