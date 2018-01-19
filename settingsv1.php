<?php
session_start();
require_once('mysqlinfo.php');
session_check();

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
	<link href="styles/bootstrap.min.css" rel="stylesheet" media="screen">
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
          </div>

        <!-- notification time -->
        <label for="time">Notification time</label>
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
            <option value="24">24:00</option>
          </select></br>

        <!-- notification date -->
        <label for="date">Notification date</label>
          <select id="date" name="date">
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
          <p>(Days before expiration)</p>
          <input type = 'submit' name = 'submit'>
        </fieldset>
            
        <fieldset>
            <!-- Contact Us -->
            <h3>Contact Us</h3>
            <a href="support.html">Support and Feedback</a>

            <!-- Tutorial 
            <h3>Tutorial</h3>
            <a href="">Tutorial</a>
            -->

            <!-- Affiliated Apps -->
            <h3>Affiliated Apps</h3>
            <a href="affiliated-apps.html">Affiliated Apps</a>
        </fieldset>
      </form>
</div>

<!--navigation bar-->
            <div class="navbar">
              <div class="logo-image">
                <a href="fruits.php"><img src="images/homeIcon.png" class="img-responsive" alt="Home Icon Logo" title="Home" width="35" height="32" /></a>
              </div>
              
              <div class="logo-image">
                <a href="list.php"><img src="images/listIcon.png" class="img-responsive" alt="List Icon Logo" title="List" width="35" height="32" /></a>
              </div>
              
              <div class="logo-image">
                <a href="settings.php"><img src="images/settingIcon.png" class="img-responsive" alt="Setting Icon Logo" title="Setting" width="35" height="32" /></a>
              </div>
              
              <div class="logo-image">
                <a id="l"><img src="images/signOutIcon.png" class="img-responsive" alt="Sign Out Logo" title="Sign Out" width="35" height="32" /></a>
              </div>
            </div>

</div>
</body>
</html>