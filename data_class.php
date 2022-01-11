<?php include("db.php");

class data extends db {

    private $gamepic;
    private $gamename;
    private $gamedetail;
    private $gameauthor;
    private $gamepub;
    private $branch;
    private $gameprice;
    private $gamequantity;
    private $type;

    private $game;
    private $userselect;
    private $days;
    private $getdate;
    private $returnDate;





    function __construct() {
        // echo " constructor ";
        echo "</br></br>";
    }


    function addnewuser($name,$password,$email,$type){
        $this->name=$name;
        $this->password=$password;
        $this->email=$email;
        $this->type=$type;


         $q="INSERT INTO userdata(id, name, email, pass,type)VALUES('','$name','$email','$password','$type')";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=New Add done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=Register Fail");
        }



    }
    function userLogin($t1, $t2) {
        $q="SELECT * FROM userdata where email='$t1' and pass='$t2'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();
        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $logid=$row['id'];
                header("location: otheruser_dashboard.php?userlogid=$logid");
            }
        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }

    }

    function adminLogin($t1, $t2) {

        $q="SELECT * FROM admin where email='$t1' and pass='$t2'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $logid=$row['id'];
                header("location: admin_service_dashboard.php?logid=$logid");
            }
        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }

    }



    function addgame($gamepic, $gamename, $gamedetail, $gameauthor, $gamepub, $branch, $gameprice, $gamequantity) {
        $this->$gamepic=$gamepic;
        $this->gamename=$gamename;
        $this->gamedetail=$gamedetail;
        $this->gameauthor=$gameauthor;
        $this->gamepub=$gamepub;
        $this->branch=$branch;
        $this->gameprice=$gameprice;
        $this->gamequantity=$gamequantity;

       $q="INSERT INTO game (id,gamepic,gamename, gamedetail, gameauthor, gamepub, branch, gameprice,gamequantity,gameava,gamerent)VALUES('','$gamepic', '$gamename', '$gamedetail', '$gameauthor', '$gamepub', '$branch', '$gameprice', '$gamequantity','$gamequantity',0)";

        if($this->connection->exec($q)) {
            header("Location:admin_service_dashboard.php?msg=done");
        }

        else {
            header("Location:admin_service_dashboard.php?msg=fail");
        }

    }


    private $id;



    function getissuegame($userloginid) {

        $newfine="";
        $issuereturn="";

        $q="SELECT * FROM issuegame where userid='$userloginid'";
        $recordSetss=$this->connection->query($q);


        foreach($recordSetss->fetchAll() as $row) {
            $issuereturn=$row['issuereturn'];
            $fine=$row['fine'];
            $newfine= $fine;

            
                //  $newgamerent=$row['gamerent']+1;
        }


        $getdate= date("d/m/Y");
        if($issuereturn<$getdate){
            $q="UPDATE issuegame SET fine='$newfine' where userid='$userloginid'";

            if($this->connection->exec($q)) {
                $q="SELECT * FROM issuegame where userid='$userloginid' ";
                $data=$this->connection->query($q);
                return $data;
            }
            else{
                $q="SELECT * FROM issuegame where userid='$userloginid' ";
                $data=$this->connection->query($q);
                return $data;  
            }

        }
        else{
            $q="SELECT * FROM issuegame where userid='$userloginid'";
            $data=$this->connection->query($q);
            return $data;

        }






    }

    function getgame() {
        $q="SELECT * FROM game ";
        $data=$this->connection->query($q);
        return $data;
    }
    function getgameissue(){
        $q="SELECT * FROM game where gameava !=0 ";
        $data=$this->connection->query($q);
        return $data;
    }

    function userdata() {
        $q="SELECT * FROM userdata ";
        $data=$this->connection->query($q);
        return $data;
    }


    function getgamedetail($id){
        $q="SELECT * FROM game where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }

    function userdetail($id){
        $q="SELECT * FROM userdata where id ='$id'";
        $data=$this->connection->query($q);
        return $data;
    }



    function requestgame($userid,$gameid){

        $q="SELECT * FROM game where id='$gameid'";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where id='$userid'";
        $recordSet=$this->connection->query($q);

        foreach($recordSet->fetchAll() as $row) {
            $username=$row['name'];
            $usertype=$row['type'];
        }

        foreach($recordSetss->fetchAll() as $row) {
            $gamename=$row['gamename'];
        }

        if($usertype=="stuff"){
            $days=7;
        }
        if($usertype=="admin"){
            $days=21;
        }


        $q="INSERT INTO requestgame (id,userid,gameid,username,usertype,gamename,issuedays)VALUES('','$userid', '$gameid', '$username', '$usertype', '$gamename', '$days')";

        if($this->connection->exec($q)) {
            header("Location:otheruser_dashboard.php?userlogid=$userid");
        }

        else {
            header("Location:otheruser_dashboard.php?msg=fail");
        }

    }


    function returngame($id){
        $fine="";
        $gameava="";
        $issuegame="";
        $gamerentel="";

        $q="SELECT * FROM issuegame where id='$id'";
        $recordSet=$this->connection->query($q);

        foreach($recordSet->fetchAll() as $row) {
            $userid=$row['userid'];
            $issuegame=$row['issuegame'];
            $fine=$row['fine'];

        }
        if($fine==0){

        $q="SELECT * FROM game where gamename='$issuegame'";
        $recordSet=$this->connection->query($q);   

        foreach($recordSet->fetchAll() as $row) {
            $gameava=$row['gameava']+1;
            $gamerentel=$row['gamerent']-1;
        }
        $q="UPDATE game SET gameava='$gameava', gamerent='$gamerentel' where gamename='$issuegame'";
        $this->connection->exec($q);

        $q="DELETE from issuegame where id=$id and issuegame='$issuegame' and fine='0' ";
        if($this->connection->exec($q)){
    
            header("Location:otheruser_dashboard.php?userlogid=$userid");
         }
        //  else{
        //     header("Location:otheruser_dashboard.php?msg=fail");
        //  }
        }
        // if($fine!=0){
        //     header("Location:otheruser_dashboard.php?userlogid=$userid&msg=fine");
        // }
       

    }

    function delteuserdata($id){
        $q="DELETE from userdata where id='$id'";
        if($this->connection->exec($q)){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }

    function deletegame($id){
        $q="DELETE from game where id='$id'";
        if($this->connection->exec($q)){
    
            
           header("Location:admin_service_dashboard.php?msg=done");
        }
        else{
           header("Location:admin_service_dashboard.php?msg=fail");
        }
    }

        function issuereport(){
            $q="SELECT * FROM issuegame ";
            $data=$this->connection->query($q);
            return $data;
            
        }

        function requestgamedata(){
            $q="SELECT * FROM requestgame ";
            $data=$this->connection->query($q);
            return $data;
        }

      // issue issuegameapprove
      function issuegameapprove($game,$userselect,$days,$getdate,$returnDate,$redid){
        $this->$game= $game;
        $this->$userselect=$userselect;
        $this->$days=$days;
        $this->$getdate=$getdate;
        $this->$returnDate=$returnDate;


        $q="SELECT * FROM game where gamename='$game'";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $issueid=$row['id'];
                $issuetype=$row['type'];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            foreach($recordSetss->fetchAll() as $row) {
                $gameid=$row['id'];
                $gamename=$row['gamename'];

                    $newgameava=$row['gameava']-1;
                     $newgamerent=$row['gamerent']+1;
            }

        
            $q="UPDATE game SET gameava='$newgameava', gamerent='$newgamerent' where id='$gameid'";
            if($this->connection->exec($q)){

            $q="INSERT INTO issuegame (userid,issuename,issuegame,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$game','$issuetype','$days','$getdate','$returnDate','0')";

            if($this->connection->exec($q)) {

                $q="DELETE from requestgame where id='$redid'";
                $this->connection->exec($q);
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }




        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }


    }
    
    // issue game
    function issuegame($game,$userselect,$days,$getdate,$returnDate){
        $this->$game= $game;
        $this->$userselect=$userselect;
        $this->$days=$days;
        $this->$getdate=$getdate;
        $this->$returnDate=$returnDate;


        $q="SELECT * FROM game where gamename='$game'";
        $recordSetss=$this->connection->query($q);

        $q="SELECT * FROM userdata where name='$userselect'";
        $recordSet=$this->connection->query($q);
        $result=$recordSet->rowCount();

        if ($result > 0) {

            foreach($recordSet->fetchAll() as $row) {
                $issueid=$row['id'];
                $issuetype=$row['type'];

                // header("location: admin_service_dashboard.php?logid=$logid");
            }
            foreach($recordSetss->fetchAll() as $row) {
                $gameid=$row['id'];
                $gamename=$row['gamename'];

                    $newgameava=$row['gameava']-1;
                     $newgamerent=$row['gamerent']+1;
            }

        
            $q="UPDATE game SET gameava='$newgameava', gamerent='$newgamerent' where id='$gameid'";
            if($this->connection->exec($q)){

            $q="INSERT INTO issuegame (userid,issuename,issuegame,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$userselect','$game','$issuetype','$days','$getdate','$returnDate','0')";

            if($this->connection->exec($q)) {
                header("Location:admin_service_dashboard.php?msg=done");
            }
    
            else {
                header("Location:admin_service_dashboard.php?msg=fail");
            }
            }
            else{
               header("Location:admin_service_dashboard.php?msg=fail");
            }


        }

        else {
            header("location: index.php?msg=Invalid Credentials");
        }


    }
}