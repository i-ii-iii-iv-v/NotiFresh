<?php
        session_start();
        session_destroy();
        session_start();
        require_once("mysqlinfo.php");
	    $db_server = mysqli_connect($db_host, $db_user, $db_password, $db_database);
        if(!$db_server)
        {
            die("not working");
        }
        
        //mysqli_query(
        $login = 1;
        if(isset($_POST['loggin']) && isset($_POST['username']) && isset($_POST['password'])){
            $password = $_POST['password'];
            $cleanpw = pw_sanitize($password);
            $username = $_POST['username'];
            $query_select_pass = "SELECT password FROM user WHERE username = '$username'";
            $result = mysqli_query($db_server,$query_select_pass);
            if(!$result){
                die("complete the form");
            }
            $rows=mysqli_result($result,0);

            if($rows ===$cleanpw){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $cleanpw;
            header("Location: fruits.php");
            die("below code don't get run");

            //echo "<br>"."autheticated"."<br>";
            }
        else
        $login = 0;
                }


      function mysqli_result($res, $row, $field=0) {
          $res -> data_seek($row);
          $datarow = $res -> fetch_array();
          return $datarow[$field];
      }
?>

<!--use buffer function for header location-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<link href="Styles/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="Styles/style.css" rel="stylesheet" media="screen">  
	<title>NotiFresh</title>
</head>

<body>
<div class="col-12">

<!--logo pic -->
  <div id="logo">
    <a href="login.html"><img src="images/logo_horizontal_fresh_edition.png" alt="NotiFresh Logo" width="300" height="110"/></a>
  </div>

  <form action="login.php" method="post" >
    <?php 
      if($login == 0) 
        echo "<br><span style = 'color:red;padding-left:45%;'>Authentication failed</span><br>";
    ?> 
    
  <table class="table">	
      <div class="logIn">
<!-- User ID & psw field -->      
        <div class="section">
        <div class="inner-wrap">
          <label>User ID <input type="text" name="username" /></label>
          <label>Password <input type="password" name="password" /></label>
        </div>
        </div>
  </table>
</div>

<!--Log in button-->
  <div class="button-section1">
    <input type="submit" value="Log in" name="loggin" />
  </div><br>
</form>
        
<!-- signup & forget pw links -->
  <div id="id_psw">
    <a href="create_id.php">Create new user ID</a></br>
    <a href="forgot_password.html">Forgot password?</a>
  </div>
  
</div>
<!--
</body>
</html>



<!--different design on email, password, and log in-->
<!--font-family: comic sans?-->