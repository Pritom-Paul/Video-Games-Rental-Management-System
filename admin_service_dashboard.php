<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>
    <style>
        .innerright,label {
    color: rgb(2, 27, 117);
    font-weight:bold;
}
.container,
.row,
.imglogo {
    margin:auto;
}

.innerdiv {
    text-align: center;
    /* width: 500px; */
    margin: 100px;
}
input{
    margin-left:20px;
}
.leftinnerdiv {
    float: left;
    width: 25%;
}

.rightinnerdiv {
    float: right;
    width: 75%;
}

.innerright {
    background-color: rgb(232, 123, 128);
}

.redbtn {
    background-color: rgb(173, 31, 38);
    color: white;
    width: 95%;
    height: 40px;
    margin-top: 8px;
}

.redbtn,
a {
    text-decoration: none;
    color: white;
    font-size: large;
}

th{
    background-color: orange;
    color: black;
}
td{
    background-color: #fed8b1;
    color: black;
}
td, a{
    color:black;
}
    </style>
    <body>

    <?php
   include("data_class.php");

$msg="";

   if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
 }

if($msg=="done"){
    echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
}
elseif($msg=="fail"){
    echo "<div class='alert alert-danger' role='alert'>Fail</div>";
}

    ?>



        <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/Logo.png"/></div>
            <div class="leftinnerdiv">
                <Button class="redbtn"> ADMIN</Button>
                <Button class="redbtn" onclick="openpart('addgame')" >ADD GAME</Button>
                <Button class="redbtn" onclick="openpart('gamereport')" > GAME DETAILS</Button>
                <Button class="redbtn" onclick="openpart('gamerequestapprove')"> GAME REQUESTS</Button>
                <Button class="redbtn" onclick="openpart('addperson')"> ADD MEMBER</Button>
                <Button class="redbtn" onclick="openpart('memberrecord')"> MEMBER RECORD</Button>
                <Button class="redbtn"  onclick="openpart('issuegame')"> ISSUE GAME</Button>
                <Button class="redbtn" onclick="openpart('issuegamereport')"> ISSUE REPORT</Button>
                <a href="index.php"><Button class="redbtn" > LOGOUT</Button></a>
            </div>

            <div class="rightinnerdiv">   
            <div id="gamerequestapprove" class="innerright portion" style="display:none">
            <Button class="redbtn" >GAME REQUEST APPROVE</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->requestgamedata();
            $recordset=$u->requestgamedata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Person Name</th><th>person type</th><th>Game name</th><th>Days </th><th>Approve</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
              "<td>$row[1]</td>";
              "<td>$row[2]</td>";

                $table.="<td>$row[3]</td>";
                $table.="<td>$row[4]</td>";
                $table.="<td>$row[5]</td>";
                $table.="<td>$row[6]</td>";
               // $table.="<td><a href='approvegamerequest.php?reqid=$row[0]&game=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved GAME</button></a></td>";
                 $table.="<td><a href='approvegamerequest.php?reqid=$row[0]&game=$row[5]&userselect=$row[3]&days=$row[6]'>Approved</a></td>";
                // $table.="<td><a href='deletegame_dashboard.php?deletegameid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="addgame" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ echo "display:none";} else {echo ""; }?>">
            <Button class="redbtn" >ADD NEW GAME</Button>
            <form action="addgameserver_page.php" method="post" enctype="multipart/form-data">
            <label>Game Name:</label><input type="text" name="gamename"/>
            </br>
            <label>Detail:</label><input  type="text" name="gamedetail"/></br>
            <label>Developer:</label><input type="text" name="gameauthor"/></br>
            <label>Publication</label><input type="text" name="gamepub"/></br>
            <div>Branch:<input type="radio" name="branch" value="other"/>other<input type="radio" name="branch" value="Dhanmondi"/>Dhanmondi<div style="margin-left:80px"><input type="radio" name="branch" value="Uttara"/>Uttara<input type="radio" name="branch" value="Mohakhali"/>Mohakhali</div>
            </div>   
            <label>Price:</label><input  type="number" name="gameprice"/></br>
            <label>Quantity:</label><input type="number" name="gamequantity"/></br>
            <label>Game Photo</label><input  type="file" name="gamephoto"/></br>
            </br>
   
            <input type="submit" value="SUBMIT"/>
            </br>
            </br>

            </form>
            </div>
            </div>


            <div class="rightinnerdiv">   
            <div id="addperson" class="innerright portion" style="display:none">
            <Button class="redbtn" >ADD Person</Button>
            <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
            <label>Name:</label><input type="text" name="addname"/>
            </br>
            <label>Pasword:</label><input type="pasword" name="addpass"/>
            </br>
            <label>Email:</label><input  type="email" name="addemail"/></br>
            <label for="typw">Choose type:</label>
            <select name="type" >
                <option value="stuff">stuff</option>
                <option value="admin">admin</option>
            </select>

            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>


            <div class="rightinnerdiv">   
            <div id="memberrecord" class="innerright portion" style="display:none">
            <Button class="redbtn" >MEMBERS RECORD</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'> Name</th><th>Email</th><th>Type</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[1]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[4]</td>";
                // $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="issuegamereport" class="innerright portion" style="display:none">
            <Button class="redbtn" >Issue Game Record</Button>

            <?php
            $u=new data;
            $u->setconnection();
            $u->issuereport();
            $recordset=$u->issuereport();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Issue Name</th><th>Game Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[3]</td>";
                $table.="<td>$row[6]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[4]</td>";
                // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>

<!--             

issue game -->
            <div class="rightinnerdiv">   
            <div id="issuegame" class="innerright portion" style="display:none">
            <Button class="redbtn" >ISSUE GAME</Button>
            <form action="issuegame_server.php" method="post" enctype="multipart/form-data">
            <label for="game">Choose Game:</label>
            <select name="game" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->getgameissue();
            $recordset=$u->getgameissue();
            foreach($recordset as $row){

                echo "<option value='". $row[2] ."'>" .$row[2] ."</option>";
        
            }            
            ?>
            </select>

            <label for="Select Student">:</label>
            <select name="userselect" >
            <?php
            $u=new data;
            $u->setconnection();
            $u->userdata();
            $recordset=$u->userdata();
            foreach($recordset as $row){
               $id= $row[0];
                echo "<option value='". $row[1] ."'>" .$row[1] ."</option>";
            }            
            ?>
            </select>
<br>
            Days<input type="number" name="days"/>

            <input type="submit" value="SUBMIT"/>
            </form>
            </div>
            </div>

            <div class="rightinnerdiv">   
            <div id="gamedetail" class="innerright portion" style="<?php  if(!empty($_REQUEST['viewid'])){ $viewid=$_REQUEST['viewid'];} else {echo "display:none"; }?>">
            
            <Button class="redbtn" >GAME DETAIL</Button>
</br>
<?php
            $u=new data;
            $u->setconnection();
            $u->getgamedetail($viewid);
            $recordset=$u->getgamedetail($viewid);
            foreach($recordset as $row){

                $gameid= $row[0];
               $gameimg= $row[1];
               $gamename= $row[2];
               $gamedetail= $row[3];
               $gameauthor= $row[4];
               $gamepub= $row[5];
               $branch= $row[6];
               $gameprice= $row[7];
               $gamequantity= $row[8];
               $gameava= $row[9];
               $gamerent= $row[10];

            }            
?>

            <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $gameimg?> "/>
            </br>
            <p style="color:black"><u>Game Name:</u> &nbsp&nbsp<?php echo $gamename ?></p>
            <p style="color:black"><u>Game Detail:</u> &nbsp&nbsp<?php echo $gamedetail ?></p>
            <p style="color:black"><u>GameAuthour:</u> &nbsp&nbsp<?php echo $gameauthor ?></p>
            <p style="color:black"><u>Game Publisher:</u> &nbsp&nbsp<?php echo $gamepub ?></p>
            <p style="color:black"><u>Game Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
            <p style="color:black"><u>Game Price:</u> &nbsp&nbsp<?php echo $gameprice ?></p>
            <p style="color:black"><u>Game Available:</u> &nbsp&nbsp<?php echo $gameava ?></p>
            <p style="color:black"><u>Game Rent:</u> &nbsp&nbsp<?php echo $gamerent ?></p>


            </div>
            </div>



            <div class="rightinnerdiv">   
            <div id="gamereport" class="innerright portion" style="display:none">
            <Button class="redbtn" >GAME RECORD</Button>
            <?php
            $u=new data;
            $u->setconnection();
            $u->getgame();
            $recordset=$u->getgame();

            $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Game Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th></th><th>View</th></tr>";
            foreach($recordset as $row){
                $table.="<tr>";
               "<td>$row[0]</td>";
                $table.="<td>$row[2]</td>";
                $table.="<td>$row[7]</td>";
                $table.="<td>$row[8]</td>";
                $table.="<td>$row[9]</td>";
                $table.="<td>$row[10]</td>";
                $table.="<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View GAME</button></a></td>";
                // $table.="<td><a href='delete_dashboard.php?deleteid=$row[0]'>Delete</a></td>";
                $table.="</tr>";
                // $table.=$row[0];
            }
            $table.="</table>";

            echo $table;
            ?>

            </div>
            </div>



        </div>
        </div>
        

     
        <script>
        function openpart(portion) {
        var i;
        var x = document.getElementsByClassName("portion");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        document.getElementById(portion).style.display = "block";  
        }
        </script>
    </body>
</html>