<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/../tools/error_config.php";
require_once("../tools/db_conn.php");
require_once "../tools/utils.php";
global $DB;
session_start();

if (isset($_POST['submit'])) {
    $username = stripslashes($_POST['username']);
    $password = stripslashes($_POST['password']);


    $query = $DB->prepare("SELECT * FROM 'users' WHERE username= ? and password = ?");
    $ok = $query->execute([$username, $password]);

    if ($ok) {
        $qresult = $query->fetch(PDO::FETCH_ASSOC);

        //$query = $DB->query("SELECT * FROM 'users' WHERE username='$username' and password = '$password'");
        //$qresult = $query->fetch(PDO::FETCH_ASSOC);

        if (!($qresult)) {
            HTMLError("Username/password is incorrect.");
        } else {
            $UID = $qresult["id"];
            if (!(is_null($UID))) {
                $_SESSION['id'] = $UID;
                $_SESSION['username'] = $qresult['username'];
                $_SESSION['auth'] = true;

                header("Location: index.php");
                exit();
            }
        }
    } else {
        HTMLError("Database error. Please retry later.");
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container">
    <h1>Login</h1>
    <form action="" method="post" name="login">
        <input type="text" name="username" placeholder="Username" required/>
        <input type="password" name="password" placeholder="Password" required/>
        <input name="submit" type="submit" value="Login"/>
    </form>
    <p>Not registered yet? Click <a href="register.php">here</a> to register.</p>
</div>

</body>

</html>

