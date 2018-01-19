<?php
    require_once('mysqlinfo.php');
    $db_server = mysqli_connect($db_host, $db_user, $db_password, $db_database);
        if(!$db_server)
            die("not working");
    if(check_form('username') && check_form('password') && check_form('email') && check_form('fname') && check_form('lname')){
        $username_exist = true;
        $username = $_POST['username'];
        //htmlentities($username);
        $password = $_POST['password'];
        $cleanpw = pw_sanitize($password);
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

        $result = mysqli_query($db_server, "SELECT * FROM user WHERE username = '$username'");
        if(!$result){
            die("unable to get the query ");
        }
        $num_rows = mysqli_num_rows($result);

        if($num_rows == 0){
            $query = "INSERT INTO UserSettings VALUES('$username', 'on', 12, 2 )";
            $result = mysqli_query($db_server, $query);

            if(!$result){
                die("unable to insert 1");
            }
            
            $query = "INSERT INTO user (username, password, email, firstname, lastname) VALUES('$username','$cleanpw','$email','$fname','$lname')";
            $result = mysqli_query($db_server, $query);
            
            if(!$result)
                die("unable to insert");
            
            else
                header("Location: login.php");
        }
            echo "username already exists"."<br>";

    }

    function check_form($var){
        if(isset($_POST[$var]) && !empty($_POST[$var])){
            return true;
        }
    }
    function mysqli_result($res, $row, $field=0) { 
        $res->data_seek($row); 
        $datarow = $res->fetch_array(); 
        return $datarow[$field]; 
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<link href="Styles/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="Styles/style.css" rel="stylesheet" media="screen">  
  <title>Create New ID</title>
</head>

<body>
<div class="col-12">
  <div class="signUp">
  <h1>Create New ID!</h1>
  <form method = "post" action = "create_id.php">
  
<!--first and last name field-->  
      <div class="section"><span>1</span>First Name &amp; Last Name</div>
      <div class="inner-wrap">
        <label>First Name <input type="text" name="fname" /></label>
        <label>Last Name <input type="text" name="lname" ></label>
      </div>

<!--ID & Email field-->      
      <div class="section"><span>2</span>ID &amp; Email</div>
      <div class="inner-wrap">
        <label>ID <input type="text" name="username" /></label>
        <label>Email Address <input type="email" name="email" /></label>
      </div>

<!--password field-->
      <div class="section"><span>3</span>Passwords</div>
        <div class="inner-wrap">
        <label>Password <input type="password" name="password" /></label>
        <label>Confirm Password <input type="password" name="password2" /></label>
        <!-- ajax validation-->
      </div>

<!--submit button-->
      <div class="button-section3">
        <input type="submit" value="Create" name="singup" />
        <!--check isset function-->
      </div>
  </form>
  </div>
</div>
<!--
</body>
</html>