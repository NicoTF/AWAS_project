<?php
require_once '../tools/db_conn.php';
require_once '../tools/check_auth.php';
global $DB;
?>
<?php include '../tools/menu.php'; ?>
<h1>Find Users</h1>
<form id="search-form" action="search.php" method="get">
    <label for="username">search for username:</label>
    <input type="text" id="username" name="username">
    <button type="submit">search</button>
</form>

<?php

if (isset($_GET['username'])) {
    $search = $_GET['username'];

    //possible sql injection by injecting a UNION SELECT statement
    //if the parameter is: 'UNION SELECT id, password FROM users --
    $query = $DB->query("SELECT id, username FROM users WHERE username LIKE '$search%' ORDER BY username");
    $qresult = $query->fetchAll();

    if (!($qresult)) {
        echo "No matching username found";
    } else {
        echo "<ul>";
        foreach ($qresult as $user) {
            $username = $user[1];
            $uid = $user[0];
            echo "<li><a href='/users/user_page.php?uid=$uid'>$username</a></li>";
        }
        echo "</ul>";
    }
}
?>
