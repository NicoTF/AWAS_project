<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/../tools/error_config.php";
require_once '../tools/db_conn.php';
require_once '../tools/utils.php';
require_once '../tools/check_auth.php';
global $DB;
?>
<?php include '../tools/menu.php'; ?>
<div id="newpost">
    <h1>Find Users</h1>
    <form id="search-form" action="search.php" method="get">
        <label for="username">Search for username:</label>
        <input type="text" id="username" name="username">
        <input type="submit" value="Search">
    </form>
</div>

<?php

if (isset($_GET['username'])) {
    $search = $_GET['username'];

    //possible sql injection by injecting a UNION SELECT statement
    //if the parameter is: 'UNION SELECT id, password FROM users --
    $query = $DB->query("SELECT id, username FROM users WHERE username LIKE '$search%' ORDER BY username");
    $qresult = $query->fetchAll();

    if (!($qresult)) {
        HTMLError("No users found");
    } else {
        ?>
        <style>
            #users ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }

            #users li {
                margin-bottom: 10px;
            }

            #users li a {
                display: block;
                padding: 10px;
                background-color: #f0f0f0;
                text-decoration: none;
                color: #333333;
                border-radius: 4px;
                transition: background-color 0.3s;
            }

            #users li a:hover {
                background-color: #e0e0e0;
            }
        </style>
        <div id="users">
            <ul>
                <?php
                foreach ($qresult as $user) {
                    $username = $user[1];
                    $uid = $user[0];
                    echo "<li><a href='/users/user_page.php?uid=$uid'>$username</a></li>";
                }
                ?>
            </ul>
        </div>
        <?php

    }
}
?>
