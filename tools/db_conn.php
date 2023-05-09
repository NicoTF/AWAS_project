<?php
// Create a global variable called DB, connect the db to sqlite file
global $DB;
$DB = new PDO('sqlite:../db/main.db');

function init_db()
{
    global $DB;

    // Run reset.sql
    $sql = file_get_contents('../db/reset.sql');
    $DB->exec($sql);

    // Run init.sql
    $sql = file_get_contents('../db/init.sql');
    $DB->exec($sql);
}

// Check if database is initialized
// If not, initialize it
try {
    $ver = $DB->exec("SELECT version FROM info limit 1");
    if ($ver != 2) {
        init_db();
    }
} catch (Exception $e) {
    init_db();
}