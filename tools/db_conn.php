<?php
// Create a global variable called DB, connect the db to sqlite file
global $DB;
$DB = new PDO('sqlite:../db/main.db');

// Check if database is initialized
// If not, initialize it
try {
    $ver = $DB->exec("SELECT version FROM info");
    echo $ver;
} catch (Exception $e) {

}