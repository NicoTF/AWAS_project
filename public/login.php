<?php
require_once("../tools/db_conn.php");
global $DB;
/*
login page
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
    </head>

<body>
<?php
    require("../tools/db_conn.php");
    session_start();

    if(isset($_POST['username'])){
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        $query = "SELECT * FROM 'users' WHERE username='$username' and password = '$password'";

        $rowUID = $DB -> query($query) -> fetch()[0][0];
        
        if(!(is_null($rowUID)){
            session_destroy();
            session_write_close();

            session_id(base64_encode($username);
            session_start();
//            $_SESSION['username'] = $username;
//            $authcookie = base64_encode($username . $rowUID);
//            setcookie("AUTHID", $authcookie, time() + 60*15, "/");

            header("Location: index.php");
        }
    else{
        echo "<div class='form'> <h2>Username or password is incorrent.</h2><br>Click here to <a href = 'login' Login</a></div>";
        }
    }
    else{
        echo '<div class="form"> <h1>Login</h1><form action="" method="post" name="login">'
    }





</html>
