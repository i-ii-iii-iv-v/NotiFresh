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
    $storage = 'Shelf';


foreach($_POST as $fruits)
{
    if($fruits == 'Fridge' || $fruits == 'Shelf'){//change to pantry incase wrong	
        continue;
    }
    //For each foodname, get storage days and add today + storage  which is expdate.
    $storDays = mysqli_query($db_server,"SELECT storDays FROM FoodStorage WHERE foodName = '$fruits' AND storEnv = '$storage'");
    $temp = mysqli_fetch_assoc($storDays);        
    $expDate = date_convert($today, $temp['storDays']);

// INSERTING USER FOODs into the UserFoodEntry table
    $result = mysqli_query($db_server, "INSERT INTO UserFoodEntry (entryDate, username, foodName, storEnv, expDate) VALUES('$today', '$username', '$fruits', '$storage', '$expDate')");
    if(!$result)
       die("query failed");

//inserting to emaillist table
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

    <!--logo-->
    <div id="logo" class = "visible-xs">
        <a href="fruits.php"><img src="images/logo_horizontal_fresh_edition.png" alt="NotiFresh Logo" width="200" height="75" /></a>
        <br/>
    </div>

    <!--dropdown-->
    <div class="items">
        <button class="categories" onclick="location.href='fruits.php'">Fruits</button>
        <button class="categories" onclick="location.href='vegetables.php'">Vegetables</button>
    </div>

    <!--icons-->
    <main>
        <form method=post action="fruits.php">
            <div class="icons">
         
                    <label><input type="checkbox" name="Apple" value="Apple"><img src="images/fruits/Apple.png" title="Apple" width="100" height="100" alt="apple" /> </a> </label>
                    <label><input type="checkbox" name="Apricot" value="Apricot"><img src="images/fruits/Apricot.png" title="Apricot" width="100" height="100" alt="apricot" /></label>
                    <label><input type="checkbox" name="Avocado" value="Avocado"><img src="images/fruits/Avocado.png" title="Avocado" width="100" height="100" alt="avocado" /></label>
                
                    <label><input type="checkbox" name="Banana" value="Banana"><img src="images/fruits/Banana.png" title="Banana" width="100" height="100" alt="banana" /></label>
                    <label><input type="checkbox" name="Blueberry" value="Blueberry"><img src="images/fruits/Blueberry.png" title="Blueberry" width="100" height="100" alt="blueberry" /></label>
                    <label><input type="checkbox" name="Cantaloupe" value="Cantaloupe"><img src="images/fruits/Cantaloupe.png" title="Cantaloupe" width="100" height="100" alt="cantaloupe" /></label>
               
                    <label><input type="checkbox" name="Cherry" value="Cherry"><img src="images/fruits/Cherry.png" title="Cherry" width="100" height="100" alt="cherry" /></label>
                    <label><input type="checkbox" name="Grape" value="Grape"><img src="images/fruits/Grape.png" title="Grape" width="100" height="100" alt="grape" /></label>
                    <label><input type="checkbox" name="Kiwi" value="Kiwi"><img src="images/fruits/Kiwi.png" title="Kiwi" width="100" height="100" alt="kiwi" /></label>
                
                    <label><input type="checkbox" name="Lemon" value="Lemon"><img src="images/fruits/Lemon.png" title="Lemon" width="100" height="100" alt="lemon" /></label>
                    <label><input type="checkbox" name="Mango" value="Mango"><img src="images/fruits/Mango.png" title="Mango" width="100" height="100" alt="mango" /></label>
                    <label><input type="checkbox" name="Orange" value="Orange"><img src="images/fruits/Orange.png" title="Orange" width="100" height="100" alt="orange" /></label>
                
                    <label><input type="checkbox" name="Peach" value="Peach"><img src="images/fruits/Peach.png" title="Peach" width="100" height="100" alt="peach" /></label>
                    <label><input type="checkbox" name="Pear" value="Pear"><img src="images/fruits/Pear.png" title="Pear" width="100" height="100" alt="pear" /></label>
                    <label><input type="checkbox" name="Pineapple" value="Pineapple"><img src="images/fruits/Pineapple.png" title="Pineapple" width="100" height="100" alt="pineapple" /></label>
               
                    <label><input type="checkbox" name="Plum" value="Plum"><img src="images/fruits/Plum.png" title="Plum" width="100" height="100" alt="plum" /></label>
                    <label><input type="checkbox" name="Strawberry" value="Strawberry"><img src="images/fruits/Strawberry.png" title="Strawberry" width="100" height="100" alt="strawberry" /></label>
                    <label><input type="checkbox" name="Watermelon" value="Watermelon"><img src="images/fruits/Watermelon.png" title="Watermelon" width="100" height="100" alt="watermelon" /></label>
               

            </div>

            <!--storage-->
            <div class="storage">
                <input type='submit' name="Fridge" value='Fridge' id='fridge' />
                <input type='submit' name="Shelf" value='Shelf' id='Shelf' />
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
</div>
<!--
</body>

</html>