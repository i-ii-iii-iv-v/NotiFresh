<?php

require_once("mysqlinfo.php");
date_default_timezone_set('America/Vancouver');
    $db_server = mysqli_connect($db_host, $db_user, $db_password, $db_database);
    if(!$db_server)
    {
        die("not working");
    }
    
    $today = date("Y-m-d");
    $query = "SELECT * FROM EmailList ORDER BY email"; 
    /* WHERE notiDate = '$today'*/
//get result from userSettings and if turned off, don't send? 
    $result = mysqli_query($db_server, $query);
    if(!$result)
        die("sql query failed");
    if(mysqli_num_rows($result) > 0){
		$counter = -1;
        while($row = mysqli_fetch_assoc($result)){
			$counter++;
			$curr_email = $row['email'];
            $sendid = $row['sendID'];
            $msg = $row['itemName']. " in ". $row['envName'] . " expires at ". $row['itemExpDate'];
            $subject = "Notifresh Expriation Notification";
            $headers = "From: Notifresh";
            $to = $row['email'];
			$new_row = mysqli_fetch_assoc($result);
			$counter++;
			while($new_row['email'] == $curr_email)
			{
				$msg = $msg."<br>".$new_row['itemName']. " in ". $new_row['envName'] . " expires at ". $new_row['itemExpDate'];
				$new_row = mysqli_fetch_assoc($result);
				$counter++;
			}
			
			mysqli_data_seek($result, $counter);
			$counter--;
			/*start*/
			echo "$counter "." ".$to." ". $msg."<br><br><br>";
			/*finsih*/
			
            //mail($to, $subject,$msg, $headers);
            //DELETE WHERE NOTIDate is today and preftime is rightnow?
            //mysqli_query($db_server, $query);             
        }
    }
?>