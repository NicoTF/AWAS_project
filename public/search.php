<?php
require_once '../tools/db_conn.php';
require_once '../tools/check_auth.php';
global $DB;
?>

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
    //if the parameter is: 'UNION SELECT password FROM users --
    $query = $DB->query("SELECT username FROM users WHERE username LIKE '$search%' ORDER BY username");
    $qresult = $query->fetchAll();

    if (!($qresult)) {
        echo "No matching username found";
    } else {
        echo "<ul>";
        foreach ($qresult as $user) {
            $username = $user[0];
            echo "<li>$username</li>";
        }
        echo "</ul>";
    }
}
?>
