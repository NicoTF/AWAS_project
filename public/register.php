<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/../tools/error_config.php";
require_once("../tools/db_conn.php");
global $DB;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cPassword = $_POST['confirmPassword'];

    $query = $DB->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
    $query->execute([':username' => $username]);
    $count = $query -> fetch();

    if($count[0] > 0){
        echo "The username is taken. Please chose another one.";
    }

    else {
        if ($password != $cPassword) {
            echo "The password does not match";
        } else {
            $query = $DB->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');

            if ($query->execute([':username' => $username, ':password' => $password])) {
                echo "Registration successful! Click <a href=" . "" . "login.php>here</a> to login";
                exit();
            } else {
                echo "Something went wrong. Please <a href=" . "" . "register.php>retry</a>";
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
<h1>User Registration</h1>
<form method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <label for="confirmPassword">Password:</label>
    <input type="password" id="confirmPassword" name="confirmPassword" required><br>
    <input type="submit" name="submit" value="Register">
</form>
</body>
</html>