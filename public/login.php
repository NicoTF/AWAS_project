<?php
require_once("../tools/db_conn.php");
global $DB;
session_start();

if(isset($_POST['submit'])) {
    $username = stripslashes($_POST['username']);
    $password = stripslashes($_POST['password']);


    $query = $DB->query("SELECT * FROM 'users' WHERE username='$username' and password = '$password'");
    $qresult = $query->fetch(PDO::FETCH_ASSOC);

    if (!($qresult)) {
        echo "Username/password is incorrect.";

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
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>

<body>

Not registered yet? Click <a href=register.php>here</a> to register
<div class="form">
    <h1>Login</h1>
    <form action="" method="post" name="login">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input name="submit" type="submit" value="Login" />
    </form>

</body>

</html>
