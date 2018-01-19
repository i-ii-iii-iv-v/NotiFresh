<?php
session_start();
require_once('mysqlinfo.php');
session_check();
//
$db_server = mysqli_connect($db_host, $db_user, $db_password, $db_database);
    if(!$db_server)
        die("not working");

$username = $_SESSION['username'];
if(isset($_POST['submit']))
{
    $time = $_POST["time"];
    $notify = $_POST["notify"];
    $date = $_POST["date"];

    $query = "UPDATE UserSettings SET setNotiOnOff = '$notify' WHERE username = '$username'";
    $query1 = "UPDATE UserSettings SET setNotiTime = '$time' WHERE username = '$username'";
    $query2 = "UPDATE UserSettings SET setNotiDays = '$date' WHERE username = '$username'";

    $result = mysqli_query($db_server, $query);
    if(!$result)
        die("query failed");

    $result = mysqli_query($db_server, $query1);
    if(!$result)
        die("query1 failed");

    $result = mysqli_query($db_server, $query2);
    if(!$result)
     die("query2 failed");
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
  <title>Settings</title>
  
  <!-- sign out script -->  
  <script>
    onload = function() {
        document.getElementById("l").onclick = function() {
            if (confirm("Are you sure you want to sign out?") == true) {
                window.location.href = "login.php"
            }
        }
    }
</script>
</head>

<body>
<div class="col-12">
<div class="setting">  
    <h1>Expiry Notification</h1>
      <form method="post" action="settings.php">
        <fieldset>
        
        <!-- on/off switch -->
          <div class="onoffswitch">
            <input type="checkbox" name="notify" class="onoffswitch-checkbox" id="myonoffswitch" checked>
            <label class="onoffswitch-label" for="myonoffswitch">
              <span class="onoffswitch-inner"></span>
              <span class="onoffswitch-switch"></span>
            </label>
          </div><hr/>

        <!-- notification time -->
        <label for="time">Time of the Day:</label>
          <select id="time" name="time">
            <option value="1">1:00</option>
            <option value="2">2:00</option>
            <option value="3">3:00</option>
            <option value="4">4:00</option>
            <option value="5">5:00</option>
            <option value="6">6:00</option>
            <option value="7">7:00</option>
            <option value="8">8:00</option>
            <option value="9">9:00</option>
            <option value="10">10:00</option>
            <option value="11">11:00</option>
            <option value="12">12:00</option>
            <option value="13">13:00</option>
            <option value="14">14:00</option>
            <option value="15">15:00</option>
            <option value="16">16:00</option>
            <option value="17">17:00</option>
            <option value="18">18:00</option>
            <option value="19">19:00</option>
            <option value="20">20:00</option>
            <option value="21">21:00</option>
            <option value="22">22:00</option>
            <option value="23">23:00</option>
            <option value="0">0:00</option>
          </select></br>

        <!-- notification date -->
        <!--<label for="date">Alert:</label>
          <select id="date" name="date">
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
        <label for="before">days before expiration</label>-->
          
          <!--submit button-->
        <div class="button-section4">
          <input type="submit" value="Set" name="submit" />
        </fieldset> <hr/>
            
        <div>
            <!-- Contact Us -->
            <h3>Contact Us</h3>
            <a href="support.html">Support and Feedback</a>

            <!-- Affiliated Apps -->
            <h3>Affiliated Apps</h3>
            <a href="affiliated-apps.html">Affiliated Apps</a>
        </div>
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
</div>
</div>
<!--
</body>
</html>