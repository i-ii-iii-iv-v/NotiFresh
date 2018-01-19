<?php

require_once("mysqlinfo.php");
date_default_timezone_set('America/Vancouver');
    $db_server = mysqli_connect($db_host, $db_user, $db_password, $db_database);
    if(!$db_server)
    {
        die("not working");
    }
    
    $today = date("Y-m-d");
    $query = "SELECT * FROM EmailList"; 
    /* WHERE notiDate = '$today'*/
//get result from userSettings and if turned off, don't send? 
    $result = mysqli_query($db_server, $query);
    if(!$result)
        die("sql query failed");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $sendid = $row['sendID'];
            $msg = $row['itemName']. " in ". $row['envName'] . " in ". $row['itemExpDate'];
            $subject = "Notifresh Expriation Notification";
            $headers = "From: Notifresh";
            $to = $row['email'];
            mail($to, $subject,$msg, $headers);
            $query = "DELETE FROM EmailList WHERE sendID = $sendid";
            mysqli_query($db_server, $query);             
        }
    }
?>