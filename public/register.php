<link rel="stylesheet" href="css/styles.css">
<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/../tools/error_config.php";
require_once("../tools/db_conn.php");
require_once "../tools/utils.php";
global $DB;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cPassword = $_POST['confirmPassword'];

    $query = $DB->prepare('SELECT COUNT(*) FROM users WHERE username = :username');
    $query->execute([':username' => $username]);
    $count = $query->fetch();

    $uname_valid = preg_match('/^[a-zA-Z0-9_]+$/', $username);

    if ($count[0] > 0 || !$uname_valid) {
        HTMLError("Username is not valid");
    } else {
        if ($password != $cPassword) {
            HTMLError("The password does not match");
        } else {
            $query = $DB->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');

            if ($query->execute([':username' => $username, ':password' => $password])) {
                HTMLmessage("Registration successful! Click <a href=" . "login.php>here</a> to login");
                exit();
            } else {
                HTMLError("Something went wrong. Please <a href=" . "register.php>retry</a>");
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<head>
    <title>User Registration</title>
</head>
<body>

<div id="newpost">
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
</div>
</body>