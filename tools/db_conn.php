<?php
// Create a global variable called DB, connect the db to sqlite file
global $DB;
$path = dirname(__DIR__) . '/db/main.db';
$DB = new PDO('sqlite:' . $path);

function init_db()
{
    global $DB;

    // Run reset.sql
    $sql = file_get_contents(dirname(__DIR__) . '/db/reset.sql');
    $DB->exec($sql);

    // Run init.sql
    $sql = file_get_contents(dirname(__DIR__) . '/db/init.sql');
    $DB->exec($sql);
}

// Check if database is initialized
// If not, initialize it
try {
    $ver = $DB->query("SELECT version FROM info limit 1")->fetch()[0];
    if ($ver != 3) {
        init_db();
    }
} catch (Exception $e) {
    init_db();
}