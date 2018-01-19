<?php

//started session, checking session, username init, database connect;
session_start();
require_once("mysqlinfo.php");
session_check();
$username = $_SESSION['username'];
    $db_server = mysqli_connect($db_host, $db_user, $db_password, $db_database);
    if(!$db_server)
    {
        die("not working");
    }

if(isset($_POST['remove'])){
    $remove = $_POST['remove'];
    $query = "SELECT * FROM UserFoodEntry WHERE entryNo = $remove";
    $result = mysqli_query($db_server, $query);
    if(!$result)
        die("removing failed");
    $row = mysqli_fetch_assoc($result);
    $r_foodName = $row['foodName'];
    $r_username = $row['username'];
    $r_expDate = $row['expDate'];
    $r_storEnv = $row['storEnv'];
    $query2 = "DELETE FROM UserFoodEntry WHERE entryNo = $remove";
    $result = mysqli_query($db_server, $query2);
    if(!$result)
        die("query 2 removing failed");
    $query3 = "DELETE FROM EmailList WHERE username = '$r_username' AND itemName = '$r_foodName' AND envName = '$r_storEnv' AND itemExpDate = '$r_expDate' LIMIT 1";
    $result = mysqli_query($db_server, $query3);
    if(!$result)
        die("query 3 removing failed");
    
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link href="Styles/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="Styles/style.css" rel="stylesheet" media="screen">  
  <title>List Page</title>

  <script>
onload=function() {
  document.getElementById("l").onclick=function() {
    if(confirm("Are you sure you want to sign out?") == true) {
      window.location.href = "login.php"
    } 
  }
}
</script>
</head>

<body>

<!--logo-->
  <div id="logo" class = "visible-xs">
      <a href="fruits.php"><img src="images/logo_horizontal_fresh_edition.png" alt="NotiFresh Logo" width="200" height="75" /></a></br>  
  </div> 
  
<form method = "POST" action = "list.php">
  
<!--Main, table for display-->
<div class="list">
    <table class="table" id = "t1">
        <thead>
            <th scope="col" colspan="3" style="text-align:left;padding-left:18%">Item</th>
            <th scope="col">Expiry Date</th>
        </thead>
        <tbody>
<?php
$query = "SELECT * FROM UserFoodEntry WHERE username = '$username' ORDER BY expDate ASC";
$result = mysqli_query($db_server, $query);
if(!$result)
    die("Query failed");

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
 
	echo "<tr>";
        echo        "<td rowspan= '2'>";
        echo        "<img src='images/$row[foodName].png' title=$row[foodName] width='100' height'100' alt= '$row[foodName]' />";
        echo        "<button type='submit' name='remove' value='$row[entryNo]' id='remove'>remove</button>";
        echo        "</td>";
        echo        "<td style='vertical-align:middle'>".$row['foodName']."</td>";
        echo        "<td></td>";
        echo        "<td class='exp' rowspan='2' style='vertical-align: middle'>".$row['expDate']."</td>";
        echo    "</tr>";
        echo    "<tr>";
        echo    "<td style= 'vertical-align: middle'>".$row['storEnv']."</td>";
        echo    "<td></td>";
        echo    "</tr>";
        //echo "<br>".$row['foodName']." ".$row['storType']." ".$row['expDate'];
    }
}

?>
        </tbody>
    </table>
</div>
</form>
<!--desktop navigation-->
<div class = "hidden-xs">
 <div class = "deskNav">
   <ul>
     <li><img src="images/logo_horizontal_fresh_edition.png" alt="NotiFresh Logo" width="148" height="50" /></li>
     <li class="dropdown">
       <a class="dropbtn">Home</a>
     <div class="dropdown-content">
       <a href="fruits.php">Fruits</a>
       <a href="vegetables.php">Vegetables</a>
     </div>
     </li>
     <li><a href="list.php">My List</a></li>
     <li><a href="settings.php">Settings</a></li>
     <li style="float:right"><a href="login.php"><span class="glyphicon glyphicon-user"></span>Log Out</a></li>
   </ul>
 </div>
</div>
         
<!--mobile navigation bar-->
<div class = "visible-xs">
 <div class="navbar">
   <div class="logo-image">
     <a href="fruits.php"><img src="images/homeIcon.png" class="img-responsive" alt="Home Icon Logo" title="Home" width="30" height="30" /></a>
   </div>
   
  <div class="logo-image">
     <a href="list.php"><img src="images/listIcon.png" class="img-responsive" alt="List Icon Logo" title="List" width="30" height="30" /></a>
   </div>
   
  <div class="logo-image">
     <a href="settings.php"><img src="images/settingIcon.png" class="img-responsive" alt="Setting Icon Logo" title="Setting" width="30" height="30" /></a>
   </div>
   
  <div class="logo-image">
     <a id="l"><img src="images/signOutIcon.png" class="img-responsive" alt="Sign Out Logo" title="Sign Out" width="30" height="30" /></a>
   </div>
 </div>
</div>
  <!--
</body>

</html>