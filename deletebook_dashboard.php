<?php
include("data_class.php");

$deletegameid=$_GET['deletegameid'];


$obj=new data();
$obj->setconnection();
$obj->deletegame($deletegameid);