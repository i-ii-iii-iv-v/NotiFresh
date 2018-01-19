<?php
//database info
    $db_user = "id1542723_admin";
    $db_password = "team22";	
    $db_database = "id1542723_user";
    $db_host = "localhost";

    function pw_sanitize($pwstring)
    {
        $pw_html = htmlentities($pwstring);
        $salt = "ajf123";
        $token = $pw_html.$salt;
        return hash('ripemd128', $token);
    }

    function session_check()
    {
        if(!(isset($_SESSION['username']) && isset($_SESSION['password'])))
            header("Location: login.php");
    }
        
?>