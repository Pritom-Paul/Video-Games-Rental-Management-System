<?php
//addserver_page.php
include("data_class.php");



$gamename=$_POST['gamename'];
$gamedetail=$_POST['gamedetail'];
$gameauthor=$_POST['gameauthor'];
$gamepub=$_POST['gamepub'];
$branch=$_POST['branch'];
$gameprice=$_POST['gameprice'];
$gamequantity=$_POST['gamequantity'];



if (move_uploaded_file($_FILES["gamephoto"]["tmp_name"],"uploads/" . $_FILES["gamephoto"]["name"])) {

    $gamepic=$_FILES["gamephoto"]["name"];

$obj=new data();
$obj->setconnection();
$obj->addgame($gamepic,$gamename,$gamedetail,$gameauthor,$gamepub,$branch,$gameprice,$gamequantity);
  } 
  else {
     echo "File not uploaded";
  }