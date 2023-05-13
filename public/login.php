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

    session_start();

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);


        $query = $DB->query("SELECT * FROM 'users' WHERE username='$username' and password = '$password'");
        $qresult = $query -> fetch(PDO::FETCH_ASSOC);

        if(!($qresult)){
            echo "Username/password is incorrect. Click <a href=". "" . "login.php>here</a> to retry";
            exit();
        }

        $UID = $qresult["id"];

        if (!(is_null($UID))) {
            $_SESSION['id'] = $UID;
            $_SESSION['username'] = $qresult['username'];
            $_SESSION['auth'] = true;

            header("Location: index.php");
            exit();



/*            session_destroy();
            session_write_close();

            session_id(base64_encode($username));
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['uid'] = $rowUID;
            $authcookie = base64_encode($username . $rowUID);
            setcookie("AUTHID", $authcookie, time() + 60*15, "/");
*/

        }
    }
        else {
            //echo "<div class='form'> <h2>Username or password is incorrect.</h2><br>Click here to <a href = 'login' Login</a></div>";

            echo '<div class="form"><h1>Login</h1><form action="" method="post" name="login"><input type="text" name="username" placeholder="Username" required /><input type="password" name="password" placeholder="Password" required /><input name="submit" type="submit" value="Login" /></form> ';
        }

?>
</body>

</html>
