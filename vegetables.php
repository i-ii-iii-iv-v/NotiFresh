<?php
session_start();
require_once("mysqlinfo.php");
session_check();
$username = $_SESSION['username'];
    $db_server = mysqli_connect($db_host, $db_user, $db_password, $db_database);
    if(!$db_server)
    {
        die("not working");
    }
$counter = 0;
$today = date("Y-m-d");

//determines which submit button is selected
if(isset($_POST['Fridge']))
    $storage = 'Fridge';
if(isset($_POST['Shelf']))
    die("shelf selected");
    //$storage = 'Shelf';


foreach($_POST as $fruits)
{
    if($fruits == 'Fridge' || $fruits == 'Shelf'){//change to pantry incase wrong	
        continue;
    }
    //For each foodname, get storage days and add today + storage  which is expdate.
    $storDays = mysqli_query($db_server,"SELECT storDays FROM FoodStorage WHERE foodName = '$fruits' AND storEnv = '$storage'");
    $temp = mysqli_fetch_assoc($storDays);        
    $expDate = date_convert($today, $temp['storDays']);

// INSERTING USER FOODs into the database
    $result = mysqli_query($db_server, "INSERT INTO UserFoodEntry (entryDate, username, foodName, storEnv, expDate) VALUES('$today', '$username', '$fruits', '$storage', '$expDate')");
    if(!$result)
       die("query failed");
//inserting to emaillist
$email_result = mysqli_query($db_server, "SELECT email FROM user WHERE username = '$username'");
if(!$email_result)
    die("insert email result failed");
$email = mysqli_result($email_result,0);


$notiDate = date_convert($expDate, -2);
$insert_result = mysqli_query($db_server, "INSERT INTO EmailList (email, username, notiDate, itemName, envName, itemExpDate)
VALUES('$email', '$username', '$notiDate', '$fruits', '$storage', '$expDate')");
if(!$insert_result)
    die("insert result failed");
//this is edited
}

function mysqli_result($res, $row, $field=0) { 
            $res->data_seek($row); 
            $datarow = $res->fetch_array(); 
            return $datarow[$field]; 
        } 
function date_convert($string, $time)
    {
       $date = new DateTime($string);
       $date->modify("+$time day");
       return $date->format('Y-m-d');
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
  <title>Main Page</title>

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
      <a href="vegetables.php"><img src="images/logo_horizontal_fresh_edition.png" alt="NotiFresh Logo" width="200" height="75" /></a></br>
  </div> 

<!--dropdown-->
  <div class="items">
    <button class="categories" onclick="location.href='fruits.php'">Fruits</button>
    <button class="categories" onclick="location.href='vegetables.php'">Vegetables</button>
  </div>

<!--icons-->
<main>
  <form method=post action="vegetables.php">
    <div class="icons">
     
        <label><input type="checkbox" name="Asparagus" value="Asparagus"><img src="images/vegetables/Asparagus.png" title="Asparagus" width="100" height="100" alt="Asparagus" /></label>
        <label><input type="checkbox" name="Broccoli" value="Broccoli"><img src="images/vegetables/Broccoli.png" title="Broccoli" width="100" height="100" alt="Broccoli" /></label>
        <label><input type="checkbox" name="Cabbage" value="Cabbage"><img src="images/vegetables/Cabbage.png" title="Cabbage" width="100" height="100" alt="Cabbage" /></label>
      
        <label><input type="checkbox" name="Carrot" value="Carrot"><img src="images/vegetables/Carrot.png" title="Carrot" width="100" height="100" alt="Carrot" /></label>
        <label><input type="checkbox" name="Cauliflower" value="Cauliflower"><img src="images/vegetables/Cauliflower.png" title="Cauliflower" width="100" height="100" alt="Cauliflower" /></label>
        <label><input type="checkbox" name="Cucumber" value="Cucumber"><img src="images/vegetables/Cucumber.png" title="Cucumber" width="100" height="100" alt="Cucumber" /></label>
     
        <label><input type="checkbox" name="Garlic" value="Garlic"><img src="images/vegetables/Garlic.png" title="Garlic" width="100" height="100" alt="Garlic" /></label>
        <label><input type="checkbox" name="Kale" value="Kale"><img src="images/vegetables/Kale.png" title="Kale" width="100" height="100" alt="Kale" /></label>
        <label><input type="checkbox" name="Lettuce" value="Lettuce"><img src="images/vegetables/Lettuce.png" title="Lettuce" width="100" height="100" alt="Lettuce" /></label>
      
        <label><input type="checkbox" name="Mushroom" value="Mushroom"><img src="images/vegetables/Mushroom.png" title="Mushroom" width="100" height="100" alt="Mushroom" /></label>
        <label><input type="checkbox" name="Onion" value="Onion"><img src="images/vegetables/Onion.png" title="Onion" width="100" height="100" alt="Onion" /></label>
        <label><input type="checkbox" name="Paprika" value="Paprika"><img src="images/vegetables/Paprika.png" title="Paprika" width="100" height="100" alt="Paprika" /></label>
     
        <label><input type="checkbox" name="Potato" value="Potato"><img src="images/vegetables/Potato.png" title="Potato" width="100" height="100" alt="Potato" /></a></label>
        <label><input type="checkbox" name="Pumpkin" value="Pumpkin"><img src="images/vegetables/Pumpkin.png" title="Pumpkin" width="100" height="100" alt="Pumpkin" /></label>
        <label><input type="checkbox" name="Spinach" value="Spinach"><img src="images/vegetables/Spinach.png" title="Spinach" width="100" height="100" alt="Spinach" /></label>
     
        <label><input type="checkbox" name="Taro" value="Taro"><img src="images/vegetables/Taro.png" title="Taro" width="100" height="100" alt="Taro" /></label>
        <label><input type="checkbox" name="Tomato" value="Tomato"><img src="images/vegetables/Tomato.png" title="Tomato" width="100" height="100" alt="Tomato" /></label>
        <label><input type="checkbox" name="Zucchini" value="Zucchini"><img src="images/vegetables/Zucchini.png" title="Zucchini" width="100" height="100" alt="Zucchini" /></label>
      

    </div>

    <!--storage-->
    <div class="storage">
      <input type='submit' name = 'Fridge' value='Fridge' id='fridge' />
    </div>
  </form>
</main>
  
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
</div><!--
</body>
</html>